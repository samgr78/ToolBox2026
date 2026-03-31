import { sendRequest } from "../../utils/fetch.js";

function attachDetachListener(btn) {
    btn.addEventListener('click', async () => {
        if (!confirm('Retirer cet utilisateur de la promotion ?')) return;

        const { id, url } = btn.dataset;

        try {
            const formData = new FormData();
            formData.append('_method', 'DELETE');

            const response = await sendRequest(url, 'POST', formData);

            if (response.success) {
                const row = btn.closest('tr');
                if (row) row.remove();
            }
        } catch (err) {
            console.error('Erreur détachement:', err);
        }
    });
}

function handleAttachFormSubmit(form, tableId) {
    if (!form) return;

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const formData = new FormData(form);
        const url = '/cohorts/attach-user';

        try {
            const response = await sendRequest(url, 'POST', formData);

            if (response.success) {
                const tbody = document.querySelector(`#${tableId} tbody`);

                if (tbody) {
                    const emptyRow = tbody.querySelector('td[colspan]')?.closest('tr');
                    if (emptyRow) emptyRow.remove();

                    tbody.insertAdjacentHTML('beforeend', response.html);

                    const newRow = tbody.lastElementChild;
                    const newDetachBtn = newRow.querySelector('.detach-user-btn');
                    if (newDetachBtn) attachDetachListener(newDetachBtn);
                }

                const select = form.querySelector('select');
                const selectedOption = select.options[select.selectedIndex];
                if (selectedOption && selectedOption.value) {
                    selectedOption.remove();
                }

                form.reset();
            }

        } catch (err) {
            console.error('Erreur lors de l\'ajout:', err);
        }
    });
}

export function initCohortUsers() {
    document.querySelectorAll('.detach-user-btn').forEach(btn => {
        attachDetachListener(btn);
    });

    const studentForm = document.querySelector('#add-student-form');
    const teacherForm = document.querySelector('#add-teacher-form');

    handleAttachFormSubmit(studentForm, 'students-table');
    handleAttachFormSubmit(teacherForm, 'teachers-table');
}
