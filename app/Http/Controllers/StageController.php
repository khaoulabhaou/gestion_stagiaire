<?php
namespace App\Http\Controllers;

use App\Models\Stage;
use App\Models\Service;
use App\Models\Encadrant;
use App\Models\Stagiaire;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class StageController extends Controller
{
    public function create(Request $request)
    {
        $services = Service::all();
        $selectedService = $request->input('ID_service');
        
        $stagiaires = $selectedService 
            ? Stagiaire::where('ID_service', $selectedService)->get()
            : Stagiaire::all();
            
        $encadrants = $selectedService
            ? Encadrant::where('ID_service', $selectedService)->get()
            : Encadrant::all();

        return view('stages.ajouter', compact('services', 'stagiaires', 'encadrants', 'selectedService'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'date_début' => 'required|date',
            'date_fin' => 'required|date|after:date_début',
            'ID_service' => 'required|exists:service,ID_service',
            'id_stagiaire' => 'required|exists:stagiaire,ID_stagiaire',
            'id_encadrant' => 'required|exists:encadrants,id',
        ]);

        $stage = Stage::create($validated);
        $stage->encadrants()->attach($request->id_encadrant);

        return redirect()->route('stages.index')->with('success', 'Stage ajouté avec succès !');
    }

    public function index(Request $request)
    {
        $search = $request->query('search');
        $currentDate = now()->toDateString();
        
        $stages = Stage::with(['encadrants', 'stagiaire', 'service'])
            ->where('date_fin', '>=', $currentDate)
            ->when($search, function($query) use ($search) {
                $query->where(function($q) use ($search) {
                    $q->where('titre', 'like', "%{$search}%")
                      ->orWhere('date_début', 'like', "%{$search}%")
                      ->orWhere('date_fin', 'like', "%{$search}%")
                      ->orWhereHas('stagiaire', function($q) use ($search) {
                          $q->where('nom', 'like', "%{$search}%")
                            ->orWhere('prénom', 'like', "%{$search}%");
                      })
                      ->orWhereHas('service', function($q) use ($search) {
                          $q->where('nom_service', 'like', "%{$search}%");
                      })
                      ->orWhereHas('encadrants', function($q) use ($search) {
                          $q->where('nom', 'like', "%{$search}%")
                            ->orWhere('prenom', 'like', "%{$search}%");
                      });
                });
            })
            ->orderBy('date_début', 'desc')
            ->paginate(10);
    
        return view('stages.list', compact('stages'));
    }

    public function edit($id)
    {
        $stage = Stage::with(['encadrants', 'service', 'stagiaire'])->findOrFail($id);
        return view('stages.edit', [
            'stage' => $stage,
            'services' => Service::all(),
            'stagiaires' => Stagiaire::all(),
            'encadrants' => Encadrant::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'date_début' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_début',
            'ID_service' => 'required|exists:service,ID_service',
            'id_stagiaire' => 'required|exists:stagiaire,ID_stagiaire',
            'id_encadrant' => 'required|exists:encadrants,id'
        ]);

        $stage = Stage::findOrFail($id);
        $stage->update($validated);
        $stage->encadrants()->sync([$request->id_encadrant]);

        return redirect()->route('stages.index')->with('success', 'Stage mis à jour avec succès !');
    }

    public function destroy($id)
    {
        $stage = Stage::findOrFail($id);
        $stage->encadrants()->detach();
        $stage->delete();

        return redirect()->route('stages.index')->with('success', 'Stage supprimé avec succès !');
    }

    public function getStagiairesByService($serviceId)
    {
        $stagiaires = Stagiaire::where('ID_service', $serviceId)->get();
        return response()->json($stagiaires);
    }
    public function archive()
    {
        $currentDate = Carbon::now()->toDateString();
        
        $archivedStagiaires = Stagiaire::with(['stages.encadrants', 'service', 'etablissement'])
            ->whereHas('stages', function($query) use ($currentDate) {
                $query->where('date_fin', '<', $currentDate);
            })
            ->get();
            
        return view('archive', compact('archivedStagiaires'));
    }
}