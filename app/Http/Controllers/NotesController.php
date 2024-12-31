<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotesController extends Controller
{


    public function create()
{
    // $ecs = Ec::all();
    // return view('notes.create', compact('ecs'));
    // return view('notes.create')->with('ecs', $ecs);
}

 
    public function store(Request $request)
{
    $validated = $request->validate([
        'ec_id' => 'required|exists:ecs,id',
        'note' => 'required|numeric|min:0|max:20',
        'session' => 'required|in:normale,rattrapage',
    ]);

    Note::create($validated);

    return redirect()->back()->with('success', 'Note enregistrée avec succès.');
}

}
