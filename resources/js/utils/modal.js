export function modal(modalId) {
    const modalEl = document.querySelector(modalId);
    if (!modalEl) return null;

    if (modalEl.hasAttribute('data-kt-drawer')) {
        return {
            open: () => {
                modalEl.classList.add('kt-drawer-shown');
                document.body.classList.add('kt-drawer-overlay');
            },
            close: () => {
                modalEl.classList.remove('kt-drawer-shown');
                document.body.classList.remove('kt-drawer-overlay');
            },
        };
    }

    const instance = KTModal.getInstance(modalEl) || new KTModal(modalEl);
    return {
        open: () => instance.show(),
        close: () => instance.hide(),
    };
}
