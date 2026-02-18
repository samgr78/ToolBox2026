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
            KTToast.show({
                message: json.message,
                variant: 'destructive',
            });
            throw { status: response.status, ...json };
        }

        // Handling 200
        if(response.status === 200 && json.message) {
            KTToast.show({
                message: json.message,
                variant: 'success',
            });
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
