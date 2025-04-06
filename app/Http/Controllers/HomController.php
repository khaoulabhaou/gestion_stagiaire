<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use App\Models\Service;
use App\Models\Stagiaire;
use Illuminate\Http\Request;
use App\Models\Etablissement;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class HomController extends Controller
{
    public function create(Request $request)
    {
        $services = Service::all();
        $selectedService = $request->input('ID_service');

        return view('stagiaires.create', compact('services', 'selectedService'));
    }

    public function index(Request $request)
    {
        $search = $request->query('search');
        
        $stagiaires = Stagiaire::with(['service', 'etablissement'])
            ->when($search, function($query) use ($search) {
                $query->where(function($q) use ($search) {
                    $q->where('nom', 'like', "%{$search}%")
                      ->orWhere('prénom', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('téléphone', 'like', "%{$search}%")
                      ->orWhere('niveau', 'like', "%{$search}%")
                      ->orWhere('specialite', 'like', "%{$search}%")
                      ->orWhereHas('service', function($q) use ($search) {
                          $q->where('nom_service', 'like', "%{$search}%");
                      })
                      ->orWhereHas('etablissement', function($q) use ($search) {
                          $q->where('nom_etablissement', 'like', "%{$search}%")
                            ->orWhere('ville', 'like', "%{$search}%")
                            ->orWhere('abréviation', 'like', "%{$search}%");
                      });
                });
            })
            ->orderBy('nom', 'asc')
            ->paginate(10);

        return view('list', compact('stagiaires', 'search'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:50|regex:/^[a-zA-ZÀ-ÿ\-\'\s]+$/u',
            'prénom' => 'required|string|max:50|regex:/^[a-zA-ZÀ-ÿ\-\'\s]+$/u',
            'email' => 'required|email|max:250|unique:stagiaire,email',
            'téléphone' => 'required|regex:/^[0-9]{10}$/|unique:stagiaire,téléphone',
            'date_naissance' => 'required|date|before_or_equal:' . now()->subYears(18)->format('Y-m-d'),
            'nom_etablissement' => 'required|string|max:100|regex:/^[a-zA-ZÀ-ÿ\-\'\s]+$/u',
            'ville' => 'required|string|max:50|regex:/^[a-zA-ZÀ-ÿ\-\'\s]+$/u',
            'abréviation' => 'required|string|max:50|regex:/^[a-zA-ZÀ-ÿ\-\'\s]+$/u',
            'niveau' => 'required|string|max:50',
            'specialite' => 'required|string|max:50',
            'ID_service' => 'required|exists:service,ID_service',
        ], [
            'nom.regex' => 'Le nom ne doit contenir que des lettres et des accents.',
            'prénom.regex' => 'Le prénom ne doit contenir que des lettres et des accents.',
            'email.email' => 'L\'adresse email n\'est pas valide.',
            'email.unique' => 'L\'adresse email existe déjà.',
            'téléphone.regex' => 'Le numéro de téléphone doit être un numéro valide à 10 chiffres.',
            'téléphone.unique' => 'Le numéro de téléphone existe déjà.',
            'date_naissance.before_or_equal' => 'Vous devez avoir au moins 18 ans.',
            'nom_etablissement.regex' => 'Le nom de l\'établissement ne doit contenir que des lettres et des accents.',
            'ville.regex' => 'La ville ne doit contenir que des lettres et des accents.',
            'abréviation.regex' => 'L\'abréviation ne doit contenir que des lettres et des accents.',
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

    public function list(Request $request)
    {
        $search = $request->query('search');
        
        $stagiaires = Stagiaire::with(['service', 'etablissement'])
            ->when($search, function($query) use ($search) {
                $query->where(function($q) use ($search) {
                    $q->where('nom', 'like', "%{$search}%")
                      ->orWhere('prénom', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('téléphone', 'like', "%{$search}%")
                      ->orWhereHas('service', function($q) use ($search) {
                          $q->where('nom_service', 'like', "%{$search}%");
                      })
                      ->orWhereHas('etablissement', function($q) use ($search) {
                          $q->where('nom_etablissement', 'like', "%{$search}%");
                      });
                });
            })
            ->orderBy('nom', 'asc')
            ->paginate(10);

        return view('list', compact('stagiaires', 'search'));
    }

    public function edit($id)
    {
        $stagiaire = Stagiaire::where('ID_stagiaire', $id)->firstOrFail();
        $etablissements = Etablissement::all();
        $services = Service::all();
        return view('stagiaires.edit', compact('stagiaire', 'etablissements', 'services'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:50|regex:/^[a-zA-ZÀ-ÿ\-\'\s]+$/u',
            'prénom' => 'required|string|max:50|regex:/^[a-zA-ZÀ-ÿ\-\'\s]+$/u',
            'email' => 'required|email|max:250|unique:stagiaire,email,' . $id . ',ID_stagiaire',
            'téléphone' => 'required|regex:/^[0-9]{10}$/|unique:stagiaire,téléphone,' . $id . ',ID_stagiaire',
            'date_naissance' => 'required|date|before_or_equal:' . now()->subYears(18)->format('Y-m-d') . '|after_or_equal:' . now()->subYears(100)->format('Y-m-d'),
            'niveau' => 'required|string|max:20',
            'specialite' => 'required|string|max:50|regex:/^[a-zA-ZÀ-ÿ\-\'\s]+$/u',
            'ID_etablissement' => 'required|integer|exists:etablissement,ID_etablissement',
            'ID_service' => 'required|integer|exists:service,ID_service',
            'nom_etablissement' => 'required|string|max:100|regex:/^[a-zA-ZÀ-ÿ\-\'\s]+$/u',
            'ville' => 'required|string|max:50|regex:/^[a-zA-ZÀ-ÿ\-\'\s]+$/u',
            'abréviation' => 'required|string|max:50|regex:/^[a-zA-ZÀ-ÿ\-\'\s]+$/u',
        ], [
            'nom.regex' => 'Le nom ne doit contenir que des lettres et des accents.',
            'prénom.regex' => 'Le prénom ne doit contenir que des lettres et des accents.',
            'email.email' => 'L\'adresse email n\'est pas valide.',
            'email.unique' => 'L\'adresse email existe déjà.',
            'téléphone.regex' => 'Le numéro de téléphone doit être un numéro valide à 10 chiffres.',
            'téléphone.unique' => 'Le numéro de téléphone existe déjà.',
            'date_naissance.before_or_equal' => 'Vous devez avoir au moins 18 ans.',
            'specialite.regex' => 'La spécialité ne doit contenir que des lettres et des accents.',
            'nom_etablissement.regex' => 'Le nom de l\'établissement ne doit contenir que des lettres et des accents.',
            'ville.regex' => 'La ville ne doit contenir que des lettres et des accents.',
            'abréviation.regex' => 'L\'abréviation ne doit contenir que des lettres et des accents.',
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

    public function destroy($id)
    {
        $isRelated = Stage::where('id_stagiaire', $id)->exists();

        if ($isRelated) {
            return redirect()->route('list')->with('error', 'Impossible de supprimer ce stagiaire car il est associé à un stage. Veuillez d\'abord supprimer le stage.');
        }

        $stagiaire = Stagiaire::findOrFail($id);
        $stagiaire->delete();

        return redirect()->route('list')->with('success', 'Stagiaire supprimé avec succès !');
    }

    public function archive(Request $request)
    {
        $search = $request->query('search');
        $currentDate = now()->format('Y-m-d');
        
        $query = Stagiaire::with(['service', 'etablissement'])
            ->whereHas('stages', function($q) use ($currentDate) {
                $q->where('date_fin', '<', $currentDate);
            })
            ->with(['stages' => function($q) use ($currentDate) {
                $q->where('date_fin', '<', $currentDate)
                  ->orderBy('date_fin', 'desc');
            }]);
    
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nom', 'like', "%{$search}%")
                  ->orWhere('prénom', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('téléphone', 'like', "%{$search}%")
                  ->orWhere('niveau', 'like', "%{$search}%")
                  ->orWhere('specialite', 'like', "%{$search}%")
                  ->orWhereHas('service', function($q) use ($search) {
                      $q->where('nom_service', 'like', "%{$search}%");
                  })
                  ->orWhereHas('etablissement', function($q) use ($search) {
                      $q->where('nom_etablissement', 'like', "%{$search}%")
                        ->orWhere('ville', 'like', "%{$search}%")
                        ->orWhere('abréviation', 'like', "%{$search}%");
                  });
            });
        }
    
        $archivedStagiaires = $query->orderBy('nom')->paginate(10);
        
        return view('archive', compact('archivedStagiaires', 'search'));
    }
    public function editArchive($id)
    {
        $archive = Stagiaire::with(['service', 'stages'])
            ->whereHas('stages', function($query) {
                $query->where('date_fin', '<', Carbon::now()->toDateString());
            })
            ->findOrFail($id);
            
        $services = Service::all();
        
        return view('archives.edit', compact('archive', 'services'));
    }

    public function updateArchive(Request $request, $id)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:50|regex:/^[a-zA-ZÀ-ÿ\-\'\s]+$/u',
            'prénom' => 'required|string|max:50|regex:/^[a-zA-ZÀ-ÿ\-\'\s]+$/u',
            'email' => 'required|email|max:250|unique:stagiaire,email,' . $id . ',ID_stagiaire',
            'téléphone' => 'required|regex:/^[0-9]{10}$/|unique:stagiaire,téléphone,' . $id . ',ID_stagiaire',
            'ID_service' => 'required|exists:service,ID_service',
            'nom_etablissement' => 'required|string',
            'ID_etablissement' => 'required|exists:etablissement,ID_etablissement',
        ], [
            'nom.regex' => 'Le nom ne doit contenir que des lettres et des accents.',
            'prénom.regex' => 'Le prénom ne doit contenir que des lettres et des accents.',
            'email.unique' => 'L\'adresse email existe déjà.',
            'téléphone.unique' => 'Le numéro de téléphone existe déjà.',
            'nom_etablissement.required' => 'Veuillez sélectionner un établissement valide.',
        ]);

        DB::beginTransaction();
        try {
            $stagiaire = Stagiaire::findOrFail($id);
            $stagiaire->update([
                'nom' => $validated['nom'],
                'prénom' => $validated['prénom'],
                'email' => $validated['email'],
                'téléphone' => $validated['téléphone'],
                'ID_service' => $validated['ID_service'],
                'ID_etablissement' => $validated['ID_etablissement'],
            ]);
    
            DB::commit();
            return redirect()->route('archive', ['search' => $request->query('search')])
                           ->with('success', 'Stagiaire archivé mis à jour avec succès !');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Erreur lors de la mise à jour : ' . $e->getMessage());
        }
    }

    public function destroyArchive($id)
    {
        DB::beginTransaction();
        try {
            $stagiaire = Stagiaire::findOrFail($id);
            
            $stagiaire->stages()->delete();
            
            $stagiaire->delete();

            DB::commit();
            return redirect()->route('archive')->with('success', 'Stagiaire archivé supprimé avec succès !');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Erreur lors de la suppression : ' . $e->getMessage());
        }
    }
}