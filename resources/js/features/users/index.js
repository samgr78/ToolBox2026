import {bindEditListener, bindUserDeleted} from "./form.js";

document.addEventListener('DOMContentLoaded', function(event) {
    bindEditListener();
    bindUserDeleted();
});
