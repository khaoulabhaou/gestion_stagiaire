<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Encadrant;
use App\Models\Service;
use Illuminate\Support\Facades\Log;

class EncadrantController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        
        $encadrants = Encadrant::with('service')
            ->when($search, function($query) use ($search) {
                $query->where(function($q) use ($search) {
                    $q->where('nom', 'like', "%{$search}%")
                      ->orWhere('prenom', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhereHas('service', function($q) use ($search) {
                          $q->where('nom_service', 'like', "%{$search}%");
                      });
                });
            })
            ->orderBy('created_at', 'DESC')
            ->paginate(10); // Changed from get() to paginate()
    
        return view('encadrants.list', compact('encadrants'));
    }
    public function create(Request $request)
    {
        $services = Service::all();
        $selectedService = $request->input('ID_service');

        return view('encadrants.create', compact('services', 'selectedService'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255|regex:/^[\pL\s\-]+$/u',
            'prenom' => 'required|string|max:255|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|email|unique:encadrants,email',
            'ID_service' => 'required|numeric|exists:service,ID_service',
        ], [
            'nom.required' => 'Le nom est requis.',
            'nom.regex' => 'Le nom ne doit contenir que des lettres, des espaces et des tirets.',
            'nom.max' => 'Le nom ne doit pas dépasser 255 caractères.',
            'prenom.required' => 'Le prénom est requis.',
            'prenom.regex' => 'Le prénom ne doit contenir que des lettres, des espaces et des tirets.',
            'prenom.max' => 'Le prénom ne doit pas dépasser 255 caractères.',
            'email.required' => 'L\'email est requis.',
            'email.email' => 'L\'email doit être valide (exemple: exemple@email.com).',
            'email.unique' => 'L\'email est déjà utilisé par un autre encadrant.',
            'ID_service.required' => 'Le service est requis.',
            'ID_service.numeric' => 'Le service sélectionné doit être un nombre valide.',
            'ID_service.exists' => 'Le service sélectionné est invalide.',
        ]);

        Encadrant::create([
            'nom' => $validatedData['nom'],
            'prenom' => $validatedData['prenom'],
            'email' => $validatedData['email'],
            'ID_service' => (int)$validatedData['ID_service'],
        ]);

        return redirect()->route('encadrants.list')->with('success', 'Encadrant ajouté avec succès!');
    }

    public function edit($id)
    {
        Log::info('Editing encadrant with ID:', ['id' => $id]);

        $encadrant = Encadrant::with('service')->findOrFail($id);
        $services = Service::all();

        return view('encadrants.edit', compact('encadrant', 'services'));
    }

    public function update(Request $request, $id)
    {
        Log::info('Updating encadrant with ID:', ['id' => $id]);

        $encadrant = Encadrant::findOrFail($id);

        $validatedData = $request->validate([
            'nom' => 'required|string|max:255|regex:/^[\pL\s\-]+$/u',
            'prenom' => 'required|string|max:255|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|email|unique:encadrants,email,' . $id,
            'ID_service' => 'required|exists:service,ID_service',
        ], [
            'nom.required' => 'Le nom est requis.',
            'nom.regex' => 'Le nom ne doit contenir que des lettres, des espaces et des tirets.',
            'nom.max' => 'Le nom ne doit pas dépasser 255 caractères.',
            'prenom.required' => 'Le prénom est requis.',
            'prenom.regex' => 'Le prénom ne doit contenir que des lettres, des espaces et des tirets.',
            'prenom.max' => 'Le prénom ne doit pas dépasser 255 caractères.',
            'email.required' => 'L\'email est requis.',
            'email.email' => 'L\'email doit être valide (exemple: exemple@email.com).',
            'email.unique' => 'L\'email est déjà utilisé par un autre encadrant.',
            'ID_service.required' => 'Le service est requis.',
            'ID_service.exists' => 'Le service sélectionné est invalide.',
        ]);

        $encadrant->update($validatedData);

        return redirect()->route('encadrants.list')->with('success', 'Encadrant mis à jour avec succès.');
    }

    public function destroy($id)
    {
        Log::info('Deleting encadrant with ID:', ['id' => $id]);

        $encadrant = Encadrant::findOrFail($id);
        $encadrant->delete();

        return redirect()->route('encadrants.list')->with('success', 'Encadrant supprimé avec succès.');
    }
}
