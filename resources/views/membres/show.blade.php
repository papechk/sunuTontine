@extends('layouts.admin')
@section('page_title', 'Detail membre')
@section('admin_content')
@php
    $status = $membre->statut ?? 'Actif';
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
            <h2 class="text-xl font-semibold text-gray-900">{{ $membre->prenom }} {{ $membre->nom }}</h2>
            <p class="text-sm text-gray-500">Details du membre</p>
        </div>
        <span class="badge {{ $statusClass }}">{{ $status }}</span>
    </div>

    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700">
        <div><span class="font-semibold">Telephone:</span> {{ $membre->telephone }}</div>
        <div><span class="font-semibold">Adresse:</span> {{ $membre->adresse ?? 'N/A' }}</div>
        <div><span class="font-semibold">Tontine:</span> {{ $membre->tontine->nom ?? 'N/A' }}</div>
        <div><span class="font-semibold">Statut:</span> {{ $status }}</div>
    </div>
</div>
@endsection
