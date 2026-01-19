@extends('layouts.app')

@section('content')


<div id="jelajah-page" class="bg-slate-950 min-h-screen pt-24 pb-12">
    <div class="max-w-7xl mx-auto px-6">
                
        {{-- Search & Filter Bar --}}
        <div class="flex flex-col md:flex-row gap-4 mb-8">
            <div class="relative flex-1 group">
                <span class="absolute inset-y-0 left-5 flex items-center text-slate-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </span>
                <input type="text" placeholder="Cari judul buku, penulis, atau ISBN..." 
                    class="w-full bg-slate-900 border border-white/5 rounded-2xl py-4 pl-14 pr-6 text-white focus:ring-2 focus:ring-blue-500 focus:outline-none transition-all">
            </div>
            <button class="bg-slate-900 border border-white/5 px-8 py-4 rounded-2xl text-white font-bold flex items-center gap-3 hover:bg-slate-800 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/></svg>
                Filter
            </button>
        </div>

        {{-- Hero Section (Banner & Promo) --}}
        @include('jelajah._HeroSection')

        {{-- Kategori Section --}}
        @include('jelajah._Categories')

        {{-- Product Section --}}
        @include('jelajah._Product')

        {{-- Next Section bisa ditaruh di sini nanti --}}
        
    </div>
</div>
@endsection