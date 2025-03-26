<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Encadrant;
use App\Models\Service;
use Illuminate\Support\Facades\Log;

class EncadrantController extends Controller
{
    public function index()
    {
        $encadrants = Encadrant::orderBy('created_at', 'DESC')->get();
        // @dd($encadrants); 
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
        // dd($request->all());
        // dd($request->ID_service, gettype($request->ID_service));

        $validatedData = $request->validate([
            'nom' => 'required|string|max:255|regex:/^[\pL\s\-]+$/u',
            'prenom' => 'required|string|max:255|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|email|unique:encadrants,email',
            'ID_service' => 'required|exists:service,ID_service',
        ], [
            'nom.required' => 'Le nom est requis.',
            'nom.regex' => 'Le nom ne doit contenir que des lettres, des espaces et des tirets.',
            'prenom.required' => 'Le prenom est requis.',
            'prenom.regex' => 'Le prenom ne doit contenir que des lettres, des espaces et des tirets.',
            'email.required' => 'L\'email est requis.',
            'email.email' => 'L\'email doit être valide.',
            'email.unique' => 'L\'email est déjà utilisé.',
            'ID_service.required' => 'Le service est requis.',
            'ID_service.exists' => 'Le service sélectionné est invalide.',
        ]);

        Log::info('Creating encadrant with data:', $validatedData);

        $encadrant = Encadrant::create($validatedData);

        Log::info('Encadrant created:', ['encadrant' => $encadrant]);

        return redirect()->route('encadrants.list')->with('success', 'Encadrant ajouté avec succès.');
    }

    public function edit($id)
    {
        Log::info('Editing encadrant with ID:', ['id' => $id]);

        $encadrant = Encadrant::findOrFail($id);

        Log::info('Retrieved encadrant:', ['encadrant' => $encadrant]);

        $services = Service::all();

        return view('encadrants.edit', compact('encadrant', 'services'));
    }

    public function update(Request $request, $id)
    {
        Log::info('Updating encadrant with ID:', ['id' => $id]);

        $encadrant = Encadrant::findOrFail($id);

        Log::info('Retrieved encadrant for update:', ['encadrant' => $encadrant]);

        $validatedData = $request->validate([
            'nom' => 'required|string|max:255|regex:/^[\pL\s\-]+$/u',
            'prenom' => 'required|string|max:255|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|email|unique:encadrants,email,' . $id,
            'ID_service' => 'required|exists:service,ID_service',
        ], [
            'nom.required' => 'Le nom est requis.',
            'nom.regex' => 'Le nom ne doit contenir que des lettres, des espaces et des tirets.',
            'prenom.required' => 'Le prenom est requis.',
            'prenom.regex' => 'Le prenom ne doit contenir que des lettres, des espaces et des tirets.',
            'email.required' => 'L\'email est requis.',
            'email.email' => 'L\'email doit être valide.',
            'email.unique' => 'L\'email est déjà utilisé.',
            'ID_service.required' => 'Le service est requis.',
            'ID_service.exists' => 'Le service sélectionné est invalide.',
        ]);

        Log::info('Updating encadrant with data:', $validatedData);

        $encadrant->update($validatedData);

        Log::info('Encadrant updated:', ['encadrant' => $encadrant]);

        return redirect()->route('encadrants.list')->with('success', 'Encadrant mis à jour avec succès.');
    }

    public function destroy($id)
    {
        Log::info('Deleting encadrant with ID:', ['id' => $id]);

        $encadrant = Encadrant::findOrFail($id);

        Log::info('Retrieved encadrant for deletion:', ['encadrant' => $encadrant]);

        $encadrant->delete();

        Log::info('Encadrant deleted:', ['encadrant' => $encadrant]);

        return redirect()->route('encadrants.list')->with('success', 'Encadrant supprimé avec succès.');
    }
}