<?php

namespace App\Http\Controllers;

use App\Models\Auteur;
use Illuminate\Http\Request;

class auteurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auteur.index', [
            'auteurs' => Auteur::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auteur.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
        ]);

        Auteur::create($request->all());

        return redirect()->route('auteurs.index');
    }

    /**
     * Display the specified resource.
     */
   public function show(Auteur $auteur)
{
    return view('auteur.show', [
        'auteur' => $auteur
    ]);
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Auteur $auteur)
    {
        return view ('auteur.edit', [
            'auteur' => $auteur
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
 public function update(Request $request, Auteur $auteur)
{
    $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
    ]);

    $auteur->update($request->all());

    return redirect()->route('auteurs.index');
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Auteur $auteur)
    {
        $auteur->delete();

        return redirect()->route('auteurs.index');
    }
}

