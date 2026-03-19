<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Membre;
use App\Models\Cotisation;
use App\Models\Tontine;
use App\Models\Calendrier;

class DashboardController extends Controller
{
    public function index()
    {
        $user = request()->user();
        $isGestionnaire = $user->role === 'gestionnaire';
        $isAdmin = $user->role === 'admin';

        // Statistiques pour le gestionnaire
        if ($isGestionnaire) {
            $tontines = Tontine::pourGestionnaire()->get();
            $membresCount = Membre::whereHas('tontine', function($q) use ($user) {
                $q->where('gestionnaire_id', $user->id);
            })->count();
            $cotisationsPayees = Cotisation::whereHas('membre.tontine', function($q) use ($user) {
                $q->where('gestionnaire_id', $user->id);
            })->where('statut', 'paye')->sum('montant');
            $cotisationsImpaye = Cotisation::whereHas('membre.tontine', function($q) use ($user) {
                $q->where('gestionnaire_id', $user->id);
            })->where('statut', 'impaye')->sum('montant');
            $penalites = Cotisation::whereHas('membre.tontine', function($q) use ($user) {
                $q->where('gestionnaire_id', $user->id);
            })->sum('penalite');
            $calendrier = Calendrier::whereHas('tontine', function($q) use ($user) {
                $q->where('gestionnaire_id', $user->id);
            })->get();
            return view('dashboard.gestionnaire', compact('tontines', 'membresCount', 'cotisationsPayees', 'cotisationsImpaye', 'penalites', 'calendrier'));
        }

        // Statistiques pour l'admin (exemple)
        if ($isAdmin) {
            // ...
            return view('dashboard.admin');
        }

        // Pour les autres rôles (participant)
        return view('dashboard.participant');
    }
}
