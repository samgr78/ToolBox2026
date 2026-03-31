import { sendRequest } from "../../utils/fetch.js";

function attachEditListener(btn, form) {
    btn.addEventListener('click', () => {
        const { id, lastName, firstName, email } = btn.dataset;

        form.querySelector('[name="last_name"]').value = lastName;
        form.querySelector('[name="first_name"]').value = firstName;
        form.querySelector('[name="email"]').value = email;
        form.dataset.userId = id;
    });
}

function attachDeleteListener(btn) {
    btn.addEventListener('click', async () => {
        if (!confirm('Supprimer cet utilisateur ?')) return;

        const { id, url } = btn.dataset;

        try {
            const formData = new FormData();
            formData.append('_method', 'DELETE');

            const response = await sendRequest(url, 'POST', formData);

            if (response.success) {
                const row = document.querySelector(`#users-table tr[data-user-id="${id}"]`);
                if (row) row.remove();

            }
        } catch (err) {
            console.error('Erreur suppression:', err);
        }
    });
}

function updateTableRow(html, form) {
    const userId = form.dataset.userId;

    const tbody = document.querySelector('#users-table tbody');
    const existingRow = tbody.querySelector(`tr[data-user-id="${userId}"]`);

    if (!existingRow) return;

    existingRow.insertAdjacentHTML('afterend', html);
    existingRow.remove();

    const newRow = tbody.querySelector(`tr[data-user-id="${userId}"]`);
    const editBtn = newRow?.querySelector('.edit-user-btn');
    if (editBtn) attachEditListener(editBtn, form);
    const deleteBtn = newRow?.querySelector('.delete-user-btn');
    if (deleteBtn) attachDeleteListener(deleteBtn);
}

export function initUserForm() {
    const form = document.querySelector('#user-form');
    if (!form) return;

    document.querySelectorAll('.edit-user-btn').forEach(btn => {
        attachEditListener(btn, form);
    });

    document.querySelectorAll('.delete-user-btn').forEach(btn => {
        attachDeleteListener(btn);
    });

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const userId   = form.dataset.userId;
        const formData = new FormData(form);

        let url    = '/user/store';
        let method = 'POST';

        if (userId) {
            url    = `/user/${userId}/update`;
            method = 'POST';
            formData.append('_method', 'PATCH');
        }

        try {
            const response = await sendRequest(url, method, formData);

            if (response.success) {
                if (userId) {
                    updateTableRow(response.user, form);
                } else {
                    const tbody = document.querySelector('#users-table tbody');
                    const emptyRow = tbody.querySelector('td[colspan]')?.closest('tr');
                    if (emptyRow) emptyRow.remove();

                    tbody.insertAdjacentHTML('beforeend', response.html);

                    const newRow = tbody.lastElementChild;
                    const newEditBtn = newRow.querySelector('.edit-user-btn');
                    if (newEditBtn) attachEditListener(newEditBtn, form);
                    const newDeleteBtn = newRow.querySelector('.delete-user-btn');
                    if (newDeleteBtn) attachDeleteListener(newDeleteBtn);
                }

                form.reset();
                form.removeAttribute('data-user-id');

                const pwdInput = form.querySelector('[name="password"]');
                if (pwdInput) pwdInput.required = true;
            }

        } catch (err) {
            console.error('Erreur:', err);
        }
    });
}
