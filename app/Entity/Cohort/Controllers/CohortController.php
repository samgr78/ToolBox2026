<?php

namespace App\Entity\Cohort\Controllers;

use App\Entity\Cohort\Actions\StoreCohortAction;
use App\Entity\Cohort\DTO\CohortDTO;
use App\Entity\Cohort\Models\Cohort;
use App\Entity\Cohort\Requests\CohortRequest;
use App\Http\Controllers\Controller;
use App\Entity\Cohort\Actions\UpdateCohortAction;

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
        return view('pages.cohorts.show', compact('cohort'));
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

    public function update(CohortRequest $request, Cohort $cohort, UpdateCohortAction $updateAction)
    {
        $this->authorize('update', $cohort);
        $dto = CohortDTO::fromRequest($request);
        $updateAction->execute($dto, $cohort);

        $html = view('pages.cohorts.partials.cohorts-table-row', compact('cohort'))->render();

        return response()->json([
            'success' => true,
            'html' => $html
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
