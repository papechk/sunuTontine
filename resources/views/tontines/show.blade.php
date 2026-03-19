@extends('layouts.admin')
@section('page_title', 'Detail tontine')
@section('admin_content')
@php
    $status = $tontine->statut ?? 'Actif';
    $statusClass = match (strtolower($status)) {
        'actif', 'active' => 'badge-success',
        'inactif', 'inactive' => 'badge-error',
        'en attente', 'attente' => 'badge-warning',
        default => 'badge-brand',
    };
@endphp
<div class="card">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-semibold text-gray-900">{{ $tontine->nom }}</h2>
            <p class="text-sm text-gray-500">Details de la tontine</p>
        </div>
        <span class="badge {{ $statusClass }}">{{ $status }}</span>
    </div>

    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700">
        <div><span class="font-semibold">Frequence:</span> {{ $tontine->frequence }}</div>
        <div><span class="font-semibold">Montant:</span> {{ number_format($tontine->montant_cotisation, 0, ',', ' ') }} F</div>
        <div><span class="font-semibold">Date debut:</span> {{ $tontine->date_debut ?? 'N/A' }}</div>
        <div><span class="font-semibold">Statut:</span> {{ $status }}</div>
    </div>
</div>
@endsection
