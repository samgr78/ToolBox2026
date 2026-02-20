export function openEditDrawer(id, name, description, start, end) {
    const form = document.getElementById('editForm');
    if (!form) return;

    form.action = '/cohort/' + id;
    document.getElementById('edit_name').value = name;
    document.getElementById('edit_description').value = description;
    document.getElementById('edit_start').value = start;
    document.getElementById('edit_end').value = end;
    document.getElementById('editDrawer').classList.remove('hidden');
}

export function closeEditDrawer() {
    document.getElementById('editDrawer').classList.add('hidden');
}
