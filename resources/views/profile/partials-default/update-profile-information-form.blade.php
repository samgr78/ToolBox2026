<form method="post" action="{{ route('profile.update') }}">
    @csrf
    @method('patch')

    <div class="card" id="basic_settings">
        <div class="card-header">
            <div>
                <h3 class="card-title text-gray-800 dark:text-white/90">
                    Profile Information
                </h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Update your personal information.
                </p>
            </div>
        </div>

        <div class="card-body flex flex-col gap-6 p-5 sm:p-6">
            <div class="flex flex-col gap-2 xl:flex-row xl:items-start xl:gap-6">
                <label for="first_name" class="w-full xl:max-w-56 pt-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                    First Name
                </label>

                <div class="w-full flex-1">
                    <input
                        id="first_name"
                        name="first_name"
                        type="text"
                        value="{{ old('first_name', $user->first_name) }}"
                        required
                        autofocus
                        class="input w-full"
                    >

                    @if ($errors->has('first_name'))
                        <p class="mt-2 text-sm text-error-500">
                            {{ $errors->first('first_name') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="flex flex-col gap-2 xl:flex-row xl:items-start xl:gap-6">
                <label for="last_name" class="w-full xl:max-w-56 pt-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                    Last Name
                </label>

                <div class="w-full flex-1">
                    <input
                        id="last_name"
                        name="last_name"
                        type="text"
                        value="{{ old('last_name', $user->last_name) }}"
                        required
                        class="input w-full"
                    >

                    @if ($errors->has('last_name'))
                        <p class="mt-2 text-sm text-error-500">
                            {{ $errors->first('last_name') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 border-t border-gray-200 pt-4 dark:border-gray-800">
                @if (session('status') === 'profile-updated')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-success-600 dark:text-success-500"
                    >
                        Saved.
                    </p>
                @endif

                <button type="submit" class="btn btn-primary">
                    Save Changes
                </button>
            </div>
        </div>
    </div>
</form>
