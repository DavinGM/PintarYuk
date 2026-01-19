<section>
    <header class="mb-6">
        <h2 class="text-lg font-bold text-white">
            {{ __('Update Password') }}
        </h2>
        <p class="mt-1 text-sm text-slate-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div class="space-y-4">
            <div class="group">
                <label for="update_password_current_password"
                    class="block text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-2 ml-1">
                    {{ __('Current Password') }}
                </label>
                <input id="update_password_current_password" name="current_password" type="password"
                    class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500/20 transition-all"
                    autocomplete="current-password" />
                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
            </div>

            <div class="group">
                <label for="update_password_password"
                    class="block text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-2 ml-1">
                    {{ __('New Password') }}
                </label>
                <input id="update_password_password" name="password" type="password"
                    class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500/20 transition-all"
                    autocomplete="new-password" />
                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
            </div>

            <div class="group">
                <label for="update_password_password_confirmation"
                    class="block text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-2 ml-1">
                    {{ __('Confirm Password') }}
                </label>
                <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                    class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500/20 transition-all"
                    autocomplete="new-password" />
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <div class="flex items-center gap-4 pt-4 border-t border-white/5 mt-2">
            <button type="submit"
                class="px-6 py-2.5 bg-blue-600 hover:bg-blue-500 text-white font-bold rounded-xl shadow-lg shadow-blue-600/20 transition-all active:scale-95 text-sm">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'password-updated')
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
                    class="text-sm text-green-400 font-bold flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    {{ __('Saved.') }}
                </div>
            @endif
        </div>
    </form>
</section>