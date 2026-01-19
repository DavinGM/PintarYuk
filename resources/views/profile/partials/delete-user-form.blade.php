<section class="space-y-6">
    <header>
        <h2 class="text-lg font-bold text-red-500">
            {{ __('Delete Account') }}
        </h2>
        <p class="mt-1 text-sm text-slate-400">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted.') }}
        </p>
    </header>

    <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="bg-red-600/10 hover:bg-red-600 text-red-500 hover:text-white border border-red-600/20 px-6 py-2.5 rounded-xl font-bold text-sm transition-all active:scale-95">
        {{ __('Delete Account') }}
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}"
            class="p-8 bg-slate-950 border border-white/5 rounded-2xl">
            @csrf
            @method('delete')

            <h2 class="text-xl font-bold text-white mb-2">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="text-sm text-slate-400 mb-6">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="group">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <input id="password" name="password" type="password"
                    class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500/20 transition-all"
                    placeholder="{{ __('Password') }}" />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-8 flex justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close')"
                    class="px-4 py-2 text-slate-400 hover:text-white font-bold text-sm transition-colors">
                    {{ __('Cancel') }}
                </button>

                <button type="submit"
                    class="bg-red-600 hover:bg-red-500 text-white px-6 py-2 rounded-xl font-bold text-sm transition-all shadow-lg shadow-red-600/20">
                    {{ __('Delete Account') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>