<div class="bg-white rounded-2xl shadow-sm border border-gray-100">

    <!-- Header -->
    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
        <div>
            <h3 class="text-lg font-semibold text-gray-800">
                Promotions
            </h3>
            <p class="text-sm text-gray-500">
                Liste des enseignants récement ajoutés
            </p>
        </div>

        <a href="{{ route('teacher.index') }}"
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
                <th class="px-6 py-3">Prénom</th>
                <th class="px-6 py-3">Email</th>
                <th class="px-6 py-3">Nombre de formations affectées</th>
            </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">
            @forelse($teachers as $teacher)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-medium text-gray-800">
                        {{ $teacher->last_name }}
                    </td>

                    <td class="px-6 py-4 text-gray-600">
                        {{$teacher->first_name}}
                    </td>

                    <td class="px-6 py-4 text-gray-600">
                        {{$teacher->email}}
                    </td>

                    <td class="px-6 py-4 text-center">
                            <span class="px-3 py-1 text-xs font-semibold bg-indigo-100 text-indigo-600 rounded-full">
                                {{ $teacher->cohorts_count ?? 0 }}
                            </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-6 text-center text-gray-500">
                        Aucun enseignants
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

</div>
