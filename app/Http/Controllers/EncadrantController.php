<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Encadrant;

class EncadrantController extends Controller
{
    /**
     * Afficher la liste des encadrants.
     */
    public function index()
    {
        $encadrants = Encadrant::orderBy('created_at', 'DESC')->get();
        return view('encadrants.index', compact('encadrants')); // Affiche la vue list.blade.php
    }

    /**
     * Afficher le formulaire d'ajout d'un encadrant.
     */
    public function create()
    {
        return view('encadrants.create');
    }

    /**
     * Enregistrer un nouvel encadrant.
     */
    public function store(Request $request)
    {
        Encadrant::create($request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:encadrants,email',
        ]));

        return redirect()->route('encadrants.index')->with('success', 'Encadrant ajouté avec succès.');
    }

    /**
     * Afficher un encadrant spécifique.
     */
    public function show(string $id)
    {
        $encadrant = Encadrant::findOrFail($id);
        return view('encadrants.show', compact('encadrant'));
    }

    /**
     * Afficher le formulaire de modification d'un encadrant.
     */
    public function edit(string $id)
    {
        $encadrant = Encadrant::findOrFail($id);
        return view('encadrants.edit', compact('encadrant'));
    }

    /**
     * Mettre à jour un encadrant.
     */
    public function update(Request $request, string $id)
    {
        $encadrant = Encadrant::findOrFail($id);

        $encadrant->update($request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:encadrants,email,' . $id,
        ]));

        return redirect()->route('encadrants.index')->with('success', 'Encadrant mis à jour avec succès.');
    }

    /**
     * Supprimer un encadrant.
     */
    public function destroy(string $id)
    {   
        $encadrant = Encadrant::findOrFail($id);
        $encadrant->delete();

        return redirect()->route('encadrants.index')->with('success', 'Encadrant supprimé avec succès.');
    }
}
