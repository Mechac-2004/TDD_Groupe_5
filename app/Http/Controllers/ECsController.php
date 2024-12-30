<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ECs;
use App\Models\UEs;

class ECsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ECs = ECs::with('uniteEnseignement')->get();
        return view('ECs.index', compact('ECs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $UEs = UEs::all();
        return view('ECs.create', compact('UEs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:elements_constitutifs,code|max:10',
            'nom' => 'required|string|max:255',
            'coefficient' => 'required|numeric|min:0',
            'ue_id' => 'required|exists:unites_enseignement,id',
        ]);

        ECs::create($request->all());
        return redirect()->route('ECs.index')->with('success', 'Élément Constitutif ajouté avec succès !');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $EC = ECs::findOrFail($id);
        $UEs = UEs::all();
        return view('ECs.edit', compact('EC', 'UEs'));
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

        $EC->update($request->all());
        return redirect()->route('ECs.index')->with('success', 'Élément Constitutif mis à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $EC = ECs::findOrFail($id);
        $EC->delete();
        return redirect()->route('ECs.index')->with('success', 'Élément Constitutif supprimé avec succès !');
    }
}
