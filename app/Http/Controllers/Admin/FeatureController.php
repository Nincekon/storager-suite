<?php

namespace App\Http\Controllers\Admin;

use App\Models\Feature;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.features.index', [
            'features' => Feature::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.features.form', [
            'feature' => new Feature()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {

        $validated = $request->validate([
            'title' => 'required|string|max:70',
        ]);

        Feature::create($validated);

        return redirect(route('admin.features.index'))->with('success', 'La commodité a été ajoutée avec succès.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Feature $feature): View
    {
        return view('admin.features.form', [
            'feature' => $feature
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Feature $feature): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:70',
        ]);

        $feature->update($validated);

        return back()->with('success', 'La commodité a été mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feature $feature): RedirectResponse
    {
        $feature->delete();

        return back()->with('success', 'La commodité a été supprimée avec succès.');
    }
}
