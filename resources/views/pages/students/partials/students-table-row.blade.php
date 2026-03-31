<tr class="hover:bg-gray-200 dark:hover:bg-gray-700 transition dark:text-white">
    <td class="px-6 py-4">
        <div>
            <a href="{{ route('user.show', $user->id) }}"
               class="text-sm font-semibold text-gray-900 hover:text-primary transition dark:text-white">
                {{ $user->last_name }}
            </a>
        </div>
    </td>

    <td class="px-6 py-4">
        <div>
            <a class="text-sm font-semibold text-gray-900 hover:text-primary transition dark:text-white">
                {{ $user->first_name }}
            </a>
        </div>
    </td>

    <td class="px-6 py-4">
        <div>
            <a class="text-sm font-semibold text-gray-900 hover:text-primary transition dark:text-white">
                {{ $user->email }}
            </a>
        </div>
    </td>

    <td class="px-6 py-4 flex gap-2">

        @can('update', $user)
            <button type="button" class="edit-user-btn kt-btn kt-btn-sm kt-btn-secondary" data-id="{{ $user->id }}" data-last-name="{{ $user->last_name }}" data-first-name="{{ $user->first_name }}" data-email="{{ $user->email }}">
                Modifier
            </button>
        @endcan

        @can('delete', $user)
            <form data-ajax-form
                  data-confirm="Etes vous sur ?"
                  action="{{ route('user.destroy', $user) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="delete-user-btn text-sm px-3 py-1 rounded-md bg-red-100 text-red-600 hover:bg-red-200">
                    Supprimer
                </button>
            </form>
        @endcan

    </td>

</tr>
