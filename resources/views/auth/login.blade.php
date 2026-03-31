@extends('layouts.guest')
@section('content')
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 flex items-center justify-center px-4">
        <div class="w-full max-w-lg">

            <!-- Text Title -->
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Bienvenue sur ToolBox</h1>
                <p class="text-sm text-gray-500 mt-1">Connectez-vous à votre espace</p>
            </div>

            <!-- Login Form -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 dark:bg-gray-800">
                <div class="px-20 py-8 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white text-center mb-4">Connexion</h3>
                    <p class="text-sm text-gray-500 mt-0.5">
                        Pas encore de compte ?
                        <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-700 font-medium">
                            S'inscrire
                        </a>
                    </p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="px-20 py-8 flex flex-col gap-5">
                    @csrf

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

                    <!-- Password -->
                    <div class="flex flex-col gap-1.5">
                        <div class="flex items-center justify-between">
                            <label for="password" class="text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Mot de passe
                            </label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-xs text-indigo-600 hover:text-indigo-700 font-medium">
                                    Mot de passe oublié ?
                                </a>
                            @endif
                        </div>
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

                    <!-- Remember me -->
                    <div class="flex items-center justify-center gap-2">
                        <input
                            id="remember"
                            name="remember"
                            type="checkbox"
                            class="w-4 h-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                        />
                        <label for="remember" class="text-sm text-gray-600 dark:text-gray-300">
                            Se souvenir de moi
                        </label>
                    </div>

                    <!-- Button -->
                    <button
                        type="submit"
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold py-2.5 px-4 rounded-lg transition focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    >
                        Se connecter
                    </button>

                </form>
            </div>

        </div>
    </div>
@endsection