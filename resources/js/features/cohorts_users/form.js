import { sendRequest } from "../../utils/fetch.js";

export function initCohortUsers() {
    const studentForm = document.querySelector('#add-student-form');
    const teacherForm = document.querySelector('#add-teacher-form');

    [studentForm, teacherForm].forEach(form => {
        if (!form) return;

        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            const formData = new FormData(form);
            const url = '/cohort/attach-user';

            try {
                const response = await sendRequest(url, 'POST', formData);

                if (response.success) {

                    const tableId = form.id === 'add-student-form' ? 'students-table' : 'teachers-table';
                    const tbody = document.querySelector(`#${tableId} tbody`);

                    if (tbody) {
                        tbody.insertAdjacentHTML('beforeend', response.html);
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
    });
}
