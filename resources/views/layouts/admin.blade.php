<!DOCTYPE html>
@php
    $userSettings = auth()->check() && method_exists(auth()->user(), 'getSettings')
        ? auth()->user()->getSettings()
        : null;
    $primaryColor = $userSettings?->primary_color ?? '#465fff';
    $sidebarStyle = $userSettings?->sidebar_style ?? 'light';
    $pageTitle = trim($__env->yieldContent('page_title')) ?: trim($__env->yieldContent('title')) ?: 'Dashboard';
@endphp
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $pageTitle }} | {{ config('app.name', 'SunuTontine') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
    @yield('head')

    <style>
        :root {
            --color-brand-500: {{ $primaryColor }};
            --color-brand-400: {{ $primaryColor }}cc;
            --color-brand-600: {{ $primaryColor }};
        }
        .bg-brand-500 { background-color: {{ $primaryColor }} !important; }
        .text-brand-500 { color: {{ $primaryColor }} !important; }
        .border-brand-500 { border-color: {{ $primaryColor }} !important; }
        .bg-brand-100 { background-color: {{ $primaryColor }}20 !important; }
        .bg-brand-50 { background-color: {{ $primaryColor }}15 !important; }
        .hover\:bg-brand-600:hover { background-color: {{ $primaryColor }}dd !important; }
        .focus\:ring-brand-500:focus { --tw-ring-color: {{ $primaryColor }} !important; }
        .focus\:border-brand-500:focus { border-color: {{ $primaryColor }} !important; }
        .btn-primary { background-color: {{ $primaryColor }} !important; }
        .btn-primary:hover { background-color: {{ $primaryColor }}dd !important; }
        [x-cloak] { display: none !important; }

        @if($sidebarStyle === 'dark')
        #sidebar { background-color: #111827 !important; border-color: #1f2937 !important; }
        #sidebar .sidebar-text { color: #9ca3af !important; }
        #sidebar .sidebar-title { color: #fff !important; }
        #sidebar .menu-item-inactive { color: #9ca3af !important; }
        #sidebar .menu-item-inactive:hover { background-color: rgba(255,255,255,0.1) !important; color: #fff !important; }
        #sidebar .menu-item-active { background-color: {{ $primaryColor }} !important; color: #fff !important; }
        @elseif($sidebarStyle === 'colored')
        #sidebar { background-color: {{ $primaryColor }} !important; border-color: {{ $primaryColor }}dd !important; }
        #sidebar .sidebar-text { color: rgba(255,255,255,0.7) !important; }
        #sidebar .sidebar-title { color: #fff !important; }
        #sidebar .menu-item-inactive { color: rgba(255,255,255,0.85) !important; }
        #sidebar .menu-item-inactive:hover { background-color: rgba(255,255,255,0.2) !important; color: #fff !important; }
        #sidebar .menu-item-active { background-color: rgba(255,255,255,0.25) !important; color: #fff !important; }
        @elseif($sidebarStyle === 'gradient')
        #sidebar { background: linear-gradient(180deg, {{ $primaryColor }} 0%, #1e1b4b 100%) !important; border-color: transparent !important; }
        #sidebar .sidebar-text { color: rgba(255,255,255,0.6) !important; }
        #sidebar .sidebar-title { color: #fff !important; }
        #sidebar .menu-item-inactive { color: rgba(255,255,255,0.85) !important; }
        #sidebar .menu-item-inactive:hover { background-color: rgba(255,255,255,0.15) !important; color: #fff !important; }
        #sidebar .menu-item-active { background-color: rgba(255,255,255,0.25) !important; color: #fff !important; }
        @elseif($sidebarStyle === 'glass')
        #sidebar { background: rgba(255,255,255,0.85) !important; backdrop-filter: blur(20px) !important; -webkit-backdrop-filter: blur(20px) !important; border-color: rgba(200,200,200,0.3) !important; }
        .dark #sidebar { background: rgba(17,24,39,0.85) !important; border-color: rgba(255,255,255,0.1) !important; }
        #sidebar .menu-item-active { background-color: {{ $primaryColor }} !important; color: #fff !important; }
        @endif
    </style>

    <script>
        (function() {
            const savedTheme = localStorage.getItem('theme');
            const systemTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
            const theme = savedTheme || systemTheme;
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>
</head>
<body x-data x-init="$store.theme.init()" class="font-outfit bg-gray-50 dark:bg-gray-900">
    <div class="flex h-screen overflow-hidden">
        <aside id="sidebar"
            class="fixed left-0 top-0 flex flex-col h-screen px-5 transition-all duration-300 ease-in-out z-[99999] border-r {{ $sidebarStyle === 'dark' ? 'bg-gray-900 border-gray-800 text-white' : 'bg-white dark:bg-gray-900 border-gray-200 dark:border-gray-800 text-gray-900' }}"
            :class="{
                'w-[290px]': $store.sidebar.isExpanded || $store.sidebar.isMobileOpen || $store.sidebar.isHovered,
                'w-[90px]': !$store.sidebar.isExpanded && !$store.sidebar.isHovered,
                'translate-x-0': $store.sidebar.isMobileOpen,
                '-translate-x-full xl:translate-x-0': !$store.sidebar.isMobileOpen
            }"
            @mouseenter="$store.sidebar.setHovered(true)"
            @mouseleave="$store.sidebar.setHovered(false)">

            <div class="pt-8 pb-7 flex"
                :class="(!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen) ? 'xl:justify-center' : 'justify-start'">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                    <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-brand-500">
                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                    </span>
                    <span x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
                          class="sidebar-title text-xl font-bold text-gray-800 dark:text-white">{{ config('dashboard.app_name', 'SunuTontine') }}</span>
                </a>
            </div>

            <nav class="flex flex-col overflow-y-auto flex-1">
                <div class="flex flex-col gap-4">
                    <div>
                        <h2 class="sidebar-text mb-4 text-xs uppercase flex leading-5 text-gray-400"
                            :class="(!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen) ? 'lg:justify-center' : 'justify-start'">
                            <span x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen">Menu</span>
                            <svg x-show="!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <circle cx="6" cy="12" r="1.5" fill="currentColor"/>
                                <circle cx="12" cy="12" r="1.5" fill="currentColor"/>
                                <circle cx="18" cy="12" r="1.5" fill="currentColor"/>
                            </svg>
                        </h2>

                        <ul class="flex flex-col gap-1">
                            <li>
                                <a href="{{ route('dashboard') }}"
                                   class="menu-item group {{ request()->routeIs('dashboard') ? 'menu-item-active' : 'menu-item-inactive' }}"
                                   :class="(!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen) ? 'xl:justify-center' : 'xl:justify-start'">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    <span x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen">Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('tontines.index') }}"
                                   class="menu-item group {{ request()->is('tontines*') ? 'menu-item-active' : 'menu-item-inactive' }}"
                                   :class="(!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen) ? 'xl:justify-center' : 'xl:justify-start'">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    <span x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen">Tontines</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('membres.index') }}"
                                   class="menu-item group {{ request()->is('membres*') ? 'menu-item-active' : 'menu-item-inactive' }}"
                                   :class="(!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen) ? 'xl:justify-center' : 'xl:justify-start'">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <span x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen">Membres</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('calendrier.index') }}"
                                   class="menu-item group {{ request()->is('calendrier*') ? 'menu-item-active' : 'menu-item-inactive' }}"
                                   :class="(!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen) ? 'xl:justify-center' : 'xl:justify-start'">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen">Calendrier</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('dashboard.settings.edit') }}"
                                   class="menu-item group {{ request()->routeIs('dashboard.settings.*') ? 'menu-item-active' : 'menu-item-inactive' }}"
                                   :class="(!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen) ? 'xl:justify-center' : 'xl:justify-start'">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen">Parametres</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    @if(auth()->check() && auth()->user()->role === 'admin')
                    <div>
                        <h2 class="sidebar-text mb-4 text-xs uppercase flex leading-5 text-gray-400"
                            :class="(!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen) ? 'lg:justify-center' : 'justify-start'">
                            <span x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen">Administration</span>
                            <svg x-show="!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <circle cx="6" cy="12" r="1.5" fill="currentColor"/>
                                <circle cx="12" cy="12" r="1.5" fill="currentColor"/>
                                <circle cx="18" cy="12" r="1.5" fill="currentColor"/>
                            </svg>
                        </h2>

                        <ul class="flex flex-col gap-1">
                            <li>
                                <a href="{{ route('dashboard.settings.edit') }}"
                                   class="menu-item group {{ request()->routeIs('dashboard.settings.*') ? 'menu-item-active' : 'menu-item-inactive' }}"
                                   :class="(!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen) ? 'xl:justify-center' : 'xl:justify-start'">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                    <span x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen">Configuration</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    @endif
                </div>
            </nav>
        </aside>

        <div x-show="$store.sidebar.isMobileOpen"
             @click="$store.sidebar.isMobileOpen = false"
             class="fixed inset-0 bg-gray-900/50 z-[99998] xl:hidden"
             x-transition:enter="transition-opacity ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"></div>

        <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden transition-all duration-300"
             :class="{
                'xl:ml-[290px]': $store.sidebar.isExpanded || $store.sidebar.isHovered,
                'xl:ml-[90px]': !$store.sidebar.isExpanded && !$store.sidebar.isHovered
             }">

            <header class="sticky top-0 flex w-full bg-white border-gray-200 z-[9999] dark:border-gray-800 dark:bg-gray-900 xl:border-b">
                <div class="flex flex-col items-center justify-between grow xl:flex-row xl:px-6">
                    <div class="flex items-center justify-between w-full gap-2 px-3 py-3 border-b border-gray-200 dark:border-gray-800 sm:gap-4 xl:justify-normal xl:border-b-0 xl:px-0 lg:py-4">
                        <button @click="$store.sidebar.toggleExpanded()"
                                class="hidden xl:flex items-center justify-center w-10 h-10 text-gray-500 border border-gray-200 rounded-lg dark:border-gray-800 dark:text-gray-400 lg:h-11 lg:w-11 hover:bg-gray-100 dark:hover:bg-gray-800"
                                :class="{ 'bg-gray-100 dark:bg-gray-800': !$store.sidebar.isExpanded }">
                            <svg width="16" height="12" viewBox="0 0 16 12" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0.583 1C0.583 0.586 0.919 0.25 1.333 0.25H14.667C15.081 0.25 15.417 0.586 15.417 1C15.417 1.414 15.081 1.75 14.667 1.75H1.333C0.919 1.75 0.583 1.414 0.583 1ZM0.583 11C0.583 10.586 0.919 10.25 1.333 10.25H14.667C15.081 10.25 15.417 10.586 15.417 11C15.417 11.414 15.081 11.75 14.667 11.75H1.333C0.919 11.75 0.583 11.414 0.583 11ZM1.333 5.25C0.919 5.25 0.583 5.586 0.583 6C0.583 6.414 0.919 6.75 1.333 6.75H8C8.414 6.75 8.75 6.414 8.75 6C8.75 5.586 8.414 5.25 8 5.25H1.333Z" fill="currentColor"/>
                            </svg>
                        </button>

                        <button @click="$store.sidebar.toggleMobileOpen()"
                                class="flex xl:hidden items-center justify-center w-10 h-10 text-gray-500 rounded-lg dark:text-gray-400 lg:h-11 lg:w-11 hover:bg-gray-100 dark:hover:bg-gray-800">
                            <svg x-show="!$store.sidebar.isMobileOpen" width="16" height="12" viewBox="0 0 16 12" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0.583 1C0.583 0.586 0.919 0.25 1.333 0.25H14.667C15.081 0.25 15.417 0.586 15.417 1C15.417 1.414 15.081 1.75 14.667 1.75H1.333C0.919 1.75 0.583 1.414 0.583 1ZM0.583 11C0.583 10.586 0.919 10.25 1.333 10.25H14.667C15.081 10.25 15.417 10.586 15.417 11C15.417 11.414 15.081 11.75 14.667 11.75H1.333C0.919 11.75 0.583 11.414 0.583 11ZM1.333 5.25C0.919 5.25 0.583 5.586 0.583 6C0.583 6.414 0.919 6.75 1.333 6.75H8C8.414 6.75 8.75 6.414 8.75 6C8.75 5.586 8.414 5.25 8 5.25H1.333Z" fill="currentColor"/>
                            </svg>
                            <svg x-show="$store.sidebar.isMobileOpen" width="24" height="24" viewBox="0 0 24 24" fill="none" style="display:none;">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M6.22 7.28C5.93 6.99 5.93 6.51 6.22 6.22C6.51 5.93 6.99 5.93 7.28 6.22L12 10.94L16.72 6.22C17.01 5.93 17.49 5.93 17.78 6.22C18.07 6.51 18.07 6.99 17.78 7.28L13.06 12L17.78 16.72C18.07 17.01 18.07 17.49 17.78 17.78C17.49 18.07 17.01 18.07 16.72 17.78L12 13.06L7.28 17.78C6.99 18.07 6.51 18.07 6.22 17.78C5.93 17.49 5.93 17.01 6.22 16.72L10.94 12L6.22 7.28Z" fill="currentColor"/>
                            </svg>
                        </button>

                        <a href="{{ route('dashboard') }}" class="xl:hidden flex items-center gap-2">
                            <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-brand-500">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                </svg>
                            </span>
                            <span class="text-lg font-bold text-gray-800 dark:text-white">{{ config('dashboard.app_name', 'SunuTontine') }}</span>
                        </a>

                        <div class="hidden xl:block">
                            <h1 class="text-lg font-semibold text-gray-800 dark:text-white">{{ $pageTitle }}</h1>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3 px-5 py-4 xl:px-0">
                        <button @click="$store.theme.toggle()"
                                class="relative flex items-center justify-center text-gray-500 transition-colors bg-white border border-gray-200 rounded-full hover:bg-gray-100 h-11 w-11 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-400 dark:hover:bg-gray-800">
                            <i class="fas fa-sun hidden dark:block"></i>
                            <i class="fas fa-moon dark:hidden"></i>
                        </button>

                        <div x-data="{ dropdownOpen: false }" class="relative">
                            <button @click="dropdownOpen = !dropdownOpen" class="flex items-center gap-3 text-sm text-gray-500 dark:text-gray-400">
                                <span class="hidden lg:block text-right">
                                    <span class="block font-medium text-gray-700 dark:text-white">{{ Auth::user()->name }}</span>
                                    <span class="block text-xs text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</span>
                                </span>
                                <span class="flex h-11 w-11 items-center justify-center rounded-full bg-brand-500 text-white font-semibold">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                                </span>
                            </button>

                            <div x-show="dropdownOpen" @click.away="dropdownOpen = false"
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="opacity-0 scale-95"
                                 x-transition:enter-end="opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="opacity-100 scale-100"
                                 x-transition:leave-end="opacity-0 scale-95"
                                 class="absolute right-0 mt-4 w-60 flex-col rounded-2xl border border-gray-200 bg-white shadow-lg dark:border-gray-800 dark:bg-gray-900 z-[99999]"
                                 x-cloak>
                                <div class="flex flex-col gap-3 px-5 py-4 border-b border-gray-200 dark:border-gray-800">
                                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 text-sm font-medium text-gray-700 hover:text-brand-500 dark:text-gray-300 dark:hover:text-brand-400">
                                        <i class="fas fa-user"></i>
                                        Mon profil
                                    </a>
                                    <a href="{{ route('dashboard.settings.edit') }}" class="flex items-center gap-3 text-sm font-medium text-gray-700 hover:text-brand-500 dark:text-gray-300 dark:hover:text-brand-400">
                                        <i class="fas fa-cog"></i>
                                        Parametres
                                    </a>
                                </div>
                                <div class="px-5 py-4">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="flex items-center gap-3 text-sm font-medium text-gray-700 hover:text-red-500 dark:text-gray-300 dark:hover:text-red-400">
                                            <i class="fas fa-sign-out-alt"></i>
                                            Deconnexion
                                        </button>
                                    </form>
                                </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </header>

             <main class="mx-auto w-full max-w-screen-2xl p-4 md:p-6 2xl:p-10">
                @if(session('success'))
                    <div class="mb-4 rounded-xl bg-success-50 border border-success-200 px-4 py-3 text-sm text-success-700 dark:bg-success-500/10 dark:border-success-500/20 dark:text-success-500">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 rounded-xl bg-error-50 border border-error-200 px-4 py-3 text-sm text-error-700 dark:bg-error-500/10 dark:border-error-500/20 dark:text-error-500">
                        {{ session('error') }}
                    </div>
                @endif

                 @hasSection('admin_content')
                     @yield('admin_content')
                 @else
                     @yield('content')
                 @endif
             </main>
         </div>
     </div>

     @stack('scripts')
 </body>
 </html>
