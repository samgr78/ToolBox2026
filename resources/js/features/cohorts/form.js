import { sendRequest } from "../../utils/fetch.js";

export function initCohortForm() {
    const form = document.querySelector('#cohort-form');
    if (!form) return;

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const cohortId = form.dataset.cohortId;
        const formData = new FormData(form);

        let url = '/cohort/store';
        let method = 'POST';

        if (cohortId) {
            url = `/cohort/${cohortId}`;
            formData.append('_method', 'PUT');
        }

        try {
            const response = await sendRequest(url, method, formData);

            if (response.success) {
                if (cohortId) {
                    // On cible l'ancienne ligne dans le tableau
                    const row = document.querySelector(`tr[data-id="${cohortId}"]`);
                    if (row) {
                    // On remplace le HTML de la ligne par le nouveau
                        row.outerHTML = response.html;
                    }

                    //On remet le formulaire à zéro pour les prochains ajouts
                    form.reset();
                    delete form.dataset.cohortId;

                    //On remet le titre d'origine
                    const title = form.closest('.bg-white').querySelector('h3');
                    if (title) title.innerText = "Ajouter une promotion";

                } else if (response.html) {
                    document.querySelector('#cohorts-table tbody').innerHTML += response.html;
                    form.reset();
                }
            }

        } catch (err) {
            console.error(err);
        }
    });
}

export function destroy() {
    document.addEventListener('submit', async (e) => {
        const form = e.target.closest('.cohort-delete-form');
        if (!form) return;

        e.preventDefault();
        if (!confirm('Supprimer cette promotion ?')) return;

        const cohortId = form.dataset.id;

        try {
            const response = await sendRequest(`/cohort/${cohortId}`, 'DELETE');

            if (response.success) {
                document.querySelector(`tr[data-id="${response.id}"]`)?.remove();
            }

        } catch (err) {
            console.error(err);
        }
    });
}

export function openEditDrawer() {
    // On l'attache à window car tu utilises onclick="..." dans ton Blade
    window.openEditDrawer = function(id, name, description, startDate, endDate) {
        const form = document.querySelector('#cohort-form');
        if (!form) return;
        form.dataset.cohortId = id;

        //remplissage des champs
        form.querySelector('[name="name"]').value = name;
        form.querySelector('[name="description"]').value = description;
        form.querySelector('[name="start_date"]').value = startDate;
        form.querySelector('[name="end_date"]').value = endDate;

        //Changement du titre
        const title = form.closest('.bg-white').querySelector('h3');
        if (title) title.innerText = "Modifier la promotion";

        //On fait défiler la page jusqu'au formulaire
        form.scrollIntoView({ behavior: 'smooth', block: 'center' });
    };
}
