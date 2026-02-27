<div class="bg-white rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden dark:bg-gray-800">

    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
        <h3 class="text-lg font-medium text-gray-800 dark:text-white">
            Mes promotions
        </h3>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-800">
            <tr class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider dark:text-white">
                <th class="px-6 py-3">Promotion</th>
                <th class="px-6 py-3">Année</th>
                <th class="px-6 py-3">Étudiants</th>
                @can('update', $cohorts->first())
                    <th class="px-6 py-3">Actions</th>
                @endcan
            </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-800">

            @forelse($cohorts as $cohort)
                <tr class="hover:bg-gray-200 dark:hover:bg-gray-700 transition dark:text-white">
                    <td class="px-6 py-4">
                        <div>
                            <a href="{{ route('cohort.show', $cohort->id) }}"
                               class="text-sm font-semibold text-gray-900 hover:text-primary transition dark:text-white">
                                {{ $cohort->name }}
                            </a>
                            <p class="text-sm text-gray-500 mt-1">
                                {{ $cohort->description }}
                            </p>
                        </div>
                    </td>

                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-3 py-1 text-xs font-medium bg-blue-100 text-blue-700 rounded-full">
                            {{ \Carbon\Carbon::parse($cohort->start_date)->format('Y') }}
                        </span>
                    </td>

                    <td class="px-6 py-4 text-sm font-medium text-gray-700 dark:text-white ">
                        {{ $cohort->users_count ?? $cohort->users->count() }}
                    </td>

                    <td class="px-6 py-4 flex gap-2">

                        @can('update', $cohort)
                            <button onclick="openEditDrawer('{{ $cohort->id }}', '{{ $cohort->name }}', '{{ e($cohort->description) }}', '{{ \Carbon\Carbon::parse($cohort->start_date)->format('Y-m-d') }}', '{{ \Carbon\Carbon::parse($cohort->end_date)->format('Y-m-d') }}')">
                                Modifier
                            </button>
                        @endcan

                        @can('delete', $cohort)
                            <form action="{{ route('cohort.destroy', $cohort->id) }}" method="POST" onsubmit="return confirm('Supprimer cette promotion ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sm px-3 py-1 rounded-md bg-red-100 text-red-600 hover:bg-red-200">
                                    Supprimer
                                </button>
                            </form>
                        @endcan

                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="3" class="px-6 py-12 text-center text-gray-400">
                        Aucune promotion pour le moment.
                    </td>
                </tr>
            @endforelse

            </tbody>
        </table>
    </div>
</div>
