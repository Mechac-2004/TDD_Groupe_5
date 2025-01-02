<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\View\View;
use App\Models\UEs;

class UEsController extends Controller
{
    public function create()
{
    $ues = UEs::all();  // Chargez les UEs si nécessaire
    return view('UEs.create', compact('ues'));
}

public function store(Request $request)
{
    $validatedData = $request->validate([
        'ues.*.code' => 'required|string|max:10',
        'ues.*.nom' => 'required|string|max:255',
        'ues.*.credits_ects' => 'required|integer',
        'ues.*.semestre' => 'required|in:1,2',
    ]);

    foreach ($validatedData['ues'] as $ueData) {
        Ue::create($ueData);
    }

    return redirect()->route('UEs.create')->with('success', 'Les UEs ont été ajoutées avec succès.');
}
   
    public function index()
    {
        $ues = UEs::all(); 
        return view('UEs.index', compact('ues'));
        // return view('UEs.index')->name('ues');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $ue)
    {
        $ues = Ue::all();
    return view('form', compact('ues'));
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