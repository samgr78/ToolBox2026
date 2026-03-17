import {sendRequest} from "../../utils/fetch.js";

console.log('user.js chargé');
export function initUserForm() {
    const form = document.querySelector('#user-form');
    if (!form) return;

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const userId = form.dataset.userId;
        const formData = new FormData(form);
        const role =form.dataset.role;

        let url = '/user/store';
        let method = 'POST';

        if (userId) {
            url = `/user/${userId}`;
            formData.append('_method', 'PATCH');
        }

        try {
            const response = await sendRequest(url, method, formData);

            if (response.success) {
                document.querySelector('#users-table tbody').innerHTML += response.html;
            }

        } catch (err) {
            if (err.status === 422 && err.errors) {
                //displayValidationErrors(err.errors);
            }
        }
    });
}
