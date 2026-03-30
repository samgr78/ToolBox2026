<div class="bg-white rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 dark:bg-gray-800">

    <div class="flex items-center gap-2 mb-6">
        <div class="w-8 h-8 rounded-lg bg-emerald-100 dark:bg-emerald-900 flex items-center justify-center">
            <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
        </div>
        <h3 class="text-lg font-medium text-gray-800 dark:text-white">
            Ajouter un étudiant
        </h3>
    </div>

    <form id="add-student-form">
        @csrf
        <input type="hidden" name="cohort_id" value="{{ $cohort->id }}">
        <input type="hidden" name="role" value="student">

        <div class="flex flex-col gap-4 max-w-md mx-auto w-full">

            <div class="flex flex-col gap-1">
                <label for="student_user_id" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                    Étudiant
                </label>
                <select
                    id="student_user_id"
                    name="user_id"
                    required
                    class="block w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white px-3 py-2 text-sm shadow-sm focus:border-primary focus:ring-1 focus:ring-primary transition"
                >
                    <option value="" disabled selected>Sélectionner un étudiant...</option>
                    @foreach($availableStudents as $student)
                        <option value="{{ $student->id }}">
                            {{ $student->first_name }} {{ $student->last_name }} — {{ $student->email }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-center pt-2">
                <button type="submit" class="kt-btn kt-btn-primary dark:text-white">
                    Ajouter
                </button>
            </div>

        </div>
    </form>

</div>
