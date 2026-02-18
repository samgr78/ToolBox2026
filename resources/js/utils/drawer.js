/**
 * Open and close a drawer
 */
export function drawer(drawerId) {
    const drawerEl = document.querySelector(drawerId);
    if (!drawerEl) return null;

    const instance = KTDrawer.getInstance(drawerEl);
    if (!instance) return null;

    return {
        open: () => instance.show(),
        close: () => instance.hide(),
    };
}
