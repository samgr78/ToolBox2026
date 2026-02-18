import { sendRequest } from "../../utils/fetch.js";
import { modal } from "../../utils/modal.js";

export function initCohortForm() {
    bindStoreCohort();
    bindUpdateCohort();
}

/**
 * Crée une promotion si `data-cohort-id` n'existe pas
 */
function bindStoreCohort() {
    const form = document.querySelector('#cohort-form');
    if (!form) return;

    form.addEventListener('submit', (e) => {
        const cohortId = form.dataset.cohortId;

        if (!cohortId) {
            e.preventDefault();
            const formData = new FormData(form);

            sendRequest('/cohort/store', 'POST', formData)
                .then(response => {
                    if (response.redirect) {
                        window.location.href = response.redirect;
                    } else {
                        console.log('Promotion créée', response);
                        modal('#cohort-drawer').close();
                        window.location.reload();
                    }
                });
        }
    });
}

/**
 * Met à jour une promotion si `data-cohort-id` est défini
 */
function bindUpdateCohort() {
    const form = document.querySelector('#cohort-form');
    if (!form) return;

    form.addEventListener('submit', (e) => {
        const cohortId = form.dataset.cohortId;

        if (cohortId) {
            e.preventDefault();
            const formData = new FormData(form);
            formData.append('_method', 'PATCH');

            sendRequest(`/cohort/${cohortId}`, 'POST', formData)
                .then(() => {
                    console.log('Promotion mise à jour');
                    modal('#cohort-drawer').close();
                    window.location.reload();
                });
        }
    });
}

/**
 * Remplit le formulaire avec les données existantes
 */
export function fillCohortForm(data) {
    const form = document.querySelector('#cohort-form');
    if (!form) return;

    form.dataset.cohortId = data.id || null;
    form.querySelector('[name="name"]').value = data.name || '';
    form.querySelector('[name="description"]').value = data.description || '';
    form.querySelector('[name="start_date"]').value = data.start_date || '';
    form.querySelector('[name="end_date"]').value = data.end_date || '';
}
