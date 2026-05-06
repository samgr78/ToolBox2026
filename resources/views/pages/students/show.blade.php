@extends('layouts.app')

@section('content')

    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-8">

        <div class="lg:col-span-3">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">
                        {{ $user->last_name }} {{ $user->first_name }}
                    </h1>
                </div>
            </div>
        </div>

        {{-- Infos étudiant --}}
        <div class="lg:col-span-3">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden dark:bg-gray-800">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-medium text-gray-800 dark:text-white">
                        Informations sur l'étudiant
                    </h3>
                </div>
                <div class="px-6 py-4 grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <div>
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1 text-left">Nom</p>
                        <p class="text-sm text-gray-800 dark:text-white text-left">{{ $user->last_name }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Prénom</p>
                        <p class="text-sm text-gray-800 dark:text-white">{{ $user->first_name }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1 text-right">Email</p>
                        <p class="text-sm text-gray-800 dark:text-white text-right">{{ $user->email }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tableau notes --}}
        <div class="lg:col-span-3">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden dark:bg-gray-800">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-800">
                            <tr class="text-xs font-semibold text-gray-500 uppercase tracking-wider dark:text-white">
                                <th class="px-6 py-3 text-left">Matières</th>
                                <th class="px-6 py-3 text-left">Note</th>
                                <th class="px-6 py-3 text-right">Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-800">
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-white">Python</td>
                                <td class="px-6 py-4 text-sm text-gray-400">15/20</td>
                                <td class="px-6 py-4 text-sm text-gray-400 text-right">06/05/2026</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-white">Laravel</td>
                                <td class="px-6 py-4 text-sm text-gray-400">8/20</td>
                                <td class="px-6 py-4 text-sm text-gray-400 text-right">01/05/2026</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection