<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stage;   // Import Stage model
use App\Models\Stagiaire; // Import Stagiaire model
use App\Models\Service; // Import Service model

class StageController extends Controller
{
    public function create(Request $request)
    {
        // Fetch all services
        $services = Service::all();

        // Initialize variables
        $selectedService = $request->input('ID_service'); // Get the selected service ID from the request
        $stagiaires = [];

        // If a service is selected, fetch stagiaires for that service
        if ($selectedService) {
            $stagiaires = Stagiaire::where('service_id', $selectedService)->get();
        } else {
            // If no service is selected, fetch all stagiaires (optional)
            $stagiaires = Stagiaire::all();
        }

        // Pass data to the view
        return view('stages.ajouter', compact('services', 'stagiaires', 'selectedService'));
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