<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stage;   // Import Stage model
use App\Models\Stagiaire; // Import Stagiaire model
use App\Models\Service; // Import Service model

class StageController extends Controller
{
    public function create()
    {
        $services = Service::all();
        $stagiaires = Stagiaire::all();
    
        return view('stages.ajouter', compact('services', 'stagiaires'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'description' => 'required|string',
            'ID_service' => 'required|exists:services,id',
            'ID_stagiaire' => 'required|exists:stagiaires,id',
        ]);

        Stage::create([
            'titre' => $request->titre,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'description' => $request->description,
            'ID_service' => $request->ID_service,
            'ID_stagiaire' => $request->ID_stagiaire,
        ]);

        return redirect()->route('stages.create')->with('success', 'Stage ajouté avec succès !');
    }
}
