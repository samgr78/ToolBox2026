<form method="post" action="{{ route('profile.photo.update') }}" enctype="multipart/form-data">
    @csrf

    <div class="card">
        <div class="card-header" id="profile_photo">
            <div>
                <h3 class="card-title text-gray-800 dark:text-white/90">
                    Profile Photo
                </h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Upload a new profile picture for your account.
                </p>
            </div>
        </div>

        <div class="card-body flex flex-col gap-6 p-5 sm:p-6">
            <div class="flex flex-col gap-3 xl:flex-row xl:items-start xl:gap-6">
                <label class="w-full xl:max-w-56 pt-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                    Current Photo
                </label>

                <div class="w-full flex-1">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center">
                        <img
                            src="{{ auth()->user()->profile_photo_url }}"
                            alt="Profile photo"
                            class="h-20 w-20 rounded-full border border-gray-200 object-cover dark:border-gray-700"
                        >

                        <div class="flex-1">
                            <input
                                type="file"
                                name="photo"
                                accept=".jpg,.jpeg,.png,.webp"
                                class="input w-full"
                            >

                            <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                                Accepted formats: JPG, PNG, WEBP. Max size: 2 MB.
                            </p>
                        </div>
                    </div>

                    @error('photo')
                    <p class="mt-2 text-sm text-error-500">{{ $message }}</p>
                    @enderror

                    @if (session('status') === 'photo-updated')
                        <p class="mt-2 text-sm text-success-600 dark:text-success-500">
                            Photo updated successfully.
                        </p>
                    @endif
                </div>
            </div>

            <div class="flex justify-end border-t border-gray-200 pt-4 dark:border-gray-800">
                <button type="submit" class="btn btn-primary">
                    Upload Photo
                </button>
            </div>
        </div>
    </div>
</form>
