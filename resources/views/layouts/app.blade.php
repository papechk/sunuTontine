<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('dashboard.dashboard_title', config('app.name', 'Laravel')) }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
    @yield('head')
    <style>
        body {
            background: #f6f8fa;
        }
        .sidebar-glass {
            background: rgba(255,255,255,0.7); backdrop-filter: blur(8px);
        }
    </style>
</head>
<body>
    @if (Request::is('/') || Request::is('welcome'))
        <main class="w-full min-h-screen flex flex-col justify-center items-center p-0">
            @yield('content')
        </main>
    @else
        <div class="min-h-screen flex">
            <aside class="w-64 min-h-screen p-6 {{ config('dashboard.sidebar_style') == 'sombre' ? 'bg-gray-900' : (config('dashboard.sidebar_style') == 'colore' ? 'bg-gradient-to-br from-blue-600 to-purple-500' : (config('dashboard.sidebar_style') == 'degrade' ? 'bg-gradient-to-br from-blue-200 to-blue-500' : (config('dashboard.sidebar_style') == 'verre' ? 'sidebar-glass' : 'bg-white'))) }}">
                <div class="flex items-center mb-8">
                    <img src="{{ asset('storage/' . config('dashboard.app_logo', 'logo.png')) }}" alt="Logo" class="h-10 w-10 rounded-full mr-2">
                    <span class="font-bold text-lg">{{ config('dashboard.app_name', config('app.name', 'Laravel')) }}</span>
                </div>
                <nav class="space-y-2">
                    <a href="/dashboard" class="block py-2 px-4 rounded hover:bg-blue-100 hover:text-blue-700"><i class="fas fa-home mr-2"></i> Tableau de bord</a>
                    <a href="/tontines" class="block py-2 px-4 rounded hover:bg-blue-100 hover:text-blue-700"><i class="fas fa-users mr-2"></i> Tontines</a>
                    <a href="/membres" class="block py-2 px-4 rounded hover:bg-blue-100 hover:text-blue-700"><i class="fas fa-user-friends mr-2"></i> Membres</a>
                    <a href="/calendrier" class="block py-2 px-4 rounded hover:bg-blue-100 hover:text-blue-700"><i class="fas fa-calendar-alt mr-2"></i> Calendrier</a>
                    <a href="/dashboard/settings" class="block py-2 px-4 rounded hover:bg-blue-100 hover:text-blue-700"><i class="fas fa-cog mr-2"></i> Paramètres</a>
                </nav>
            </aside>
            <main class="flex-1 p-8">
                @yield('content')
            </main>
        </div>
    @endif
</body>
</html>
