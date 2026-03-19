<x-guest-layout>
    <h4 class="mb-4 text-center text-2xl font-bold text-gray-900 dark:text-white">Mot de passe oublie</h4>
    <p class="mb-6 text-sm text-gray-600 dark:text-gray-300">
        Entrez votre adresse email pour recevoir un lien de reinitialisation.
    </p>

    @if(session('status'))
        <div class="mb-4 rounded-lg bg-success-100 px-4 py-3 text-sm text-success-600 dark:bg-success-500/20 dark:text-success-400">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-6">
            <label for="email" class="mb-2.5 block font-medium text-gray-900 dark:text-white">
                Email
            </label>
            <div class="relative">
                <input type="email" id="email" name="email"
                       class="input-field pl-10 @error('email') border-error-500 @enderror"
                       value="{{ old('email') }}" placeholder="votre@email.com" required autofocus>
                <span class="absolute left-3 top-1/2 -translate-y-1/2">
                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </span>
            </div>
            @error('email')
                <p class="mt-1 text-sm text-error-500">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn-primary w-full justify-center">
            Envoyer le lien
        </button>
    </form>
</x-guest-layout>
