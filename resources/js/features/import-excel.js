/**
 * Ce module gère l'importation de fichiers Excel pour les évaluations des utilisateurs.
 * Il permet de prévisualiser les données avant l'importation définitive en base de données.
 */
export function initImportExcel() {
    const previewModal = document.getElementById('previewModal');
    const fileInput = document.getElementById('file_input');
    const importForm = document.getElementById('importForm');
    const confirmImportBtn = document.getElementById('confirmImportBtn');

    if (!importForm) return;

    let currentFormData = null;
    const { ratePreview: ratePreviewUrl, rateImport: rateImportUrl } = importForm.dataset;

    // -------------------------------------------------------------------------
    // Utilitaires UI
    // -------------------------------------------------------------------------

    /**
     * Affiche un message temporaire (5s) au-dessus du formulaire.
     *
     * @param {string} message  Texte à afficher
     * @param {'success'|'error'} type  Détermine la couleur (vert / rouge)
     */
    function showMessage(message, type = 'success') {
        const msg = document.createElement('div');
        msg.className = `mb-4 text-sm font-medium ${type === 'success' ? 'text-green-600' : 'text-red-600'}`;
        msg.textContent = message;
        importForm.parentElement.prepend(msg);
        setTimeout(() => msg.remove(), 5000);
    }

    /**
     * Ferme la modale et réinitialise l'état
     */
    function closeModal() {
        previewModal.classList.add('hidden');
        fileInput.value = '';
        currentFormData = null;
    }

    // -------------------------------------------------------------------------
    // Logique d'importation et de prévisualisation
    // -------------------------------------------------------------------------

    /**
     * Affiche les données prévisualisées dans la modale.
     * @param {Array<Object>} data  Tableau de lignes (objets associatifs)
     */
    function displayPreview(data) {
        const recordCount = document.getElementById('recordCount');
        const thead = document.querySelector('#previewTable thead');
        const tbody = document.getElementById('previewTableBody');

        recordCount.textContent = data.length;
        thead.innerHTML = '';
        tbody.innerHTML = '';

        if (!data.length) {
            tbody.innerHTML = '<tr><td colspan="100%" class="px-6 py-4 text-center">Aucune donnée trouvée</td></tr>';
            return;
        }

        const keys = Object.keys(data[0]);
        const displayKeys = keys.filter(k => isNaN(k)).length ? keys.filter(k => isNaN(k)) : keys;

        const headerRow = thead.insertRow();
        displayKeys.forEach((key, i) => {
            const th = document.createElement('th');
            th.className = 'px-6 py-3 font-semibold text-blue-900 dark:text-blue-300';
            th.textContent = isNaN(key) ? key : `Colonne ${i + 1}`;
            headerRow.appendChild(th);
        });

        data.forEach(row => {
            const tr = tbody.insertRow();
            tr.className = 'border-b border-gray-200 dark:border-gray-700 hover:bg-blue-50 dark:hover:bg-slate-800';
            displayKeys.forEach(key => {
                const td = tr.insertCell();
                td.className = 'px-6 py-4 text-gray-700 dark:text-gray-200';
                td.textContent = row[key] || '-';
            });
        });
    }

    // -------------------------------------------------------------------------
    // Étape 1 — Prévisualisation du fichier après sélection
    // -------------------------------------------------------------------------

    fileInput.addEventListener('change', async function () {
        if (!fileInput.files.length) return;

        const formData = new FormData();
        formData.append('fichier_excel', fileInput.files[0]);

        // Token CSRF pour Laravel récupéré depuis un champ caché dans le formulaire
        formData.append('_token', document.querySelector('input[name="_token"]').value);

        fileInput.disabled = true;

        try {
            const res = await fetch(ratePreviewUrl, { method: 'POST', body: formData });
            const data = await res.json();

            if (data.success) {
                displayPreview(data.data);
                // Stocke les données du formulaire pour l'importation finale après confirmation
                currentFormData = formData;
                previewModal.classList.remove('hidden');
            } else {
                showMessage('Erreur: ' + (data.message || 'Erreur inconnue'), 'error');
                fileInput.value = '';
            }
        } catch {
            // Message d'érreur générique en cas de problème réseau ou autre
            showMessage('Erreur lors du chargement du fichier', 'error');
            fileInput.value = '';
        } finally {
            fileInput.disabled = false;
        }
    });

    // -------------------------------------------------------------------------
    // Étape 2 — Importation définitive après confirmation
    // -------------------------------------------------------------------------

    confirmImportBtn.addEventListener('click', async function () {
        // Si les données du formulaire ne sont pas disponibles, on arrête l'importation
        if (!currentFormData) return;

        // Désactive le bouton pour éviter les clics multiples
        confirmImportBtn.disabled = true;
        confirmImportBtn.innerHTML = '<span class="inline-block animate-spin mr-2">⏳</span>Importation...';

        try {
            const res = await fetch(rateImportUrl, { method: 'POST', body: currentFormData });
            if (res.ok) {
                closeModal();
                showMessage('Importation terminée.');
            } else {
                showMessage('Erreur lors de l\'importation', 'error');
            }
        } catch {
            showMessage('Erreur lors de l\'importation', 'error');
        } finally {
            // Réactive le bouton pour permettre une nouvelle tentative
            confirmImportBtn.disabled = false;
            confirmImportBtn.innerHTML = 'Valider';
        }
    });

    // -------------------------------------------------------------------------
    // Fermeture de la modale
    // -------------------------------------------------------------------------

    document.getElementById('closeModalBtn').addEventListener('click', closeModal);
    previewModal.addEventListener('click', e => e.target === previewModal && closeModal());
}