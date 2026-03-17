<form method="post" action="{{ route('profile.destroy') }}">
    @csrf
    @method('delete')

    <div class="card" id="delete_account">
        <div class="card-header">
            <h3 class="card-title">
                Delete Account
            </h3>
        </div>

        <div class="card-body grid gap-5">
            <div class="w-full">
                <p class="text-sm text-gray-600">
                    Once your account is deleted, all of its resources and data will be permanently deleted.
                    Please enter your password to confirm this action.
                </p>
            </div>

            <div class="w-full">
                <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                    <label class="form-label max-w-56">
                        Password
                    </label>

                    <div class="flex flex-col grow gap-2 w-full">
                        <input
                            name="password"
                            class="input w-full"
                            placeholder="Enter your password"
                            type="password"
                        >

                        @if ($errors->userDeletion->has('password'))
                            <p class="text-sm text-red-600">
                                {{ $errors->userDeletion->first('password') }}
                            </p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-2.5">
                <button
                    type="submit"
                    class="btn btn-danger"
                    onclick="return confirm('Are you sure you want to delete your account?')"
                >
                    Delete Account
                </button>
            </div>
        </div>
    </div>
</form>
