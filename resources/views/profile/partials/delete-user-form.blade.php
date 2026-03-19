<section class="space-y-6">
    <header class="mb-6">
        <h2 class="text-lg font-semibold text-gray-900">
            {{ __('Supprimer le compte') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            {{ __('La suppression est definitive. Pensez a sauvegarder vos donnees avant de continuer.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Supprimer le compte') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-semibold text-gray-900">
                {{ __('Confirmer la suppression du compte ?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Entrez votre mot de passe pour confirmer la suppression definitive.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Mot de passe') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Mot de passe') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Annuler') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Supprimer') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
