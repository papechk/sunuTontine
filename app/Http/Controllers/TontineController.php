<?php

namespace App\Http\Controllers;

use App\Models\Tontine;
use Illuminate\Http\Request;

class TontineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Affiche uniquement les tontines du gestionnaire connecté
        $tontines = \App\Models\Tontine::pourGestionnaire()->get();
        return view('tontines.index', compact('tontines'));
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
    public function show(Tontine $tontine)
    {
        // Vérifie que la tontine appartient au gestionnaire connecté
        if ($tontine->gestionnaire_id !== (request()->user() ? request()->user()->id : null)) {
            abort(403, 'Accès interdit');
        }
        return view('tontines.show', compact('tontine'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tontine $tontine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tontine $tontine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tontine $tontine)
    {
        //
    }
}
