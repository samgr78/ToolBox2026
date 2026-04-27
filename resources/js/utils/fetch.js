import Toastify from "toastify-js";
import "toastify-js/src/toastify.css";

export async function sendRequest(url, method = 'POST', data = {}) {
    let body    = null,
        headers = {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                .getAttribute('content'),
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        };

    // If it's a formData or a simple
    if (data instanceof FormData) {
        body = data;
    } else if (method !== 'GET') {
        headers['Content-Type'] = 'application/json';
        body = JSON.stringify(data);
    }

    return await fetch(url, {method, headers, body
    }).then(async response => {
        const json = await response.json();

        // Handling 422
        if(response.status === 422) {
            Toastify({
                text: json.message,
                duration: 4000,
                gravity: "top",
                position: "right",
                backgroundColor: "#ef4444", // red-500
            }).showToast();
            throw { status: response.status, ...json };
        }

        // Handling 200
        if(response.status === 200 && json.message) {
            Toastify({
                text: json.message,
                duration: 3000,
                gravity: "top",
                position: "right",
                backgroundColor: "#22c55e", // green-500 Tailwind
                stopOnFocus: true,
            }).showToast();
        }

        // If network error
        if(!response.ok) {
            KTToast.show({
                message: json.message,
                variant: 'destructive',
            });
            throw { status: response.status, ...json };
        }

        return {status: response.status, ...json};
    });
}

export function bindAjaxForm() {
    document.addEventListener('submit',  function(event) {
       const formEl = event.target.closest('[data-ajax-form]');

       if(!formEl) return;

       event.preventDefault();

       const shouldConfirm = formEl.dataset.confirm ?? null;

       if(shouldConfirm && !confirm(shouldConfirm)) return;

        const url = formEl.getAttribute('action');
        const method = formEl.getAttribute('method');
        const formData = new FormData(formEl);

        sendRequest(url, method, formData).then(response => {
            if(response.customEvent) {
                formEl.dispatchEvent(new CustomEvent(response.customEvent, {
                    bubbles: true
                }));
            }
        });
    });
}
