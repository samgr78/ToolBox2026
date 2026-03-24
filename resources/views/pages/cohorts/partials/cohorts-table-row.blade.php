<tr data-cohort-id="{{ $cohort->id }}" class="hover:bg-gray-200 dark:hover:bg-gray-700 transition dark:text-white">
    <td class="px-6 py-4">
        <div>
            <a href="{{ route('cohort.show', $cohort->id) }}"
               class="text-sm font-semibold text-gray-900 hover:text-primary transition dark:text-white">
                {{ $cohort->name }}
            </a>
            <p class="text-sm text-gray-500 mt-1">
                {{ $cohort->description }}
            </p>
        </div>
    </td>

    <td class="px-6 py-4">
        <span class="inline-flex items-center px-3 py-1 text-xs font-medium bg-blue-100 text-blue-700 rounded-full">
            {{ \Carbon\Carbon::parse($cohort->start_date)->format('Y') }}
        </span>
    </td>

    <td class="px-6 py-4 text-sm font-medium text-gray-700 dark:text-white">
        {{ $cohort->users_count ?? $cohort->users->count() }}
    </td>

    <td class="px-6 py-4 flex gap-2">

        @can('update', $cohort)
            <button
                class="edit-cohort-btn text-sm px-3 py-1 rounded-md bg-blue-100 text-blue-600 hover:bg-blue-200"
                data-id="{{ $cohort->id }}"
                data-name="{{ $cohort->name }}"
                data-description="{{ e($cohort->description) }}"
                data-start-date="{{ \Carbon\Carbon::parse($cohort->start_date)->format('Y-m-d') }}"
                data-end-date="{{ \Carbon\Carbon::parse($cohort->end_date)->format('Y-m-d') }}"
            >
                Modifier
            </button>
        @endcan

        @can('delete', $cohort)
            <button
                class="delete-cohort-btn text-sm px-3 py-1 rounded-md bg-red-100 text-red-600 hover:bg-red-200"
                data-id="{{ $cohort->id }}"
                data-url="/cohort/{{ $cohort->id }}"
            >
                Supprimer
            </button>
        @endcan

    </td>
</tr>
