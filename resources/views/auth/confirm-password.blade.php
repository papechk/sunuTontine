<x-guest-layout>
    <h4 class="mb-4 text-center text-2xl font-bold text-gray-900 dark:text-white">Confirmer le mot de passe</h4>
    <p class="mb-6 text-sm text-gray-600 dark:text-gray-300">
        Cette zone est securisee. Veuillez confirmer votre mot de passe.
    </p>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="mb-6">
            <label for="password" class="mb-2.5 block font-medium text-gray-900 dark:text-white">
                Mot de passe
            </label>
            <div class="relative">
                <input type="password" id="password" name="password"
                       class="input-field pl-10 @error('password') border-error-500 @enderror"
                       required autocomplete="current-password">
                <span class="absolute left-3 top-1/2 -translate-y-1/2">
                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </span>
            </div>
            @error('password')
                <p class="mt-1 text-sm text-error-500">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn-primary w-full justify-center">
            Confirmer
        </button>
    </form>
</x-guest-layout>
