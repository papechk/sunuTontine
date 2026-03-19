<?php

namespace App\Http\Controllers;

use App\Models\Calendrier;
use App\Models\Tontine;
use Illuminate\Http\Request;

class CalendrierController extends Controller
{


    // Affiche les événements du calendrier pour le gestionnaire connecté
    public function index(Request $request)
    {
        $user = $request->user();
        $tontineId = $request->input('tontine_id');

        if ($request->expectsJson() || $request->wantsJson() || $request->ajax()) {
            $query = Calendrier::whereHas('tontine', function ($q) use ($user) {
                $q->where('gestionnaire_id', $user->id);
            });

            if ($tontineId) {
                $query->where('tontine_id', $tontineId);
            }

            $events = $query->get();
            return response()->json($events);
        }

        $tontines = Tontine::pourGestionnaire($user->id)->orderBy('nom')->get();
        return view('calendrier.index', [
            'tontines' => $tontines,
            'selectedTontineId' => $tontineId,
        ]);
    }

    // Ajoute une date de cotisation
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tontine_id' => 'required|exists:tontines,id',
            'date_cotisation' => 'required|date',
            'montant' => 'required|numeric|min:0',
        ]);
        $user = request()->user();
        $tontine = Tontine::where('id', $validated['tontine_id'])
            ->where('gestionnaire_id', $user->id)
            ->firstOrFail();
        $event = \App\Models\Calendrier::create($validated);
        return response()->json($event, 201);
    }

    // Supprime une date de cotisation
    public function destroy($id)
    {
        $user = request()->user();
        $event = \App\Models\Calendrier::where('id', $id)
            ->whereHas('tontine', function($q) use ($user) {
                $q->where('gestionnaire_id', $user->id);
            })->firstOrFail();
        $event->delete();
        return response()->json(['success' => true]);
    }
}
