<?php

namespace App\Http\Controllers;

use App\Models\Encadrant;
use App\Models\Stage;
use App\Models\Stagiaire;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // Get the count of stages
        $stagesCount = Stage::count();
        $stagiairesCount = Stagiaire::count();
        $encadrantsCount = Encadrant::count();

        // Pass the variable to the view
        return view('dashboard', compact('stagesCount','stagiairesCount','encadrantsCount'));
    }
}