<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stagiaire;

class StagiaireController extends Controller
{
    public function getStagiaires($serviceId)
    {
        $stagiaires = Stagiaire::where('ID_service', $serviceId)->get();
        return response()->json($stagiaires);
    }
}
