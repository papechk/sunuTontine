<x-guest-layout>
    <h4 class="mb-4 text-center text-2xl font-bold text-gray-900 dark:text-white">Verifier votre email</h4>
    <p class="mb-6 text-sm text-gray-600 dark:text-gray-300">
        Nous avons envoye un lien de verification. Cliquez sur le lien pour activer votre compte.
    </p>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 rounded-lg bg-success-100 px-4 py-3 text-sm text-success-600 dark:bg-success-500/20 dark:text-success-400">
            Un nouveau lien de verification a ete envoye.
        </div>
    @endif

    <div class="flex flex-col gap-3">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn-primary w-full justify-center">
                Renvoyer l'email de verification
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-secondary w-full justify-center">
                Deconnexion
            </button>
        </form>
    </div>
</x-guest-layout>
