<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // Get the count of stages
        $stagesCount = Stage::count();

        // Pass the variable to the view
        return view('dashboard', compact('stagesCount'));
    }
}