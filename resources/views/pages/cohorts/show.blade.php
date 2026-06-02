@extends('layouts.app')

@section('content')

    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-8">

        <div class="lg:col-span-3">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">
                        {{ $cohort->name }}
                    </h1>
                </div>
            </div>
        </div>

        {{-- Infos cohort --}}
        <div class="lg:col-span-3">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden dark:bg-gray-800">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-medium text-gray-800 dark:text-white">
                        Informations sur la promotion
                    </h3>
                </div>
                <div class="px-6 py-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div>
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Nom</p>
                        <p class="text-sm text-gray-800 dark:text-white">{{ $cohort->name }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Description</p>
                        <p class="text-sm text-gray-800 dark:text-white">{{ $cohort->description }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Date début</p>
                        <p class="text-sm text-gray-800 dark:text-white">{{ \Carbon\Carbon::parse($cohort->start_date)->format('d/m/Y') }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Date fin</p>
                        <p class="text-sm text-gray-800 dark:text-white">{{ \Carbon\Carbon::parse($cohort->end_date)->format('d/m/Y') }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Nombre d'étudiants</p>
                        <p class="text-sm text-gray-800 dark:text-white">{{ $cohort->students()->count() }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Nombre d'enseignants</p>
                        <p class="text-sm text-gray-800 dark:text-white">{{ $cohort->teachers()->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tableau des étudiants --}}
        <div class="lg:col-span-3">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden dark:bg-gray-800">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-medium text-gray-800 dark:text-white">
                        Étudiants dans la promotion
                    </h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-800">
                        <tr class="text-xs font-semibold text-gray-500 uppercase tracking-wider dark:text-white">
                            <th class="px-6 py-3 text-left">Nom</th>
                            <th class="px-6 py-3 text-left">Prénom</th>
                            <th class="px-6 py-3 text-left">Email</th>
                            <th class="px-6 py-3 text-left">Moyenne des notes</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-800">
                        @forelse ($cohort->students() as $student)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                <td class="px-6 py-4">
                                    <a href="{{ route('user.show', $student->id) }}" 
                                       class="text-sm font-semibold text-gray-900 hover:text-primary transition dark:text-white">
                                        {{ $student->last_name }}
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700 dark:text-white">
                                    {{ $student->first_name }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700 dark:text-white">
                                    {{ $student->email }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700 dark:text-white">
                                    @if($student->ratings->count() > 0)
                                        {{ round($student->ratings->avg('rate'), 2) }}/20
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-gray-400">
                                    Aucun étudiant dans cette promotion pour le moment.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Tableau des enseignants --}}
        <div class="lg:col-span-3">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden dark:bg-gray-800">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-medium text-gray-800 dark:text-white">
                        Enseignants assignés à la promotion
                    </h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-800">
                        <tr class="text-xs font-semibold text-gray-500 uppercase tracking-wider dark:text-white">
                            <th class="px-6 py-3 text-left">Nom</th>
                            <th class="px-6 py-3 text-left">Prénom</th>
                            <th class="px-6 py-3 text-left">Email</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-800">
                        @forelse ($cohort->teachers() as $teacher)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                <td class="px-6 py-4">
                                    <a href="{{ route('user.show', $teacher->id) }}" 
                                       class="text-sm font-semibold text-gray-900 hover:text-primary transition dark:text-white">
                                        {{ $teacher->last_name }}
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700 dark:text-white">
                                    {{ $teacher->first_name }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700 dark:text-white">
                                    {{ $teacher->email }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-12 text-center text-gray-400">
                                    Aucun enseignant assigné à cette promotion pour le moment.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

@endsection
