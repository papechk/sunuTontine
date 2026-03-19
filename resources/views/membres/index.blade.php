@extends('layouts.admin')
@section('page_title', 'Membres')
@section('admin_content')
<div class="card">
    <div class="flex items-center justify-between border-b border-gray-200 pb-4">
        <div>
            <h2 class="text-lg font-semibold text-gray-900">Liste des membres</h2>
            <p class="text-sm text-gray-500">Tous les membres enregistres.</p>
        </div>
    </div>
    <div class="overflow-x-auto pt-4">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-50 text-gray-600">
                <tr>
                    <th class="text-left px-6 py-3">Nom</th>
                    <th class="text-left px-6 py-3">Prenom</th>
                    <th class="text-left px-6 py-3">Telephone</th>
                    <th class="text-left px-6 py-3">Tontine</th>
                    <th class="text-right px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($membres as $membre)
                    <tr>
                        <td class="px-6 py-3 font-medium text-gray-900">{{ $membre->nom }}</td>
                        <td class="px-6 py-3 text-gray-600">{{ $membre->prenom }}</td>
                        <td class="px-6 py-3 text-gray-600">{{ $membre->telephone }}</td>
                        <td class="px-6 py-3 text-gray-600">{{ $membre->tontine->nom ?? 'N/A' }}</td>
                        <td class="px-6 py-3 text-right">
                            <a href="{{ route('membres.show', $membre) }}" class="text-brand-500 font-semibold hover:underline">Voir</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="px-6 py-6 text-gray-500" colspan="5">Aucun membre disponible.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
