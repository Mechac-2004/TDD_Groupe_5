<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\View\View;
use App\Models\UEs;

class UEsController extends Controller
{
   
    public function index()
    {
        $ues = UEs::all(); 
        // dd($ues);
        return view('UEs.index', compact('ues'));
        // return view('UEs.index')->name('ues');
    }

  
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
    public function destroy(UEs $ue)
    {
      
    }
}