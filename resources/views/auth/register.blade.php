@extends('layouts.guest')
@section('content')

    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 flex items-center justify-center px-4 py-10">
        <div class="w-full max-w-lg">

            <!-- Text Title -->
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Créer un compte</h1>
                <p class="text-sm text-gray-500 mt-1">Rejoignez votre espace ToolBox</p>
            </div>

            <!-- Register Form -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 dark:bg-gray-800">
                <div class="px-20 py-8 border-b border-gray-200 dark:border-gray-700 text-center">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">Inscription</h3>
                    <p class="text-sm text-gray-500">
                        Déjà un compte ?
                        <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-700 font-medium">
                            Se connecter
                        </a>
                    </p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="px-20 py-8 flex flex-col gap-4">
                    @csrf

                    <!-- Last name and first name -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="flex flex-col gap-1.5">
                            <label for="last_name" class="text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Nom
                            </label>
                            <input
                                id="last_name"
                                name="last_name"
                                type="text"
                                value="{{ old('last_name') }}"
                                placeholder="Doe"
                                required
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-sm text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                            />
                            @error('last_name')
                                <p class="text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label for="first_name" class="text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Prénom
                            </label>
                            <input
                                id="first_name"
                                name="first_name"
                                type="text"
                                value="{{ old('first_name') }}"
                                placeholder="John"
                                required
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-sm text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                            />
                            @error('first_name')
                                <p class="text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="flex flex-col gap-1.5">
                        <label for="email" class="text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Email
                        </label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            value="{{ old('email') }}"
                            placeholder="email@example.com"
                            required
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-sm text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                        />
                        @error('email')
                            <p class="text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- password and confirmation -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="flex flex-col gap-1.5">
                            <label for="password" class="text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Mot de passe
                            </label>
                            <input
                                id="password"
                                name="password"
                                type="password"
                                placeholder="••••••••"
                                required
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-sm text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                            />
                            @error('password')
                                <p class="text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label for="password_confirmation" class="text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Confirmation
                            </label>
                            <input
                                id="password_confirmation"
                                name="password_confirmation"
                                type="password"
                                placeholder="••••••••"
                                required
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-sm text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                            />
                            @error('password_confirmation')
                                <p class="text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Button -->
                    <button
                        type="submit"
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold py-2.5 px-4 rounded-lg transition focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 mt-2"
                    >
                        S'inscrire
                    </button>

                </form>
            </div>

        </div>
    </div>
@endsection