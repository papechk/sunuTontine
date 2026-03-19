<?php

return [
    // Personnalisation du dashboard
    'dashboard_title' => 'Tableau de bord SunuTontine',
    'dashboard_welcome' => 'Bienvenue sur votre espace de gestion de tontine !',
    'sidebar_style' => 'clair', // clair, sombre, colore, degrade, verre
    'main_color' => '#2563eb', // Couleur principale (ex: bleu Tailwind)
    'widgets' => [
        'statistiques' => true,
        'taches' => true,
        'actions_rapides' => true,
        'activite_recente' => true,
    ],
    'tasks_per_page' => 10,
    'notifications_email' => true,
    'rappels' => true,

    // Paramètres de l’application
    'app_name' => 'SunuTontine',
    'app_logo' => 'logo.png',

    // Sécurité
    'password_change_enabled' => true,
    'profile_management_enabled' => true,
];
