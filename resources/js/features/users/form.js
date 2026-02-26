import { sendRequest } from "../../utils/fetch.js";
import { modal } from "../../utils/modal.js";

export function initUserForm() {
    bindStoreUser();
}

/**
 * Crée un utilisateur si `data-user-id` n'existe pas
 */
function bindStoreUser() {
    const form = document.querySelector('#user-form');
    if (!form) return;

    form.addEventListener('submit', (e) => {
        const userId = form.dataset.userId;

        if (!userId) {
            e.preventDefault();
            const formData = new FormData(form);

            sendRequest('/user/store', 'POST', formData)
                .then(response => {
                    if (response.redirect) {
                        window.location.href = response.redirect;
                    } else {
                        console.log('Utilisateur créé', response);
                        modal('#user-drawer').close();
                        window.location.reload();
                    }
                });
        }
    });
}