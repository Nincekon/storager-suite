<?php

namespace App\Http\Controllers\Admin;

use App\Models\Quarter;
use App\Models\Town;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class QuarterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.quarters.index', [
            'quarters' => Quarter::with('town')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.quarters.form', [
            'quarter' => new Quarter(),
            'towns' => Town::select('id', 'title')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {

        $validated = $request->validate([
            'town_id' => 'required|exists:towns,id',
            'code' => 'required|max:5',
            'title' => 'required|string|max:50',
        ]);

        Quarter::create($validated);

        return redirect(route('admin.quarters.index'))->with('success', 'Le quartier a été ajouté avec succès.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Quarter $quarter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quarter $quarter): View
    {
        return view('admin.quarters.form', [
            'quarter' => $quarter,
            'towns' => Town::select('id', 'title')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Quarter $quarter): RedirectResponse
    {

        $validated = $request->validate([
            'town_id' => 'required|exists:towns,id',
            'code' => 'required|max:5',
            'title' => 'required|string|max:50',
        ]);

        $quarter->update($validated);

        return back()->with('success', 'Le quartier a été modifié avec succès.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quarter $quarter): RedirectResponse
    {
        $quarter->delete();

        return back()->with('success', 'Le quartier a été supprimé avec succès.');

    }
}
