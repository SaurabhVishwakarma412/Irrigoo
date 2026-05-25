<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <form
        method="post"
        action="{{ route('profile.destroy') }}"
        class="max-w-xl space-y-4"
        onsubmit="return confirm('{{ __('Are you sure you want to delete your account?') }}')"
    >
        @csrf
        @method('delete')

        <div>
            <x-input-label for="delete_account_password" :value="__('Password')" />
            <x-text-input
                id="delete_account_password"
                name="password"
                type="password"
                class="mt-1 block w-full"
                placeholder="{{ __('Enter your password to confirm') }}"
            />
            <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
        </div>

        <button type="submit" class="inline-flex items-center rounded-xl bg-red-600 px-5 py-2.5 text-xs font-semibold uppercase tracking-widest text-white transition hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
            {{ __('Delete Account') }}
        </button>
    </form>
</section>
