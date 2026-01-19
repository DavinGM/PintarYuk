<section>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        {{-- Avatar Upload Section --}}
        <div class="flex items-center gap-6 mb-8" x-data="avatarUpload()">
            <div class="relative group">
                <div
                    class="w-24 h-24 rounded-full overflow-hidden bg-slate-800 border-2 border-slate-700 group-hover:border-blue-500 transition-colors">
                    <img :src="previewUrl" class="w-full h-full object-cover">
                </div>
                <div class="absolute inset-0 bg-black/50 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer"
                    @click="$refs.avatarInput.click()">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
            </div>

            <div>
                <button type="button" @click="$refs.avatarInput.click()"
                    class="text-white font-bold text-sm bg-slate-800 hover:bg-slate-700 px-4 py-2 rounded-lg transition-colors border border-white/5">
                    Ganti Foto
                </button>
                <p class="text-xs text-slate-500 mt-2">Format: JPG, PNG. Maks 2MB.</p>

                {{-- Hidden Input --}}
                <input type="file" name="avatar" x-ref="avatarInput" class="hidden" accept="image/*"
                    @change="updatePreview($event)">
                <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="group">
                <label for="name"
                    class="block text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-2 ml-1">
                    {{ __('Nama Lengkap') }}
                </label>
                <input id="name" name="name" type="text"
                    class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500/20 transition-all"
                    value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div class="group">
                <label for="email"
                    class="block text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-2 ml-1">
                    {{ __('Alamat Email') }}
                </label>
                <input id="email" name="email" type="email"
                    class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500/20 transition-all"
                    value="{{ old('email', $user->email) }}" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                    <div class="mt-4">
                        <p class="text-sm text-yellow-500">
                            {{ __('Email Anda belum terverifikasi.') }}
                            <button form="send-verification" class="underline text-yellow-400 hover:text-yellow-300">
                                {{ __('Kirim ulang email.') }}
                            </button>
                        </p>
                    </div>
                @endif
            </div>
        </div>

        <div class="flex items-center gap-4 pt-4 border-t border-white/5 mt-2">
            <button type="submit"
                class="px-6 py-2.5 bg-blue-600 hover:bg-blue-500 text-white font-bold rounded-xl shadow-lg shadow-blue-600/20 transition-all active:scale-95 text-sm">
                {{ __('Simpan Perubahan') }}
            </button>

            @if (session('status') === 'profile-updated')
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
                    class="text-sm text-green-400 font-bold flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    {{ __('Tersimpan.') }}
                </div>
            @endif
        </div>
    </form>
</section>

<script>
    function avatarUpload() {
        return {
            previewUrl: '{{ $user->avatar ? asset("storage/" . $user->avatar) : "https://ui-avatars.com/api/?name=" . urlencode($user->name) . "&background=0D8ABC&color=fff" }}',
            updatePreview(event) {
                const file = event.target.files[0];
                if (file) {
                    this.previewUrl = URL.createObjectURL(file);
                }
            }
        }
    }
</script>