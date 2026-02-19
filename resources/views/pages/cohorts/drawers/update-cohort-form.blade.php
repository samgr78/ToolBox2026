<div id="editDrawer" class="hidden fixed inset-0 bg-black/20 flex items-center justify-center z-50">
    <div class="bg-white rounded-xl p-6 w-full max-w-lg">
        <h2 class="text-lg font-semibold mb-4">Modifier la promotion</h2>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium">Nom</label>
                    <input id="edit_name" name="name" class="input w-full">
                </div>
                <div>
                    <label class="block text-sm font-medium">Description</label>
                    <textarea id="edit_description" name="description" class="input w-full"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium">Début</label>
                    <input type="date" id="edit_start" name="start_date" class="input w-full">
                </div>
                <div>
                    <label class="block text-sm font-medium">Fin</label>
                    <input type="date" id="edit_end" name="end_date" class="input w-full">
                </div>
            </div>
            <div class="mt-6 flex justify-end gap-3">
                <button type="button" onclick="closeEditDrawer()" class="px-4 py-2 bg-gray-100 rounded-md">
                    Annuler
                </button>
                <button type="submit" class="px-4 py-2 bg-primary text-black rounded-md">
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>
