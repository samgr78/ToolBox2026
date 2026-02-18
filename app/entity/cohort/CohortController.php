<?php

namespace App\entity\cohort;

use App\Http\Controllers\Controller;
use App\entity\cohort\Cohort;

class CohortController extends Controller
{
    public function index(){
        $cohorts = auth()->user()->cohorts()->first();
        return view('pages.cohorts.index', compact('cohorts'));
    }

    public function store(CohortRequest $request, StoreCohortAction $storeAction){
        $dto=CohortDTO::fromRequest($request);
        $storeAction->execute($dto);
        return response()->json([
            'success' => true,
            'redirect' => route('cohort.index')
        ]);
    }

    public function update(CohortRequest $request, Cohort $cohort, StoreCohortAction $storeAction)
    {
        $dto = CohortDTO::fromRequest($request);
        $storeAction->execute($dto, $cohort);

        return response()->json([
            'success' => true,
            'redirect' => route('cohort.index')
        ]);
    }
}
