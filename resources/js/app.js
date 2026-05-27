import './bootstrap';
import Alpine from 'alpinejs';
import ApexCharts from 'apexcharts';

// flatpickr
import flatpickr from 'flatpickr';
import 'flatpickr/dist/flatpickr.min.css';
// FullCalendar
import { Calendar } from '@fullcalendar/core';

window.Alpine = Alpine;
window.ApexCharts = ApexCharts;
window.flatpickr = flatpickr;
window.FullCalendar = Calendar;

Alpine.start();

import './utils/thememode.js';
import './features/users/index.js';
import {bindAjaxForm} from "./utils/fetch.js";

// Initialize components on DOM ready
document.addEventListener('DOMContentLoaded', () => {
    bindAjaxForm();

    if (document.querySelector('#cohort-form')) {
        import('./features/cohorts/form.js').then(module => {
            module.initCohortForm();
            module.openEditDrawer();
        });
    }

    if (document.querySelector('#user-form')) {
        import('./features/users/form.js')
            .then(module => module.initUserForm());
    }

    if(document.querySelector('.cohort-delete-form')){
        import('./features/cohorts/form.js')
            .then(module=>module.destroy());
    }

});

