<div class="bg-white rounded-2xl shadow-sm border border-gray-100">

    <!-- Header -->
    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
        <div>
            <h3 class="text-lg font-semibold text-gray-800">
                Etudiant
            </h3>
            <p class="text-sm text-gray-500">
                Liste des étudiants récement ajoutés
            </p>
        </div>

        <a href="{{ route('student.index') }}"
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
            </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">
            @forelse($students as $student)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-medium text-gray-800">
                        {{ $student->last_name }}
                    </td>

                    <td class="px-6 py-4 text-gray-600">
                        {{$student->first_name}}
                    </td>

                    <td class="px-6 py-4 text-gray-600">
                        {{$student->email}}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-6 text-center text-gray-500">
                        Aucun étudiants
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

</div>
