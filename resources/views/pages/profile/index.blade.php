@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Paramètres du profil</h1>
            <p class="text-gray-600 dark:text-gray-400">Gérez vos informations personnelles et la sécurité de votre compte.</p>
        </div>

        <div class="flex flex-col md:flex-row gap-8">

            <div class="flex-1 flex flex-col gap-8">

                <section id="general" class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Informations personnelles</h3>
                    </div>

                    <form data-ajax-form action="{{ route('profile.update') }}" method="POST" class="p-6">
                        @csrf
                        @method('PATCH')

                        <div class="flex flex-col gap-6">
                            <div class="flex items-center gap-5">
                                <img src="{{ $user->profile_photo_url }}" class="w-20 h-20 rounded-full object-cover border-2 border-gray-100 dark:border-gray-600">
                                <div>
                                    <p class="text-sm font-medium text-gray-700 dark:text-white">Votre avatar</p>
                                    <p class="text-xs text-gray-500">Utilisé pour vous identifier sur la plateforme.</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="flex flex-col gap-1">
                                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Nom</label>
                                    <x-forms.input name="last_name" value="{{ $user->last_name }}" required />
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Prénom</label>
                                    <x-forms.input name="first_name" value="{{ $user->first_name }}" required />
                                </div>
                            </div>

                            <div class="flex flex-col gap-1">
                                <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                                <x-forms.input name="email" type="email" value="{{ $user->email }}" required />
                            </div>

                            <div class="flex justify-end pt-2">
                                <button type="submit" class="kt-btn kt-btn-primary dark:text-white">
                                    Enregistrer les modifications
                                </button>
                            </div>
                        </div>
                    </form>
                </section>

                <section id="security" class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Changer le mot de passe</h3>
                    </div>

                    <form data-ajax-form action="{{ route('profile.update') }}" method="POST" class="p-6">
                        @csrf
                        @method('PATCH')

                        <input type="hidden" name="last_name" value="{{ $user->last_name }}">
                        <input type="hidden" name="first_name" value="{{ $user->first_name }}">
                        <input type="hidden" name="email" value="{{ $user->email }}">

                        <div class="flex flex-col gap-5">
                            <p class="text-sm text-gray-500">Pour assurer la sécurité de votre compte, utilisez un mot de passe complexe.</p>

                            <div class="flex flex-col gap-1">
                                <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Mot de passe actuel</label>
                                <x-forms.input name="current_password" type="password" placeholder="••••••••" required />
                            </div>

                            <div class="flex flex-col gap-1">
                                <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Nouveau mot de passe</label>
                                <x-forms.input name="password" type="password" placeholder="••••••••" required />
                            </div>

                            <div class="flex flex-col gap-1">
                                <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Confirmer le nouveau mot de passe</label>
                                <x-forms.input name="password_confirmation" type="password" placeholder="••••••••" required />
                            </div>

                            <div class="flex justify-end">
                                <button type="submit" class="kt-btn kt-btn-secondary dark:text-white">
                                    Mettre à jour le mot de passe
                                </button>
                            </div>
                        </div>
                    </form>
                </section>

            </div>
        </div>
    </div>
@endsection
