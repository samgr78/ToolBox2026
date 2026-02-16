import { sendRequest } from "@/utils/fetch.js";


export function initForm() {
    bindStore();
    bindUpdate();
}

/**
 * Binds the form submission event handler to the form element.
 */
function bindStore() {
    const form = document.querySelector('#store-client-form');

    form?.addEventListener('submit', (event) => {
        event.preventDefault();

        const formData = new FormData(event.target);

        sendRequest(route('cohort.store'), 'POST', formData).then((data) => {
            // si le serveur renvoie redirect, on redirige
            if (data.redirect) {
                window.location.href = data.redirect;
            }
        });
    });
}

/**
 * Binds the form submission event handler to the form element.
 */
function bindUpdate() {
    // recupere le formulaire et verifie si le formulaire est envoyé
    const form = document.querySelector('#update-client-form');
    form?.addEventListener('submit', (event) => {
        event.preventDefault();

        //on recupere les données du formulaire ainsi que le l'id du client (dans le fichier information.blade)
        const formData = new FormData(form);
        const clientId = form.dataset.clientId;

        //envoie vers la route d'update avec les informations
        sendRequest(route('cohort.update', clientId), 'POST', formData)
            .then(() => {
                console.log('notes enregistrés');
            });
    });
}
