<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data x-init="$store.theme.init()" x-bind:class="{ 'dark': $store.theme.theme === 'dark' }">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('dashboard.app_name', config('app.name', 'SunuTontine')) }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            [x-cloak] { display: none !important; }
        </style>

        <script>
            (function() {
                const theme = localStorage.getItem('theme') || 'light';
                if (theme === 'dark') {
                    document.documentElement.classList.add('dark');
                }
            })();
        </script>
    </head>
    <body class="font-outfit min-h-screen bg-gray-100 dark:bg-gray-900 flex flex-col items-center justify-center py-8 px-4 transition-colors duration-300">
        <div class="fixed top-4 right-4 z-50">
            <button @click="$store.theme.toggle()"
                    class="flex h-10 w-10 items-center justify-center rounded-full bg-white dark:bg-gray-800 shadow-lg border border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                <svg x-show="$store.theme.theme === 'light'" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                </svg>
                <svg x-show="$store.theme.theme === 'dark'" x-cloak class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </button>
        </div>

        <a href="{{ url('/') }}" class="mb-8 flex items-center gap-3">
            <div class="flex h-14 w-14 items-center justify-center rounded-xl shadow-lg" style="background: linear-gradient(135deg, #465fff 0%, #6366f1 100%);">
                <img src="{{ asset('storage/' . config('dashboard.app_logo', 'logo.png')) }}" alt="Logo" class="h-8 w-8 rounded">
            </div>
            <span class="text-2xl font-bold text-gray-900 dark:text-white">{{ config('dashboard.app_name', config('app.name', 'SunuTontine')) }}</span>
        </a>

        <div class="w-full max-w-md">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 p-8">
                {{ $slot }}
            </div>

            <p class="text-center text-gray-500 dark:text-gray-400 mt-6 text-sm">
                &copy; {{ date('Y') }} {{ config('dashboard.app_name', config('app.name', 'SunuTontine')) }}. Tous droits réservés.
            </p>
        </div>
    </body>
</html>
