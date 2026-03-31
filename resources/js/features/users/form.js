import { sendRequest } from "../../utils/fetch.js";

export function bindEditListener() {
    const table = document.querySelector('#users-table');

    if(!table) return;

    table.addEventListener('click', function(event) {
        const editBtn = event.target.closest('.edit-user-btn');

        if(!editBtn) return;

        const form = document.querySelector('#user-form')
        const { id, lastName, firstName, email } = editBtn.dataset;

        form.querySelector('[name="last_name"]').value = lastName;
        form.querySelector('[name="first_name"]').value = firstName;
        form.querySelector('[name="email"]').value = email;
        form.dataset.userId = id;
    });
}

export function bindUserDeleted() {
    document.addEventListener('User.Deleted', function(event) {
        const formEl = event.target.closest('form');

        if(!formEl) return;

        const tRow = formEl.closest('tr');

        if(tRow) tRow.remove();
    })
}

function updateTableRow(html, form) {
    const userId = form.dataset.userId;

    const tbody = document.querySelector('#users-table tbody');
    const existingRow = tbody.querySelector(`tr[data-user-id="${userId}"]`);

    if (!existingRow) return;

    existingRow.insertAdjacentHTML('afterend', html);
    existingRow.remove();

    const newRow = tbody.querySelector(`tr[data-user-id="${userId}"]`);
}

export function initUserForm() {
    const form = document.querySelector('#user-form');
    if (!form) return;

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

        const tbody = document.querySelector('#users-table tbody');
        const emptyRow = tbody.querySelector('td[colspan]')?.closest('tr');
        try {
            const response = await sendRequest(url, method, formData);

            if (response.success) {
                if (userId) {
                    updateTableRow(response.user, form);
                } else {
                    // Delete the empty row in the first insert
                    if (emptyRow) emptyRow.remove();

                    if(tbody) tbody.insertAdjacentHTML('beforeend', response.html);
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
