<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ECs;
use App\Models\UEs;

class ECsController extends Controller
{
    
    public function index()
    {
        $ecs = ECs::all();  
        return view('ECs.index', compact('ecs'));

    }

    
    public function create()
    {
        $ecs = ECs::all(); 
    return view('ECs.create', compact('ecs'));
       
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:elements_constitutifs,code|max:10',
            'nom' => 'required|string|max:255',
            'coefficient' => 'required|numeric|min:0',
            'ue_id' => 'required|exists:unites_enseignement,id',
        ]);

        foreach ($validatedData['ecs'] as $ecData) {
            ecs::create($ecData);
        }
    
        return redirect()->route('ECs.store')->with('success', 'Les EC Bien enregistre');
    }
    public function edit($id)
    {
        $ecs = UEs::findOrFail($id);
        return view('ECs.edit', compact('ecs')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $EC = ECs::findOrFail($id);

        $request->validate([
            'code' => 'required|max:10|unique:elements_constitutifs,code,' . $id,
            'nom' => 'required|string|max:255',
            'coefficient' => 'required|numeric|min:0',
            'ue_id' => 'required|exists:unites_enseignement,id',
        ]);
        $ecs = ECs::findOrFail($id);
        $ues->update([
            'code' => $request->input('code'),
            'nom' => $request->input('nom'),
            'coefficient' => $request->input('coefficient'),
            'ue_id' => $request->input('ue_id'),
        ]);
        return redirect()->route('ECs.store')->with('success', 'Élément Constitutif mis à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ecs = ECs::findOrFail($id);
        $ecs->delete(); 
    
        return redirect()->route('ECs.store')->with('success', 'EC supprimée avec succès.');
    }
}