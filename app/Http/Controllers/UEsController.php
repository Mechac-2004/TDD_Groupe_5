<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UEs;

class UEsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $UEs = UEs::all(); // Récupérer toutes les UEs
        return view('UEs.index', compact('UEs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('UEs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:unites_enseignement,code|max:10',
            'nom' => 'required|string|max:255',
            'credits_ects' => 'required|integer|min:1',
            'semestre' => 'required|integer|min:1|max:6',
        ]);

        UEs::create($request->all());
        return redirect()->route('UEs.index')->with('success', 'UE ajoutée avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $ue)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UEs $ue)
    {
        //dd($ue);
        return view('UEs.edit')->with('ue', $ue);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UEs $ue)
    {
        $request->validate([
            'code' => 'required|max:10|unique:unites_enseignement,code,' . $ue->id,
            'nom' => 'required|string|max:255',
            'credits_ects' => 'required|integer|min:1',
            'semestre' => 'required|integer|min:1|max:6',
        ]);

        $ue->update($request->all());
        return redirect()->route('UEs.index')->with('success', 'UE mise à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UEs $ue)
    {
        $ue->delete();
        return redirect()->route('UEs.index')->with('success', 'UE supprimée avec succès !');
    }
}
