<div class="bg-white rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden dark:bg-gray-800">

    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 rounded-lg bg-emerald-100 dark:bg-emerald-900 flex items-center justify-center">
                <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-800 dark:text-white">
                Étudiants
            </h3>
            <span class="ml-1 inline-flex items-center px-2 py-0.5 text-xs font-semibold bg-emerald-100 text-emerald-700 dark:bg-emerald-900 dark:text-emerald-300 rounded-full">
                {{ $students->count() }}
            </span>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table id="students-table" class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-800">
            <tr class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider dark:text-gray-400">
                <th class="px-6 py-3">Étudiant</th>
                <th class="px-6 py-3">Email</th>
                @can('update', $cohort)
                    <th class="px-6 py-3">Actions</th>
                @endcan
            </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-800">

            @forelse($students as $student)
                @include('pages.cohorts.partials.students-table-row', ['user' => $student])
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center text-gray-400">
                        Aucun étudiant dans cette promotion.
                    </td>
                </tr>
            @endforelse

            </tbody>
        </table>
    </div>
</div>
