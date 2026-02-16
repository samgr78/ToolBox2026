<?php

namespace App\entity\cohort;

use App\Http\Controllers\Controller;

class CohortController extends Controller
{
    public function index(){
        $cohorts = Cohort::all();
        return view('pages.cohorts.index', compact('cohorts'));
    }

    public function store(CohortRequest $request, StoreCohortAction $storeAction){
        $dto=CohortDTO::fromRequest($request);
        $cohort=$storeAction->execute($dto);
        return $cohort;
    }
}
