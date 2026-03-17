<form method="post" action="{{ route('profile.email.update') }}">
    @csrf
    @method('patch')

    <div class="card">
        <div class="card-header" id="auth_email">
            <div>
                <h3 class="card-title text-gray-800 dark:text-white/90">
                    E-mail
                </h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Change your email address. A notification will be sent after the update.
                </p>
            </div>
        </div>

        <div class="card-body flex flex-col gap-6 p-5 sm:p-6">
            <div class="flex flex-col gap-2 xl:flex-row xl:items-start xl:gap-6">
                <label for="email" class="w-full xl:max-w-56 pt-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                    E-mail
                </label>

                <div class="w-full flex-1">
                    <input
                        id="email"
                        name="email"
                        type="email"
                        value="{{ old('email', auth()->user()->email) }}"
                        required
                        class="input w-full"
                    >

                    @if ($errors->has('email'))
                        <p class="mt-2 text-sm text-error-500">
                            {{ $errors->first('email') }}
                        </p>
                    @endif

                    @if (session('status') === 'email-updated')
                        <p class="mt-2 text-sm text-success-600 dark:text-success-500">
                            Email updated successfully.
                        </p>
                    @endif

                    @if (session('status') === 'email-unchanged')
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                            No changes detected.
                        </p>
                    @endif
                </div>
            </div>

            <div class="flex justify-end border-t border-gray-200 pt-4 dark:border-gray-800">
                <button type="submit" class="btn btn-primary">
                    Save Changes
                </button>
            </div>
        </div>
    </div>
</form>
