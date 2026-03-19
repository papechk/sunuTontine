@extends('layouts.admin')
@section('page_title', 'Gestionnaire')
@section('admin_content')
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl border border-gray-200 p-5 shadow-sm">
        <div class="text-sm text-gray-500">Membres</div>
        <div class="text-2xl font-bold text-gray-900 mt-2">{{ $membresCount }}</div>
    </div>
    <div class="bg-white rounded-xl border border-gray-200 p-5 shadow-sm">
        <div class="text-sm text-gray-500">Cotisations payees</div>
        <div class="text-2xl font-bold text-green-600 mt-2">{{ number_format($cotisationsPayees, 0, ',', ' ') }} F</div>
    </div>
    <div class="bg-white rounded-xl border border-gray-200 p-5 shadow-sm">
        <div class="text-sm text-gray-500">Impayes</div>
        <div class="text-2xl font-bold text-red-600 mt-2">{{ number_format($cotisationsImpaye, 0, ',', ' ') }} F</div>
    </div>
    <div class="bg-white rounded-xl border border-gray-200 p-5 shadow-sm">
        <div class="text-sm text-gray-500">Penalites</div>
        <div class="text-2xl font-bold text-orange-500 mt-2">{{ number_format($penalites, 0, ',', ' ') }} F</div>
    </div>
</div>
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Calendrier des cotisations</h2>
        <ul class="space-y-2">
            @foreach($calendrier as $event)
                <li class="flex items-center justify-between text-sm">
                    <span class="text-gray-600">{{ $event->date_cotisation }}</span>
                    <span class="font-semibold text-gray-900">{{ number_format($event->montant, 0, ',', ' ') }} F</span>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Vos tontines</h2>
        <ul class="space-y-2">
            @foreach($tontines as $tontine)
                <li class="text-sm text-gray-700">
                    <span class="font-semibold">{{ $tontine->nom }}</span>
                    <span class="text-gray-500">({{ number_format($tontine->montant_cotisation, 0, ',', ' ') }} F / {{ $tontine->frequence }})</span>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
