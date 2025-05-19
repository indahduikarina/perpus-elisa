<section class="space-y-6 bg-pink-50 dark:bg-pink-700 p-6 rounded-lg shadow-md">
    <header>
        <h2 class="text-lg font-medium text-pink-600 dark:text-pink-200">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-pink-500 dark:text-pink-400">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="bg-pink-600 hover:bg-pink-700"
    >{{ __('Delete Account') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 bg-pink-50 dark:bg-pink-700 rounded-lg">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-pink-600 dark:text-pink-200">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-pink-500 dark:text-pink-400">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="text-pink-600" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4 border border-pink-300 dark:border-pink-500 focus:ring-pink-500 focus:border-pink-500"
                    placeholder="{{ __('Password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-pink-600 dark:text-pink-400" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')" class="bg-pink-200 hover:bg-pink-300 text-pink-600">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3 bg-pink-600 hover:bg-pink-700">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
