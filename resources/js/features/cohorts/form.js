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
                        modal('#cohort-drawer').close();
                        window.location.reload();
                    }
                })
                .catch(err => {
                    if (err.status === 422 && err.errors) {
                        displayValidationErrors(err.errors);
                    }
                })
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

export function openEditDrawer(id, name, description, start, end) {
    console.log('openEditDrawer called', id);
    const form = document.querySelector('#cohort-form');
    console.log('form found:', form);
    const m = modal('#cohort-drawer');
    console.log('modal instance:', m);
    if (!form || !m) return;

    form.dataset.cohortId = id;
    form.querySelector('[name="name"]').value = name;
    form.querySelector('[name="description"]').value = description;
    form.querySelector('[name="start_date"]').value = start;
    form.querySelector('[name="end_date"]').value = end;

    m.open();
}

export function closeEditDrawer() {
    const form = document.querySelector('#cohort-form');
    if (form) delete form.dataset.cohortId;
    modal('#cohort-drawer').close();
}
