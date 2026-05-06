<div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
    <h3 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Importer les Notes (Excel)</h3>

    <div class="mb-4 flex justify-end">
        <a href="{{ asset('files/Template_Excel_Toolbox.xlsx') }}" download="Template_Excel_Toolbox.xlsx">
            <button type="button" class="w-full sm:w-auto px-5 py-2.5 text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 rounded-lg transition-colors dark:bg-green-500 dark:hover:bg-green-600 focus:outline-none">
                Télécharger le modèle
            </button>
        </a>
    </div>

    <form action="{{ route('rate.import') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div class="flex flex-col sm:flex-row items-end gap-4">
            <div class="flex-1 w-full">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">
                    Choisir le fichier (.xlsx, .csv)
                </label>
                <input name="fichier_excel" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file" required>
            </div>

            <button type="submit" class="w-full sm:w-auto px-5 py-2.5 text-sm font-medium text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 rounded-lg transition-colors dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none">
                Lancer l'importation
            </button>
        </div>

        @if(session('success'))
            <p class="text-sm text-green-600 font-medium">{{ session('success') }}</p>
        @endif
    </form>
</div>
