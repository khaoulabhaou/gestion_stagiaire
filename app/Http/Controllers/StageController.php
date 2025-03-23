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
            $stagiaires = Stagiaire::where('ID_service', $selectedService)->get();
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
            'date_début' => 'required|date',
            'date_fin' => 'required|date|after:date_début', // Ensure date_fin is strictly after date_début
            'description' => 'required|string',
            'ID_service' => 'required|exists:service,ID_service',
            'id_stagiaire' => 'required|exists:stagiaire,ID_stagiaire',
        ]);
    
        Stage::create([
            'titre' => $request->titre,
            'date_début' => $request->date_début,
            'date_fin' => $request->date_fin,
            'description' => $request->description,
            'ID_service' => $request->ID_service,
            'id_stagiaire' => $request->id_stagiaire,
        ]);
    
        return redirect()->route('stages.index')->with('success', 'Stage ajouté avec succès !');
    }
    public function index()
    {
        // Fetch stages with valid service and stagiaire relationships
        $stages = Stage::whereHas('service')
                       ->whereHas('stagiaire')
                       ->with(['service', 'stagiaire'])
                       ->get();
    
        return view('stages.list', compact('stages'));
    }
    public function edit($id)
    {
        // Fetch the stage by ID
        $stage = Stage::findOrFail($id);
    
        // Fetch all services and stagiaires for the dropdowns
        $services = Service::all();
        $stagiaires = Stagiaire::all();
    
        // Pass the data to the edit view
        return view('stages.edit', compact('stage', 'services', 'stagiaires'));
    }
    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'titre' => 'required|string|max:255',
            'date_début' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_début',
            'description' => 'required|string',
            'ID_service' => 'required|exists:service,ID_service',
            'id_stagiaire' => 'required|exists:stagiaire,ID_stagiaire',
        ]);
    
        // Find the stage by ID and update it
        $stage = Stage::findOrFail($id);
        $stage->update([
            'titre' => $request->titre,
            'date_début' => $request->date_début,
            'date_fin' => $request->date_fin,
            'description' => $request->description,
            'ID_service' => $request->ID_service,
            'id_stagiaire' => $request->id_stagiaire,
        ]);
    
        // Redirect back with a success message
        return redirect()->route('stages.index')->with('success', 'Stage mis à jour avec succès !');
    }
    public function destroy($id)
    {
        // Find the stage by ID and delete it
        $stage = Stage::findOrFail($id);
        $stage->delete();
    
        // Redirect back with a success message
        return redirect()->route('stages.index')->with('success', 'Stage supprimé avec succès !');
    }
    public function getStagiairesByService($serviceId)
    {
        $stagiaires = Stagiaire::where('ID_service', $serviceId)->get();
        return response()->json($stagiaires);
    }
}