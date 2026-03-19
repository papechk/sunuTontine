<?php

namespace App\Http\Controllers;

use App\Models\Membre;
use Illuminate\Http\Request;

class MembreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Affiche uniquement les membres des tontines du gestionnaire connecté
        $membres = \App\Models\Membre::whereHas('tontine', function($q) {
            $q->where('gestionnaire_id', request()->user() ? request()->user()->id : null);
        })->get();
        return view('membres.index', compact('membres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Membre $membre)
    {
        // Vérifie que le membre appartient à une tontine du gestionnaire connecté
        if ($membre->tontine->gestionnaire_id !== (request()->user() ? request()->user()->id : null)) {
            abort(403, 'Accès interdit');
        }
        return view('membres.show', compact('membre'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Membre $membre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Membre $membre)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Membre $membre)
    {
        //
    }
}
