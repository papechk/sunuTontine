@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#F1F5F9]">
    <div class="max-w-7xl mx-auto px-6 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
            <div>
                <div class="flex items-center gap-3 mb-6">
                    <img src="{{ asset('storage/' . config('dashboard.app_logo', 'logo.png')) }}" alt="Logo" class="h-12 w-12 rounded-full">
                    <span class="text-lg font-semibold text-gray-800">{{ config('dashboard.app_name', config('app.name', 'SunuTontine')) }}</span>
                </div>
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 leading-tight">Gerez vos tontines avec un dashboard moderne</h1>
                <p class="mt-4 text-gray-600 text-lg">Suivi des cotisations, membres, penalites et calendrier dans une interface claire et efficace.</p>
                <div class="mt-8 flex flex-col sm:flex-row gap-4">
                    <a href="/register" class="px-8 py-3 bg-[#3C50E0] text-white font-semibold rounded-lg hover:bg-[#2F3CC4] transition">Creer un compte</a>
                    <a href="/login" class="px-8 py-3 bg-white text-gray-800 font-semibold rounded-lg border border-gray-200 hover:bg-gray-50 transition">Se connecter</a>
                </div>
                <div class="mt-10 grid grid-cols-2 gap-4">
                    <div class="bg-white rounded-xl border border-gray-200 p-4 shadow-sm">Dashboard clair</div>
                    <div class="bg-white rounded-xl border border-gray-200 p-4 shadow-sm">Rapports rapides</div>
                    <div class="bg-white rounded-xl border border-gray-200 p-4 shadow-sm">Calendrier intelligent</div>
                    <div class="bg-white rounded-xl border border-gray-200 p-4 shadow-sm">Gestion des membres</div>
                </div>
            </div>
            <div class="bg-white rounded-2xl border border-gray-200 shadow-lg p-6">
                <div class="grid grid-cols-2 gap-4">
                    <div class="rounded-xl bg-[#F8FAFC] border border-gray-200 p-4">
                        <div class="text-sm text-gray-500">Cotisations</div>
                        <div class="text-2xl font-bold text-gray-900 mt-2">1 250 000 F</div>
                    </div>
                    <div class="rounded-xl bg-[#F8FAFC] border border-gray-200 p-4">
                        <div class="text-sm text-gray-500">Membres</div>
                        <div class="text-2xl font-bold text-gray-900 mt-2">128</div>
                    </div>
                    <div class="rounded-xl bg-[#F8FAFC] border border-gray-200 p-4">
                        <div class="text-sm text-gray-500">Impayes</div>
                        <div class="text-2xl font-bold text-red-600 mt-2">120 000 F</div>
                    </div>
                    <div class="rounded-xl bg-[#F8FAFC] border border-gray-200 p-4">
                        <div class="text-sm text-gray-500">Penalites</div>
                        <div class="text-2xl font-bold text-orange-500 mt-2">15 000 F</div>
                    </div>
                </div>
                <div class="mt-6 rounded-xl border border-gray-200 p-4">
                    <div class="text-sm text-gray-500 mb-3">Activite recente</div>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li>Adama Faye a paye 10 000 F</li>
                        <li>Nouvelle cotisation programmee</li>
                        <li>3 membres en attente de validation</li>
                    </ul>
                </div>
            </div>
        </div>
        <footer class="mt-16 text-gray-500 text-sm">&copy; {{ date('Y') }} SunuTontine. Tous droits reserves.</footer>
    </div>
</div>
@endsection
