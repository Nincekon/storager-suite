<?php

namespace App\Http\Controllers\Admin;

use App\Models\Character;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.characters.index', [
            'characters' => Character::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.characters.form', [
            'character' => new Character()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required|string|max:32',
        ]);

        Character::create($validated);

        return redirect(route('admin.characters.index'))->with('success', 'La caractéristique a été ajoutée avec succès.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Character $character)
    {
        return view('admin.characters.form', [
            'character' => $character
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Character $character): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:32',
        ]);

        $character->update($validated);

        return back()->with('success', 'La caractéristique a été mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Character $character): RedirectResponse
    {
        $character->delete();

        return back()->with('success', 'La caractéristique a été supprimée avec succès.');
    }
}
