<?php

namespace App\Http\Controllers\Admin;

use App\Models\Town;
use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TownController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.towns.index', [
            'towns' => Town::with('city')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.towns.form', [
            'town' => new Town(),
            'cities' => City::select('id', 'name')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'city_id' => 'required|exists:cities,id',
            'code' => 'required|max:3',
            'title' => 'required|string|max:42',
        ]);

        Town::create($validated);

        return redirect(route('admin.towns.index'))->with('success', 'La commune a été ajoutée avec succès.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Town $town)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Town $town)
    {
        return view('admin.towns.form', [
            'town' => $town,
            'cities' => City::select('id', 'name')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Town $town)
    {

        $validated = $request->validate([
            'city_id' => 'required|exists:cities,id',
            'code' => 'required|max:3',
            'title' => 'required|string|max:42',
        ]);

        $town->update($validated);

        return back()->with('success', 'La commune a été modifiée avec succès.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Town $town): RedirectResponse
    {
        $town->delete();

        return back()->with('success', 'La commune a été supprimée avec succès.');

    }
}
