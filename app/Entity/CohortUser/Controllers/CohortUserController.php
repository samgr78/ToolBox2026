<?php

namespace App\Entity\CohortUser\Controllers;

use App\Entity\CohortUser\Actions\CohortUserAction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CohortUserController extends Controller
{
    public function store(Request $request, CohortUserAction $action)
    {
        $data = $request->only(['cohort_id', 'user_id', 'role']);

        $result = $action->execute($data);

        return response()->json([
            'success' => true,
            'html'    => $result['html'],
        ]);
    }
}
