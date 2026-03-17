import { sendRequest } from "../../utils/fetch.js";
export function initUserForm() {
    const form = document.querySelector('#user-form');
    if (!form) return;

    document.querySelectorAll('.edit-user-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const { id, lastName, firstName, email, password } = btn.dataset;

            form.querySelector('[name="last_name"]').value = lastName;
            form.querySelector('[name="first_name"]').value = firstName;
            form.querySelector('[name="email"]').value = email;
            form.querySelector('[name="password"]').value = password;
            form.dataset.userId = id;

            form.querySelector('h3') &&
            (document.querySelector('h3').textContent = 'Modifier un enseignant');
        });
    });

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const userId  = form.dataset.userId;
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
                    updateTableRow(response.user);
                } else {
                    document.querySelector('#users-table tbody').innerHTML += response.html;
                }
                form.reset();
                form.removeAttribute('data-user-id');

                const pwdInput = form.querySelector('[name="password"]');
                if (pwdInput) pwdInput.required = true;

                const title = document.querySelector('h3');
                if (title) title.textContent = 'Ajouter un enseignant';
            }

        } catch (err) {
            console.error('Erreur:', err);
        }
    });
}
