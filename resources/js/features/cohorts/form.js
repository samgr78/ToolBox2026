import {sendRequest} from "../../utils/fetch.js";

console.log('cohort.js chargé');
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
            formData.append('_method', 'PATCH');
        }

        try {
            const response = await sendRequest(url, method, formData);

            if (response.success) {
                document.querySelector('#cohorts-table tbody').innerHTML += response.html;
            }

        } catch (err) {
            if (err.status === 422 && err.errors) {
                displayValidationErrors(err.errors);
            }
        }
    });
}
