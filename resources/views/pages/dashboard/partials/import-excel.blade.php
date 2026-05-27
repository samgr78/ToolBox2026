<div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
    <h3 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Importer les Notes (Excel)</h3>

    <div class="mb-4 flex justify-end">
        <a href="{{ asset('files/Template_Excel_Toolbox.xlsx') }}" download="Template_Excel_Toolbox.xlsx">
            <button type="button" class="w-full sm:w-auto px-5 py-2.5 text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 rounded-lg transition-colors dark:bg-green-500 dark:hover:bg-green-600 focus:outline-none">
                Télécharger le modèle
            </button>
        </a>
    </div>

    <form id="importForm" class="space-y-4" data-rate-preview="{{ route('rate.preview') }}" data-rate-import="{{ route('rate.import') }}">
        @csrf

        <div class="flex-1 w-full">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">
                Choisir le fichier (.xlsx, .csv)
            </label>
            <input name="fichier_excel" id="file_input" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" type="file" required>
        </div>

        @if(session('success'))
            <p class="text-sm text-green-600 font-medium">{{ session('success') }}</p>
        @endif
        @if(session('error'))
            <p class="text-sm text-red-600 font-medium">{{ session('error') }}</p>
        @endif
    </form>
</div>

<!-- Modal de prévisualisation -->
<div id="previewModal" class="hidden fixed inset-0 bg-slate-900/30 dark:bg-slate-950/70 z-50 flex items-center justify-center p-4">
    <div class="bg-white dark:bg-gray-900 rounded-lg shadow-xl max-w-4xl w-full max-h-[90vh] overflow-auto border border-blue-200 dark:border-gray-700">
        <div class="sticky top-0 bg-blue-50 dark:bg-gray-800 border-b border-blue-200 dark:border-gray-700 p-6">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-blue-900 dark:text-white">Aperçu de votre fichier excel</h2>
                <button type="button" id="closeModalBtn" class="text-blue-500 bg-transparent hover:bg-blue-100 hover:text-blue-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white rounded-lg text-sm p-1.5">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
            <p class="text-sm text-blue-700 dark:text-gray-300 mt-2">
                <span id="recordCount" class="font-semibold text-blue-700 dark:text-white">0</span> enregistrement(s) à importer
            </p>
        </div>

        <div class="p-6">
            <div class="overflow-x-auto">
                <table id="previewTable" class="w-full text-sm text-left text-gray-700 dark:text-gray-200">
                    <thead class="text-xs text-blue-700 uppercase bg-blue-50 dark:bg-slate-900 dark:text-blue-300">
                    </thead>
                    <tbody id="previewTableBody" class="text-gray-700 dark:text-gray-200">
                    </tbody>
                </table>
            </div>
        </div>

        <div class="sticky bottom-0 bg-white dark:bg-gray-900 border-t border-blue-200 dark:border-gray-700 p-6 flex justify-end gap-3">
            <button type="button" id="confirmImportBtn" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 rounded-lg transition-colors focus:outline-none dark:bg-blue-500 dark:hover:bg-blue-600">
                Valider
            </button>
        </div>
    </div>
</div>

