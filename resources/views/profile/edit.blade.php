@extends('layouts.app')

@section('content')
    <div class="min-h-screen pt-24 pb-20 relative bg-slate-950">
        <div
            class="absolute top-20 right-0 w-[500px] h-[500px] bg-blue-600/10 rounded-full blur-[120px] pointer-events-none">
        </div>

        <div class="max-w-6xl mx-auto px-6" x-data="{ activeTab: 'profile' }">

            {{-- Page Header --}}
            <div class="mb-10 animate-fade-in-up">
                <h1 class="text-3xl font-black text-white tracking-tight uppercase">Pengaturan Akun</h1>
                <p class="text-slate-400 mt-2">Kelola profil, keamanan, dan preferensi akun Anda.</p>
            </div>

            <div class="flex flex-col lg:flex-row gap-8">

                {{-- Sidebar Menu --}}
                <aside class="w-full lg:w-64 flex-shrink-0 space-y-2 animate-fade-in-left">
                    <button @click="activeTab = 'profile'"
                        :class="{ 'bg-blue-600 text-white shadow-lg shadow-blue-600/20': activeTab === 'profile', 'text-slate-400 hover:text-white hover:bg-white/5': activeTab !== 'profile' }"
                        class="w-full text-left px-5 py-3.5 rounded-xl text-sm font-bold transition-all flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Profil Saya
                    </button>
                    <button @click="activeTab = 'password'"
                        :class="{ 'bg-blue-600 text-white shadow-lg shadow-blue-600/20': activeTab === 'password', 'text-slate-400 hover:text-white hover:bg-white/5': activeTab !== 'password' }"
                        class="w-full text-left px-5 py-3.5 rounded-xl text-sm font-bold transition-all flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        Kata Sandi
                    </button>
                    <button @click="activeTab = 'danger'"
                        :class="{ 'bg-red-600/10 text-red-500 shadow-none border border-red-500/20': activeTab === 'danger', 'text-slate-400 hover:text-red-400 hover:bg-red-500/5': activeTab !== 'danger' }"
                        class="w-full text-left px-5 py-3.5 rounded-xl text-sm font-bold transition-all flex items-center gap-3 mt-8">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Hapus Akun
                    </button>
                </aside>

                {{-- Content Area --}}
                <div
                    class="flex-1 bg-slate-900/40 backdrop-blur-xl border border-white/5 rounded-[2.5rem] p-8 lg:p-10 shadow-2xl relative overflow-hidden animate-fade-in-up delay-100">

                    {{-- Tab: Profile --}}
                    <div x-show="activeTab === 'profile'" x-transition:enter="transition ease-out duration-300 transform"
                        x-transition:enter-start="opacity-0 translate-x-4"
                        x-transition:enter-end="opacity-100 translate-x-0">
                        <div class="mb-8 border-b border-white/5 pb-6">
                            <h2 class="text-xl font-bold text-white">Informasi Pribadi</h2>
                            <p class="text-slate-500 text-sm mt-1">Perbarui foto profil dan detail akun Anda.</p>
                        </div>
                        @include('profile.partials.update-profile-information-form')
                    </div>

                    {{-- Tab: Password --}}
                    <div x-show="activeTab === 'password'" style="display: none;"
                        x-transition:enter="transition ease-out duration-300 transform"
                        x-transition:enter-start="opacity-0 translate-x-4"
                        x-transition:enter-end="opacity-100 translate-x-0">
                        <div class="mb-8 border-b border-white/5 pb-6">
                            <h2 class="text-xl font-bold text-white">Keamanan</h2>
                            <p class="text-slate-500 text-sm mt-1">Update password Anda secara berkala untuk keamanan.</p>
                        </div>
                        @include('profile.partials.update-password-form')
                    </div>

                    {{-- Tab: Danger --}}
                    <div x-show="activeTab === 'danger'" style="display: none;"
                        x-transition:enter="transition ease-out duration-300 transform"
                        x-transition:enter-start="opacity-0 translate-x-4"
                        x-transition:enter-end="opacity-100 translate-x-0">
                        <div class="mb-8 border-b border-red-500/10 pb-6">
                            <h2 class="text-xl font-bold text-red-500">Zona Berbahaya</h2>
                            <p class="text-slate-500 text-sm mt-1">Tindakan di sini bersifat permanen dan tidak dapat
                                dibatalkan.</p>
                        </div>
                        @include('profile.partials.delete-user-form')
                    </div>

                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        .animate-fade-in-left {
            animation: fadeInLeft 0.6s ease-out forwards;
        }

        .delay-100 {
            animation-delay: 0.1s;
        }
    </style>
@endsection