<form method="post" action="{{ route('profile.password.update') }}">
    @csrf
    @method('put')

    <div class="card">
        <div class="card-header" id="auth_password">
            <div>
                <h3 class="card-title text-gray-800 dark:text-white/90">
                    Password
                </h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Use a strong password to keep your account secure.
                </p>
            </div>
        </div>

        <div class="card-body flex flex-col gap-6 p-5 sm:p-6">
            <div class="flex flex-col gap-2 xl:flex-row xl:items-start xl:gap-6">
                <label for="current_password" class="w-full xl:max-w-56 pt-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                    Current Password
                </label>

                <div class="w-full flex-1">
                    <input
                        id="current_password"
                        name="current_password"
                        type="password"
                        placeholder="Your current password"
                        class="input w-full"
                    >

                    @if ($errors->updatePassword->has('current_password'))
                        <p class="mt-2 text-sm text-error-500">
                            {{ $errors->updatePassword->first('current_password') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="flex flex-col gap-2 xl:flex-row xl:items-start xl:gap-6">
                <label for="password" class="w-full xl:max-w-56 pt-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                    New Password
                </label>

                <div class="w-full flex-1">
                    <input
                        id="password"
                        name="password"
                        type="password"
                        placeholder="New password"
                        class="input w-full"
                    >

                    @if ($errors->updatePassword->has('password'))
                        <p class="mt-2 text-sm text-error-500">
                            {{ $errors->updatePassword->first('password') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="flex flex-col gap-2 xl:flex-row xl:items-start xl:gap-6">
                <label for="password_confirmation" class="w-full xl:max-w-56 pt-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                    Confirm New Password
                </label>

                <div class="w-full flex-1">
                    <input
                        id="password_confirmation"
                        name="password_confirmation"
                        type="password"
                        placeholder="Confirm new password"
                        class="input w-full"
                    >

                    @if ($errors->updatePassword->has('password_confirmation'))
                        <p class="mt-2 text-sm text-error-500">
                            {{ $errors->updatePassword->first('password_confirmation') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 border-t border-gray-200 pt-4 dark:border-gray-800">
                @if (session('status') === 'password-updated')
                    <p class="text-sm text-success-600 dark:text-success-500">
                        Password updated.
                    </p>
                @endif

                <button class="btn btn-primary" type="submit">
                    Reset Password
                </button>
            </div>
        </div>
    </div>
</form>
