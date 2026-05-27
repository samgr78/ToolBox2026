export function initImportExcel() {
    const previewModal = document.getElementById('previewModal');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const confirmImportBtn = document.getElementById('confirmImportBtn');
    const fileInput = document.getElementById('file_input');
    const importForm = document.getElementById('importForm');
    let currentFormData = null;

    if (!importForm) return;

    const ratePreviewUrl = importForm.dataset.ratePreview;
    const rateImportUrl = importForm.dataset.rateImport;

    fileInput.addEventListener('change', function() {
        if (!fileInput.files.length) return;

        const formData = new FormData();
        formData.append('fichier_excel', fileInput.files[0]);
        formData.append('_token', document.querySelector('input[name="_token"]').value);

        fileInput.disabled = true;
        previewModal.classList.add('hidden');

        fetch(ratePreviewUrl, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            fileInput.disabled = false;

            if (data.success) {
                displayPreview(data.data);
                currentFormData = formData;
                previewModal.classList.remove('hidden');
            } else {
                showTemporaryMessage('Erreur: ' + (data.message || 'Erreur inconnue'), 'error');
                fileInput.value = '';
            }
        })
        .catch(error => {
            fileInput.disabled = false;
            console.error('Erreur:', error);
            showTemporaryMessage('Erreur lors du chargement du fichier', 'error');
            fileInput.value = '';
        });
    });

    function displayPreview(data) {
        const thead = document.querySelector('#previewTable thead');
        const tbody = document.getElementById('previewTableBody');
        const recordCount = document.getElementById('recordCount');

        thead.innerHTML = '';
        tbody.innerHTML = '';
        recordCount.textContent = data.length;

        if (data.length === 0) {
            tbody.innerHTML = '<tr><td colspan="100%" class="px-6 py-4 text-center">Aucune donnée trouvée</td></tr>';
            return;
        }

        const rowKeys = Object.keys(data[0]);
        const headers = rowKeys.filter(header => isNaN(header));
        const displayKeys = headers.length ? headers : rowKeys;

        const headerRow = document.createElement('tr');
        displayKeys.forEach((key, index) => {
            const th = document.createElement('th');
            th.className = 'px-6 py-3 font-semibold text-blue-900 dark:text-blue-300';
            th.textContent = isNaN(key) ? key : 'Colonne ' + (index + 1);
            headerRow.appendChild(th);
        });
        thead.appendChild(headerRow);

        data.forEach(row => {
            const tr = document.createElement('tr');
            tr.className = 'border-b border-gray-200 dark:border-gray-700 hover:bg-blue-50 dark:hover:bg-slate-800';
            displayKeys.forEach(key => {
                const td = document.createElement('td');
                td.className = 'px-6 py-4 text-gray-700 dark:text-gray-200';
                td.textContent = row[key] || '-';
                tr.appendChild(td);
            });
            tbody.appendChild(tr);
        });
    }

    closeModalBtn.addEventListener('click', closeModal);

    function closeModal() {
        previewModal.classList.add('hidden');
        fileInput.value = '';
        currentFormData = null;
    }

    function showTemporaryMessage(message, type = 'success') {
        const container = importForm.parentElement;
        const msg = document.createElement('div');
        msg.className = type === 'success'
            ? 'mb-4 text-sm text-green-600 font-medium'
            : 'mb-4 text-sm text-red-600 font-medium';
        msg.textContent = message;
        container.insertBefore(msg, container.firstChild);
        setTimeout(() => { msg.remove(); }, 5000);
    }

    confirmImportBtn.addEventListener('click', function() {
        if (!currentFormData) return;

        confirmImportBtn.disabled = true;
        confirmImportBtn.innerHTML = '<span class="inline-block animate-spin mr-2">⏳</span>Importation...';

        fetch(rateImportUrl, {
            method: 'POST',
            body: currentFormData
        })
        .then(response => {
            if (response.ok) {
                previewModal.classList.add('hidden');
                fileInput.value = '';
                currentFormData = null;
                confirmImportBtn.disabled = false;
                confirmImportBtn.innerHTML = 'Valider';
                showTemporaryMessage('Importation terminée.', 'success');
            } else {
                showTemporaryMessage('Erreur lors de l\'importation', 'error');
                confirmImportBtn.disabled = false;
                confirmImportBtn.innerHTML = 'Valider';
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            showTemporaryMessage('Erreur lors de l\'importation', 'error');
            confirmImportBtn.disabled = false;
            confirmImportBtn.innerHTML = 'Valider';
        });
    });

    previewModal.addEventListener('click', function(e) {
        if (e.target === previewModal) {
            closeModal();
        }
    });
}
