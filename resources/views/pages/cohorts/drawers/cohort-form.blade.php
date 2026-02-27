<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">

    <h3 class="text-lg font-medium text-gray-800 text-center mb-6">
        Ajouter une promotion
    </h3>

    <form id="cohort-form">
        @csrf

        <div class="flex flex-col gap-4 max-w-md mx-auto w-full">

            <x-forms.input class="border-b" placeholder="Nom" name="name" type="text" required />
            <x-forms.input class="border-b" placeholder="Description" name="description" type="text" />
            <x-forms.input label="Début de l'année" name="start_date" type="date" required />
            <x-forms.input label="Fin de l'année" name="end_date" type="date" required />

            <div class="flex justify-center pt-2">
                <button type="submit" class="kt-btn kt-btn-primary">
                    Valider
                </button>
            </div>

        </div>
    </form>

</div>
