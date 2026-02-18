<div class="kt-drawer kt-drawer-end w-[450px] m-5 rounded-xl border-input" id="cohort-drawer" data-kt-drawer="true">
    <div class="kt-drawer-header">
        <h3 class="kt-drawer-title">Ajouter une promotion</h3>
    </div>
    <div class="kt-drawer-content kt-scrollable-y">
        <form id="cohort-form" method="post" action="store">
            @csrf
            <div class="flex flex-col gap-4">
                <x-forms.input label="Nom" name="name" type="text" required />
                <x-forms.input label="Description" name="description" type="text" />
                <x-forms.input label="Début de l'année" name="start_date" type="date" required />
                <x-forms.input label="Fin de l'année" name="end_date" type="date" required />

                <div class="flex justify-end">
                    <button type="submit" class="kt-btn kt-btn-primary">Valider</button>
                </div>
            </div>
        </form>
    </div>
</div>
