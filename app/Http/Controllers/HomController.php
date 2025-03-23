<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use App\Models\Service;
use App\Models\Stagiaire;
use Illuminate\Http\Request;
use App\Models\Etablissement;
use Illuminate\Support\Facades\DB;

class HomController extends Controller
{
    // ✅ Show creation page
    public function create(Request $request)
    {
        $services = Service::all();
        $selectedService = $request->input('ID_service');

        return view('stagiaires.create', compact('services', 'selectedService'));
        return view('stagiaires.edit', compact('services', 'selectedService'));

    }

    // ✅ Store stagiaire with establishment and service
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:50|regex:/^[a-zA-ZÀ-ÿ\-\'\s]+$/u',
            'prénom' => 'required|string|max:50|regex:/^[a-zA-ZÀ-ÿ\-\'\s]+$/u',
            'email' => 'required|email|max:250',
            'téléphone' => 'required|regex:/^[0-9]{10}$/',
            'date_naissance' => 'required|date|before_or_equal:' . now()->subYears(18)->format('Y-m-d'),
            'nom_etablissement' => 'required|string|max:100',
            'ville' => 'required|string|max:50',
            'abréviation' => 'required|string|max:50',
            'niveau' => 'required|string|max:50',
            'specialite' => 'required|string|max:50',
            'ID_service' => 'required|exists:service,ID_service',
        ]);

        DB::beginTransaction();
        try {
            $etablissement = Etablissement::firstOrCreate([
                'nom_etablissement' => $validated['nom_etablissement'],
                'ville' => $validated['ville'],
                'abréviation' => $validated['abréviation'],
            ]);

            Stagiaire::create([
                'nom' => $validated['nom'],
                'prénom' => $validated['prénom'],
                'email' => $validated['email'],
                'téléphone' => $validated['téléphone'],
                'date_naissance' => $validated['date_naissance'],
                'ID_service' => $validated['ID_service'],
                'ID_etablissement' => $etablissement->ID_etablissement,
                'niveau' => $validated['niveau'],
                'specialite' => $validated['specialite'],
            ]);

            DB::commit();
            return redirect()->route('list')->with('success', 'Stagiaire ajouté avec succès !');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Erreur lors de l\'ajout du stagiaire.');
        }
    }

    // ✅ List all stagiaires
    public function list()
    {
        $stagiaires = Stagiaire::orderBy('nom', 'asc')->get();
        return view('list', compact('stagiaires'));
    }
    

    
    // ✅ Show edit page
    public function edit($id)
    {
        $stagiaire = Stagiaire::where('ID_stagiaire', $id)->firstOrFail();
        $etablissements = Etablissement::all();
        $services = Service::all();
        return view('stagiaires.edit', compact('stagiaire', 'etablissements', 'services'));
    }

    // ✅ Update stagiaire
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:50|regex:/^[a-zA-ZÀ-ÿ\-\'\s]+$/u',
            'prénom' => 'required|string|max:50|regex:/^[a-zA-ZÀ-ÿ\-\'\s]+$/u',
            'email' => 'required|email|max:250',
            'téléphone' => 'required|regex:/^[0-9]{10}$/',
            'date_naissance' => 'required|date|before_or_equal:' . now()->subYears(18)->format('Y-m-d') . '|after_or_equal:' . now()->subYears(100)->format('Y-m-d'),
            'niveau' => 'required|string|max:20',
            'specialite' => 'required|string|max:50|regex:/^[a-zA-ZÀ-ÿ\-\'\s]+$/u',
            'ID_etablissement' => 'required|integer|exists:etablissement,ID_etablissement',
            'ID_service' => 'required|integer|exists:service,ID_service',
            'nom_etablissement' => 'required|string|max:100|regex:/^[a-zA-ZÀ-ÿ\-\'\s]+$/u',
            'ville' => 'required|string|max:50|regex:/^[a-zA-ZÀ-ÿ\-\'\s]+$/u',
            'abréviation' => 'required|string|max:50|regex:/^[a-zA-ZÀ-ÿ\-\'\s]+$/u',
        ]);
    
        DB::beginTransaction();
        try {
            // Update or create the establishment
            $etablissement = Etablissement::find($validated['ID_etablissement']);
            if ($etablissement) {
                $etablissement->update([
                    'nom_etablissement' => $validated['nom_etablissement'],
                    'ville' => $validated['ville'],
                    'abréviation' => $validated['abréviation'],
                ]);
            }
    
            // Update the stagiaire
            $stagiaire = Stagiaire::findOrFail($id);
            $stagiaire->update([
                'nom' => $validated['nom'],
                'prénom' => $validated['prénom'],
                'email' => $validated['email'],
                'téléphone' => $validated['téléphone'],
                'date_naissance' => $validated['date_naissance'],
                'niveau' => $validated['niveau'],
                'specialite' => $validated['specialite'],
                'ID_etablissement' => $validated['ID_etablissement'],
                'ID_service' => $validated['ID_service'],
            ]);
    
            DB::commit();
            return redirect()->route('list')->with('success', 'Stagiaire mis à jour avec succès !');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Erreur lors de la mise à jour : ' . $e->getMessage());
        }
    }

    // ✅ Delete stagiaire
    public function destroy($id)
    {
        // Check if the stagiaire is linked to any stage
        $isRelated = Stage::where('id_stagiaire', $id)->exists();
    
        if ($isRelated) {
            return redirect()->route('list')->with('error', 'Impossible de supprimer ce stagiaire car il est associé à un stage. Veuillez d\'abord supprimer le stage.');
        }
    
        // Find the stagiaire by ID and delete it
        $stagiaire = Stagiaire::findOrFail($id);
        $stagiaire->delete();
    
        // Redirect back with a success message
        return redirect()->route('list')->with('success', 'Stagiaire supprimé avec succès !');
    }
    
}
