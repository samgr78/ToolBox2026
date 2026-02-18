/**
 * Open and close a modal dialog
 */
export function modal(modalId) {
    const modalEl = document.querySelector(modalId);
    if (!modalEl) return null;

    const instance = KTModal.getInstance(modalEl);
    if (!instance) return null;

    return {
        open: () => instance.show(),
        close: () => instance.hide(),
    };
}
