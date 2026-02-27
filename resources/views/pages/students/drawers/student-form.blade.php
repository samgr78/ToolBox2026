<div class="kt-drawer kt-drawer-end w-[450px] m-5 rounded-xl border-input" id="student-drawer" data-kt-drawer="true">
    <div class="kt-drawer-header">
        <h3 class="kt-drawer-title">Ajouter un étudiant</h3>
    </div>
    <div class="kt-drawer-content kt-scrollable-y">
        <form id="student-form" method="post" action="store">
            @csrf
            <div class="flex flex-col gap-4">
                <x-forms.input label="Prenom" name="first_name" type="text" />
                <x-forms.input label="Nom" name="last_name" type="text" />
                <x-forms.input label="Email" name="email" type="email" required />
                <x-forms.input label="Mot de passe" name="password" type="password" required />

                <div class="flex justify-end">
                    <button type="submit" class="kt-btn kt-btn-primary">Valider</button>
                </div>
            </div>
        </form>
    </div>
</div>
