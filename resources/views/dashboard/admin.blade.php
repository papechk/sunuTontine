@extends('layouts.admin')
@section('page_title', 'Administrateur')
@section('admin_content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
	<div class="bg-white rounded-xl border border-gray-200 p-5 shadow-sm">
		<div class="text-sm text-gray-500">Utilisateurs</div>
		<div class="text-2xl font-bold text-gray-900 mt-2">--</div>
	</div>
	<div class="bg-white rounded-xl border border-gray-200 p-5 shadow-sm">
		<div class="text-sm text-gray-500">Tontines</div>
		<div class="text-2xl font-bold text-gray-900 mt-2">--</div>
	</div>
	<div class="bg-white rounded-xl border border-gray-200 p-5 shadow-sm">
		<div class="text-sm text-gray-500">Alertes</div>
		<div class="text-2xl font-bold text-gray-900 mt-2">--</div>
	</div>
</div>
<div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
	<h2 class="text-lg font-semibold text-gray-900 mb-2">Parametres globaux</h2>
	<p class="text-gray-600">Configurez l'application, les roles et les acces.</p>
</div>
@endsection
