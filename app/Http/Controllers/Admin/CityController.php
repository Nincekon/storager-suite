<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.cities.index', [
            'cities' => City::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.cities.form', [
            'city' => new City()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {

        $validated = $request->validate([
            'name' => 'required|string|max:32',
        ]);

        City::create($validated);

        return redirect(route('admin.cities.index'))->with('success', 'La ville a été ajoutée avec succès.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(City $city): View
    {
        return view('admin.cities.form', [
            'city' => $city
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, City $city): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:32',
        ]);

        $city->update($validated);

        return back()->with('success', 'La ville a été mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city): RedirectResponse
    {
        $city->delete();

        return back()->with('success', 'La ville a été supprimée avec succès.');
    }
}
