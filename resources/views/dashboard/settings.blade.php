@extends('layouts.admin')
@section('page_title', 'Parametres')
@section('admin_content')
<div class="card">
    <div class="flex items-center justify-between border-b border-gray-200 pb-4">
        <div>
            <h2 class="text-lg font-semibold text-gray-900">Parametres du dashboard</h2>
            <p class="text-sm text-gray-500">Personnalisez l'apparence et les options generales.</p>
        </div>
    </div>

    @if (session('success'))
        <div class="mt-6 rounded-lg bg-success-50 px-4 py-3 text-sm text-success-600">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('dashboard.settings.update') }}" class="mt-6 space-y-6">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="mb-2.5 block text-sm font-medium text-gray-700">Titre du dashboard</label>
                <input type="text" name="dashboard_title" value="{{ old('dashboard_title', $settings['dashboard_title'] ?? '') }}" class="input-field">
                @error('dashboard_title')<p class="text-sm text-error-500 mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="mb-2.5 block text-sm font-medium text-gray-700">Message de bienvenue</label>
                <input type="text" name="dashboard_welcome" value="{{ old('dashboard_welcome', $settings['dashboard_welcome'] ?? '') }}" class="input-field">
                @error('dashboard_welcome')<p class="text-sm text-error-500 mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="mb-2.5 block text-sm font-medium text-gray-700">Style de sidebar</label>
                <select name="sidebar_style" class="input-field">
                    @foreach(['clair','sombre','colore','degrade','verre'] as $style)
                        <option value="{{ $style }}" @selected(old('sidebar_style', $settings['sidebar_style'] ?? '') === $style)>{{ ucfirst($style) }}</option>
                    @endforeach
                </select>
                @error('sidebar_style')<p class="text-sm text-error-500 mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="mb-2.5 block text-sm font-medium text-gray-700">Couleur principale</label>
                <input type="text" name="main_color" value="{{ old('main_color', $settings['main_color'] ?? '') }}" class="input-field">
                @error('main_color')<p class="text-sm text-error-500 mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="mb-2.5 block text-sm font-medium text-gray-700">Taches par page</label>
                <input type="number" name="tasks_per_page" value="{{ old('tasks_per_page', $settings['tasks_per_page'] ?? 10) }}" class="input-field">
                @error('tasks_per_page')<p class="text-sm text-error-500 mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="mb-2.5 block text-sm font-medium text-gray-700">Nom de l'application</label>
                <input type="text" name="app_name" value="{{ old('app_name', $settings['app_name'] ?? '') }}" class="input-field">
                @error('app_name')<p class="text-sm text-error-500 mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="mb-2.5 block text-sm font-medium text-gray-700">Logo (nom de fichier)</label>
                <input type="text" name="app_logo" value="{{ old('app_logo', $settings['app_logo'] ?? '') }}" class="input-field">
                @error('app_logo')<p class="text-sm text-error-500 mt-1">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <label class="flex items-center gap-3">
                <input type="checkbox" name="notifications_email" value="1" class="rounded border-gray-300 text-brand-500 focus:ring-brand-500" @checked(old('notifications_email', $settings['notifications_email'] ?? false))>
                <span class="text-sm text-gray-700">Notifications email</span>
            </label>
            <label class="flex items-center gap-3">
                <input type="checkbox" name="rappels" value="1" class="rounded border-gray-300 text-brand-500 focus:ring-brand-500" @checked(old('rappels', $settings['rappels'] ?? false))>
                <span class="text-sm text-gray-700">Rappels automatiques</span>
            </label>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="btn-primary">Enregistrer</button>
        </div>
    </form>
</div>
@endsection
