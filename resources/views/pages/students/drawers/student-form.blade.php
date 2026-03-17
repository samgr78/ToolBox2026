<div class="bg-white rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 dark:bg-gray-800">

    <h3 class="text-lg font-medium text-gray-800 text-center mb-6 dark:text-white">
        Ajouter un étudiant 
    </h3>

    <form id="user-form">
        @csrf

        <div class="flex flex-col gap-4 max-w-md mx-auto w-full">

            <x-forms.input placeholder="Nom" name="last_name" type="text" required />
            <x-forms.input placeholder="Prénom" name="first_name" type="text" required />
            <x-forms.input placeholder="Email" name="email" type="email" required />
            <x-forms.input placeholder="Mot de passe" name="password" type="password" required />
            <x-forms.input hidden name="role" value="student" />

            <div class="flex justify-center pt-2">
                <button type="submit" class="kt-btn kt-btn-primary dark:text-white">
                    Valider
                </button>
            </div>

        </div>
    </form>

</div>

