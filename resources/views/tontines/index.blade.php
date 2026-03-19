@extends('layouts.admin')
@section('page_title', 'Tontines')
@section('admin_content')
<div class="card">
    <div class="flex items-center justify-between border-b border-gray-200 pb-4">
        <div>
            <h2 class="text-lg font-semibold text-gray-900">Liste des tontines</h2>
            <p class="text-sm text-gray-500">Consultez les tontines en cours.</p>
        </div>
    </div>
    <div class="overflow-x-auto pt-4">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-50 text-gray-600">
                <tr>
                    <th class="text-left px-6 py-3">Nom</th>
                    <th class="text-left px-6 py-3">Frequence</th>
                    <th class="text-left px-6 py-3">Montant</th>
                    <th class="text-left px-6 py-3">Statut</th>
                    <th class="text-right px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($tontines as $tontine)
                    @php
                        $status = $tontine->statut ?? 'Actif';
                        $statusClass = match (strtolower($status)) {
                            'actif', 'active' => 'badge-success',
                            'inactif', 'inactive' => 'badge-error',
                            'en attente', 'attente' => 'badge-warning',
                            default => 'badge-brand',
                        };
                    @endphp
                    <tr>
                        <td class="px-6 py-3 font-medium text-gray-900">{{ $tontine->nom }}</td>
                        <td class="px-6 py-3 text-gray-600">{{ $tontine->frequence }}</td>
                        <td class="px-6 py-3 text-gray-600">{{ number_format($tontine->montant_cotisation, 0, ',', ' ') }} F</td>
                        <td class="px-6 py-3">
                            <span class="badge {{ $statusClass }}">{{ $status }}</span>
                        </td>
                        <td class="px-6 py-3 text-right">
                            <a href="{{ route('tontines.show', $tontine) }}" class="text-brand-500 font-semibold hover:underline">Voir</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="px-6 py-6 text-gray-500" colspan="5">Aucune tontine disponible.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
