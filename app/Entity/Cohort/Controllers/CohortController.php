<?php

namespace App\Entity\Cohort\Controllers;

use App\Entity\Cohort\Actions\StoreCohortAction;
use App\Entity\Cohort\DTO\CohortDTO;
use App\Entity\Cohort\Models\Cohort;
use App\Entity\Cohort\Requests\CohortRequest;
use App\Http\Controllers\Controller;
use App\Entity\Cohort\Actions\UpdateCohortAction;

/**
 * Contrôleur gérant les opérations CRUD sur les cohortes.
 */
class CohortController extends Controller
{
    // Affiche la liste des cohorts de l'utilisateur connecté.
    public function index(){

        $this->authorize('viewAny', Cohort::class);
        $cohorts = auth()->user()->cohorts()->get();
        return view('pages.cohorts.index', compact('cohorts'));
    }

    // Affiche les détails d'une cohort spécifique.
    public function show(Cohort $cohort)
    {
        $this->authorize('view', $cohort);
        return view('pages.cohorts.show', compact('cohort'));
    }

    // Affiche le formulaire de création d'une nouvelle cohort.
    public function store(CohortRequest $request, StoreCohortAction $storeAction){
        $this->authorize('create', Cohort::class);
        $dto     = CohortDTO::fromRequest($request);
        $results = $storeAction->execute($dto);

        return response()->json([
            'success' => true,
            'html' => $results['html'],
        ]);
    }

    // Affiche le formulaire d'édition d'une cohort existante.
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

    // Supprime une cohort existante.
    public function destroy(Cohort $cohort){
        $this->authorize('delete', $cohort);
        $cohort->delete();

        return response()->json([
            'success' => true,
            'id' => $cohort->id
        ]);
    }
}
