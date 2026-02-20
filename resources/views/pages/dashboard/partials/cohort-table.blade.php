<div class="bg-white rounded-2xl shadow-sm border border-gray-100">

    <!-- Header -->
    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
        <div>
            <h3 class="text-lg font-semibold text-gray-800">
                Promotions
            </h3>
            <p class="text-sm text-gray-500">
                Liste des promotions récentes
            </p>
        </div>

        <a href="{{ route('cohort.index') }}"
           class="text-sm font-medium text-indigo-600 hover:text-indigo-700">
            Voir tout →
        </a>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
            <tr>
                <th class="px-6 py-3">Nom</th>
                <th class="px-6 py-3">Date début</th>
                <th class="px-6 py-3">Date fin</th>
                <th class="px-6 py-3 text-center">Étudiants</th>
            </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">
            @forelse($cohorts as $cohort)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-medium text-gray-800">
                        {{ $cohort->name }}
                    </td>

                    <td class="px-6 py-4 text-gray-600">
                        {{ \Carbon\Carbon::parse($cohort->start_date)->format('d/m/Y') }}
                    </td>

                    <td class="px-6 py-4 text-gray-600">
                        {{ \Carbon\Carbon::parse($cohort->end_date)->format('d/m/Y') }}
                    </td>

                    <td class="px-6 py-4 text-center">
                            <span class="px-3 py-1 text-xs font-semibold bg-indigo-100 text-indigo-600 rounded-full">
                                {{ $cohort->students_count ?? 0 }}
                            </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-6 text-center text-gray-500">
                        Aucune promotion enregistrée
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

</div>
