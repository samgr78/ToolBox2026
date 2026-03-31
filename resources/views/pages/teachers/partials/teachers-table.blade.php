<div class="bg-white rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden dark:bg-gray-800">

    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
        <h3 class="text-lg font-medium text-gray-800 dark:text-white">
            Mes enseignants
        </h3>
    </div>

    <div class="overflow-x-auto">
        <table id="users-table" class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-800">
            <tr class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider dark:text-white">
                <th class="px-6 py-3">Nom</th>
                <th class="px-6 py-3">Prénom</th>
                <th class="px-6 py-3">Email</th>
            </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-800">

            @forelse($users as $user)
                @include('pages.teachers.partials.teachers-table-row')
            @empty
                <tr>
                    <td colspan="3" class="px-6 py-12 text-center text-gray-400">
                        Aucun enseignant pour le moment.
                    </td>
                </tr>
            @endforelse

            </tbody>
        </table>
    </div>
</div>
