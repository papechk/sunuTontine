<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardSettingsController extends Controller
{
    public function edit()
    {
        $settings = config('dashboard');
        return view('dashboard.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        // Ici, tu pourrais stocker les paramètres en base ou dans un fichier, selon le besoin
        // Pour l'exemple, on ne fait que valider et retourner les valeurs
        $validated = $request->validate([
            'dashboard_title' => 'required|string|max:255',
            'dashboard_welcome' => 'required|string|max:255',
            'sidebar_style' => 'required|in:clair,sombre,colore,degrade,verre',
            'main_color' => 'required|string',
            'tasks_per_page' => 'required|integer|min:1|max:100',
            'notifications_email' => 'boolean',
            'rappels' => 'boolean',
            'app_name' => 'required|string|max:255',
            'app_logo' => 'nullable|string',
        ]);
        // ...
        return back()->with('success', 'Paramètres mis à jour (démo)');
    }
}
