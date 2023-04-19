<?php

namespace App\Http\Controllers\Admin;

use App\Models\Residence;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ResidenceFormRequest;
use App\Models\Category;
use App\Models\Character;
use App\Models\Feature;
use App\Models\Quarter;
use App\Models\User;
use Illuminate\Http\Request;

class ResidenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.residences.index', [
            'residences' => Residence::with('quarter')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.residences.form', [
            'residence' => new Residence(),
            'actors' => User::where('role_id', '>', '2')->get(),
            'categories' => Category::all('id', 'name'),
            'characters' => Character::all('id', 'title'),
            'quarters' => Quarter::all('id', 'title'),
            'features' => Feature::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ResidenceFormRequest $request)
    {
        $residence = Residence::create($request->validated());

        return redirect(to_route('admin.residences.index'))->with('success', "La résidence a été ajoutée avec succès");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Residence $residence)
    {
        return view('admin.residences.form', [
            'residence' => $residence,
            'actors' => User::where('role_id', '>', '2')->get(),
            'categories' => Category::all('id', 'name'),
            'characters' => Character::all('id', 'title'),
            'quarters' => Quarter::all('id', 'title'),
            'features' => Feature::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ResidenceFormRequest $request, Residence $residence)
    {
        $residence->update($request->validated());

        return back()->with('success', "La résidence a été modifiée avec succès");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Residence $residence)
    {
        $residence->delete();

        return back()->with('success', "La résidence a été supprimée avec succès");
    }
}
