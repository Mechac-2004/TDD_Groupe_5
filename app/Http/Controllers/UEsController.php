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
    $ues = UEs::all(); 
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
        ues::create($ueData);
    }

    return redirect()->route('liste')->with('success', 'Les UE Bien enregistre');
}
   
    public function index()
    {
        
        $ues = UEs::all();  
        return view('UEs.index', compact('ues'));
    }


    public function edit($id)
    {
        // $ues = UEs::where('id', $id)->findOrFail($id);
        $ues = UEs::findOrFail($id);
        // $ues = UEs::find($id);
        return view('UEs.edit', compact('ues'));  
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => 'required|string|max:10',
            'nom' => 'required|string|max:255',
            'credits_ects' => 'required|integer|min:1',
            'semestre' => 'required|integer|in:1,2',
        ]);
    
        $ues = UEs::findOrFail($id);
        $ues->update([
            'code' => $request->input('code'),
            'nom' => $request->input('nom'),
            'credits_ects' => $request->input('credits_ects'),
            'semestre' => $request->input('semestre'),
        ]);
    
       return redirect()->route('liste')->with('success', 'UE mise à jour avec succès.');
    }

    public function destroy($id)
    {
        // $ues = UEs::find($id);
        $ues = UEs::findOrFail($id);
        $ues->delete(); 
    
        return redirect()->route('liste')->with('success', 'UE supprimée avec succès.');
    }
}