<?php

namespace App\Entity\Cohort\Controllers;

use App\Entity\Cohort\Actions\StoreCohortAction;
use App\Entity\Cohort\DTO\CohortDTO;
use App\Entity\Cohort\Models\Cohort;
use App\Entity\Cohort\Requests\CohortRequest;
use App\Http\Controllers\Controller;
use App\Queries\CohortQuery;
use App\Queries\UserQuery;

class CohortController extends Controller
{
    public function index(){

        $this->authorize('viewAny', Cohort::class);
        $cohorts = auth()->user()->cohorts()->get();
        return view('pages.cohorts.index', compact('cohorts'));
    }

    public function show(Cohort $cohort)
    {
        $this->authorize('view', $cohort);
        $schoolId = auth()->user()->current_school_id;

        $teachers = CohortQuery::forCohort($cohort->id)->forSchool($schoolId)->forRole('teacher')->get();
        $students = CohortQuery::forCohort($cohort->id)->forSchool($schoolId)->forRole('student')->get();

        $existingTeacherIds = $teachers->pluck('id')->toArray();
        $existingStudentIds = $students->pluck('id')->toArray();

        $availableTeachers = UserQuery::forSchool($schoolId)->forRole('teacher')->excludeIds($existingTeacherIds)->get();

        $availableStudents = UserQuery::forSchool($schoolId)->forRole('student')->excludeIds($existingStudentIds)->get();

        return view('pages.cohorts.show', compact('cohort', 'teachers', 'students', 'availableTeachers', 'availableStudents',
        ));
    }

    public function store(CohortRequest $request, StoreCohortAction $storeAction){
        $this->authorize('create', Cohort::class);
        $dto     = CohortDTO::fromRequest($request);
        $results = $storeAction->execute($dto);

        return response()->json([
            'success' => true,
            'html' => $results['html'],
        ]);
    }

    public function update(CohortRequest $request, Cohort $cohort, StoreCohortAction $updateAction)
    {
        $this->authorize('update', $cohort);
        $dto = CohortDTO::fromRequest($request);
        $updateAction->execute($dto, $cohort);

        return response()->json([
            'success' => true,
            'redirect' => route('cohort.index')
        ]);
    }

    public function destroy(Cohort $cohort){
        $this->authorize('delete', $cohort);
        $cohort->delete();

        return response()->json([
            'success' => true,
            'id' => $cohort->id
        ]);
    }
}
