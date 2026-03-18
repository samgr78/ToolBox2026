import { sendRequest } from "../../utils/fetch.js";

function attachEditListener(btn, form) {
    btn.addEventListener('click', () => {
        const { id, lastName, firstName, email, password } = btn.dataset;

        form.querySelector('[name="last_name"]').value = lastName;
        form.querySelector('[name="first_name"]').value = firstName;
        form.querySelector('[name="email"]').value = email;
        form.querySelector('[name="password"]').value = password;
        form.dataset.userId = id;
    });
}

export function initUserForm() {
    const form = document.querySelector('#user-form');
    if (!form) return;

    document.querySelectorAll('.edit-user-btn').forEach(btn => {
        attachEditListener(btn, form);
    });

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const userId= form.dataset.userId;
        const formData= new FormData(form);

        let url= '/user/store';
        let method= 'POST';

        if (userId) {
            url = `/user/${userId}/update`;
            method = 'POST';
            formData.append('_method', 'PATCH');
        }

        try {
            const response = await sendRequest(url, method, formData);

            if (response.success) {
                if (userId) {
                    updateTableRow(response.user);
                } else {
                    const tbody = document.querySelector('#users-table tbody');

                    const emptyRow = tbody.querySelector('td[colspan]')?.closest('tr');
                    if (emptyRow) emptyRow.remove();

                    tbody.insertAdjacentHTML('beforeend', response.html);

                    //attacher le listener sur la nouvelle ligne
                    const newEditBtn = tbody.lastElementChild.querySelector('.edit-user-btn');
                    if (newEditBtn) attachEditListener(newEditBtn, form);
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
