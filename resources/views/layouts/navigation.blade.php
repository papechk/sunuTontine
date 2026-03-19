<nav class="w-full bg-white border-b border-gray-200">
    <div class="max-w-screen-2xl mx-auto px-4 md:px-6">
        <div class="flex items-center justify-between h-16">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-brand-500 text-white">
                    <i class="fas fa-layer-group"></i>
                </span>
                <span class="text-lg font-semibold text-gray-800">{{ config('dashboard.app_name', 'SunuTontine') }}</span>
            </a>

            <div class="flex items-center gap-4">
                <a href="{{ route('dashboard') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900">Dashboard</a>
                <a href="{{ route('profile.edit') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900">Profil</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-700">Deconnexion</button>
                </form>
            </div>
        </div>
    </div>
</nav>
