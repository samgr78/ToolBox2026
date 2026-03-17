import { sendRequest } from "../../utils/fetch.js";

export function initUserForm() {
    const form = document.querySelector('#user-form');
    if (!form) return;

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const userId = form.dataset.userId;
        const formData = new FormData(form);

        let url    = '/user/store';
        let method = 'POST';

        if (userId) {
            url    = `/user/${userId}`;
            method = 'POST'; // Laravel attend POST + _method pour les spoofed methods
            formData.append('_method', 'PATCH');
        }

        try {
            const response = await sendRequest(url, method, formData);

            if (response.success) {
                if (userId) {
                    // Update : remplacer la ligne existante dans le tableau
                    updateTableRow(response.user);
                } else {
                    // Create : ajouter la ligne
                    document.querySelector('#users-table tbody').innerHTML += response.html;
                }

                form.reset();
                form.removeAttribute('data-user-id'); // reset en mode création
            }

        } catch (err) {
            if (err.status === 422 && err.errors) {
                // displayValidationErrors(err.errors);
            }
        }
    });
}

function updateTableRow(user) {
    const row = document.querySelector(`tr[data-user-id="${user.id}"]`);
    if (!row) return;

    // Adapter selon les colonnes de ton tableau
    row.querySelector('[data-field="first_name"]').textContent = user.first_name;
    row.querySelector('[data-field="last_name"]').textContent  = user.last_name;
    row.querySelector('[data-field="email"]').textContent      = user.email;
}