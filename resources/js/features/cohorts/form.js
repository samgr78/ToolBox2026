import { sendRequest } from "../../utils/fetch.js";

function attachEditListener(btn, form) {
    btn.addEventListener('click', () => {
        const { id, name, description, startDate, endDate } = btn.dataset;

        form.querySelector('[name="name"]').value = name;
        form.querySelector('[name="description"]').value = description;
        form.querySelector('[name="start_date"]').value = startDate;
        form.querySelector('[name="end_date"]').value = endDate;
        form.dataset.cohortId = id;
    });
}

function attachDeleteListener(btn) {
    btn.addEventListener('click', async () => {
        if (!confirm('Supprimer cette promotion ?')) return;

        const { id, url } = btn.dataset;

        try {
            const response = await sendRequest(url, 'DELETE');

            if (response.success) {
                const row = document.querySelector(`#cohorts-table tr[data-cohort-id="${id}"]`);
                if (row) row.remove();

                const tbody = document.querySelector('#cohorts-table tbody');
                if (tbody && !tbody.querySelector('tr')) {
                    tbody.innerHTML = `
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-400">
                                Aucune promotion pour le moment.
                            </td>
                        </tr>`;
                }
            }
        } catch (err) {
            console.error('Erreur suppression:', err);
        }
    });
}

function updateTableRow(html, form) {
    const cohortId = form.dataset.cohortId;

    const tbody = document.querySelector('#cohorts-table tbody');
    const existingRow = tbody.querySelector(`tr[data-cohort-id="${cohortId}"]`);

    if (!existingRow) return;

    existingRow.insertAdjacentHTML('afterend', html);
    existingRow.remove();

    const newRow = tbody.querySelector(`tr[data-cohort-id="${cohortId}"]`);
    const editBtn = newRow?.querySelector('.edit-cohort-btn');
    if (editBtn) attachEditListener(editBtn, form);
    const deleteBtn = newRow?.querySelector('.delete-cohort-btn');
    if (deleteBtn) attachDeleteListener(deleteBtn);
}

export function initCohortForm() {
    const form = document.querySelector('#cohort-form');
    if (!form) return;

    document.querySelectorAll('.edit-cohort-btn').forEach(btn => {
        attachEditListener(btn, form);
    });

    document.querySelectorAll('.delete-cohort-btn').forEach(btn => {
        attachDeleteListener(btn);
    });

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const cohortId = form.dataset.cohortId;
        const formData = new FormData(form);

        let url    = '/cohort/store';
        let method = 'POST';

        if (cohortId) {
            url    = `/cohort/${cohortId}`;
            method = 'POST';
            formData.append('_method', 'PATCH');
        }

        try {
            const response = await sendRequest(url, method, formData);

            if (response.success) {
                if (cohortId) {
                    updateTableRow(response.html, form);
                } else {
                    const tbody = document.querySelector('#cohorts-table tbody');
                    const emptyRow = tbody.querySelector('td[colspan]')?.closest('tr');
                    if (emptyRow) emptyRow.remove();

                    tbody.insertAdjacentHTML('beforeend', response.html);

                    const newRow = tbody.lastElementChild;
                    const editBtn = newRow?.querySelector('.edit-cohort-btn');
                    if (editBtn) attachEditListener(editBtn, form);
                    const deleteBtn = newRow?.querySelector('.delete-cohort-btn');
                    if (deleteBtn) attachDeleteListener(deleteBtn);
                }

                form.reset();
                form.removeAttribute('data-cohort-id');
            }

        } catch (err) {
            if (err.status === 422 && err.errors) {
                // displayValidationErrors(err.errors);
            }
        }
    });
}
