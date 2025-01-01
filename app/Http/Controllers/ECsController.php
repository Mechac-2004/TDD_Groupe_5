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
        

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ECs.create');
       
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


    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        
    }
}