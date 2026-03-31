<div class="bg-white rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden dark:bg-gray-800">

    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 rounded-lg bg-indigo-100 dark:bg-indigo-900 flex items-center justify-center">
                <svg class="w-4 h-4 text-indigo-600 dark:text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-800 dark:text-white">
                Enseignants
            </h3>
            <span class="ml-1 inline-flex items-center px-2 py-0.5 text-xs font-semibold bg-indigo-100 text-indigo-700 dark:bg-indigo-900 dark:text-indigo-300 rounded-full">
                {{ $teachers->count() }}
            </span>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table id="teachers-table" class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-800">
            <tr class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider dark:text-gray-400">
                <th class="px-6 py-3">Enseignant</th>
                <th class="px-6 py-3">Email</th>
                @can('update', $cohort)
                    <th class="px-6 py-3">Actions</th>
                @endcan
            </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-800">

            @forelse($teachers as $teacher)
                @include('pages.cohorts.partials.teachers-table-row', ['user' => $teacher])
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center text-gray-400">
                        Aucun enseignant dans cette promotion.
                    </td>
                </tr>
            @endforelse

            </tbody>
        </table>
    </div>
</div>
