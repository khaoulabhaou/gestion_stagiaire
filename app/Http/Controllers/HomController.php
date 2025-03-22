<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stagiaire;
use App\Models\Etablissement;
use App\Models\Service;
use Illuminate\Support\Facades\DB;

class HomController extends Controller
{
    // ✅ Show creation page
    public function create(Request $request)
    {
        $services = Service::all();
        $selectedService = $request->input('ID_service');
        return view('stagiaires.create', compact('services', 'selectedService'));
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
            'niveau' => 'required|string|max:20',
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
            return redirect()->route('stagiaires.index')->with('success', 'Stagiaire ajouté avec succès !');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Erreur lors de l\'ajout du stagiaire.');
        }
    }

    // ✅ List all stagiaires
    public function index()
    {
        $stagiaires = Stagiaire::all();
        return view('stagiaires.index', compact('stagiaires'));
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
            'ID_etablissement' => 'required|integer',
            'nom_etablissement' => 'required|string|max:100|regex:/^[a-zA-ZÀ-ÿ\-\'\s]+$/u',
            'ville' => 'required|string|max:50|regex:/^[a-zA-ZÀ-ÿ\-\'\s]+$/u',
            'abréviation' => 'required|string|max:50|regex:/^[a-zA-ZÀ-ÿ\-\'\s]+$/u',
            'ID_service' => 'required|integer',
            'nom_service' => 'string|max:50|regex:/^[a-zA-ZÀ-ÿ\-\'\s]+$/u',
        ]);

        DB::beginTransaction();
        try {
            $etablissement = Etablissement::find($validated['ID_etablissement']);
            if ($etablissement) {
                $etablissement->update([
                    'nom_etablissement' => $validated['nom_etablissement'],
                    'ville' => $validated['ville'],
                    'abréviation' => $validated['abréviation'],
                ]);
            }

            $service = Service::find($validated['ID_service']);
            if ($service) {
                $service->update([
                    'nom_service' => $validated['nom_service'],
                ]);
            }

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

            return redirect()->route('stagiaires.index')->with('success', 'Stagiaire, service et établissement mis à jour avec succès !');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Erreur lors de la mise à jour : ' . $e->getMessage());
        }
    }

    // ✅ Delete stagiaire
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $stagiaire = Stagiaire::find($id);
            if (!$stagiaire) {
                return back()->with('error', 'Stagiaire not found.');
            }

            $serviceId = $stagiaire->ID_service;
            $etablissementId = $stagiaire->ID_etablissement;

            $stagiaire->delete();

            if ($serviceId) {
                $service = Service::find($serviceId);
                if ($service) {
                    $service->delete();
                }
            }

            if ($etablissementId) {
                $etablissement = Etablissement::find($etablissementId);
                if ($etablissement) {
                    $etablissement->delete();
                }
            }

            DB::commit();
            return redirect()->route('stagiaires.index')->with('success', 'Stagiaire, service et établissement supprimés avec succès !');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Erreur: ' . $e->getMessage());
        }
    }
}
