<tr data-id="{{ $user->id }}" class="hover:bg-gray-50 dark:hover:bg-gray-700 transition dark:text-white">

    <td class="px-6 py-4">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-full bg-indigo-100 dark:bg-indigo-900 flex items-center justify-center flex-shrink-0">
                <span class="text-sm font-semibold text-indigo-600 dark:text-indigo-300">
                    {{ strtoupper(substr($user->first_name, 0, 1)) }}{{ strtoupper(substr($user->last_name, 0, 1)) }}
                </span>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-900 dark:text-white">
                    {{ $user->first_name }} {{ $user->last_name }}
                </p>
            </div>
        </div>
    </td>

    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300">
        {{ $user->email }}
    </td>

    @can('update', $cohort)
        <td class="px-6 py-4">
            <form class="remove-teacher-form" data-user-id="{{ $user->id }}" data-cohort-id="{{ $cohort->id }}">
                @csrf
                <button type="submit"
                        class="text-sm px-3 py-1 rounded-md bg-red-100 text-red-600 hover:bg-red-200 dark:bg-red-900 dark:text-red-300 dark:hover:bg-red-800 transition">
                    Retirer
                </button>
            </form>
        </td>
    @endcan

</tr>
