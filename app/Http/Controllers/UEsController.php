<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
// use Illuminate\Http\ReditrectResponse;
use Illuminate\View\View;
use App\Models\UEs;

class UEsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $UEs = UEs::all(); 
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