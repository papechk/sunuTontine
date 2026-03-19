@extends('layouts.admin')
@section('page_title', 'Profil')
@section('admin_content')
<div class="grid grid-cols-1 gap-6">
    <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
        @include('profile.partials.update-profile-information-form')
    </div>
    <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
        @include('profile.partials.update-password-form')
    </div>
    <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
        @include('profile.partials.delete-user-form')
    </div>
</div>
@endsection
