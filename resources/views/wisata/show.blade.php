<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Destinasi - Jelajah Indonesia</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        .leaflet-container { z-index: 1 !important; }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<body class="bg-slate-50 text-slate-800 font-sans antialiased">

    <nav class="sticky top-0 z-[9999] bg-white border-b shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center space-x-2">
                    <span class="text-2xl">🇮🇩</span>
                    <a href="/wisata-desain" class="text-2xl font-black tracking-tight bg-gradient-to-r from-emerald-600 to-teal-700 bg-clip-text text-transparent">
                        Jelajah<span class="text-slate-900 font-semibold">Indonesia</span>
                    </a>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="/wisata-desain" class="text-sm font-medium text-slate-600 hover:text-emerald-600 transition">Beranda</a>
                    <a href="/currency-desain" class="text-sm font-medium text-slate-600 hover:text-emerald-600 transition">Konverter Kurs</a>
                    <div class="h-5 w-[1px] bg-slate-200"></div>
                    @auth
                        {{-- Dropdown Profil --}}
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none group">
                                <div class="w-8 h-8 rounded-full bg-emerald-600 text-white font-bold text-xs flex items-center justify-center shadow-md">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <span class="text-sm font-bold text-slate-700 group-hover:text-emerald-600 transition">{{ Auth::user()->name }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <div x-show="open" @click.outside="open = false" x-transition
                                class="absolute right-0 mt-3 w-56 bg-white rounded-2xl shadow-xl border border-slate-100 py-2 z-50">
                                
                                <div class="px-4 py-3 border-b border-slate-100">
                                    <p class="text-xs text-slate-400">Masuk sebagai</p>
                                    <p class="text-sm font-bold text-slate-800 truncate">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-slate-400 truncate">{{ Auth::user()->email }}</p>
                                </div>

                                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-700 hover:bg-emerald-50 hover:text-emerald-600 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                    Favorit Saya
                                </a>

                                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-700 hover:bg-emerald-50 hover:text-emerald-600 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Edit Profil
                                </a>

                                <div class="border-t border-slate-100 mt-1 pt-1">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-rose-500 hover:bg-rose-50 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                            </svg>
                                            Keluar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <a href="/login" class="text-sm font-medium text-slate-700 hover:text-emerald-600 transition">Masuk</a>
                        <a href="/register" class="bg-gradient-to-r from-emerald-600 to-teal-600 text-white text-sm font-semibold px-5 py-2.5 rounded-xl shadow-md transition">
                            Daftar Akun
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm rounded-2xl flex items-center">
                ✨ {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-6 p-4 bg-rose-50 border border-rose-200 text-rose-700 text-sm rounded-2xl flex items-center">
                ⚠️ {{ session('error') }}
            </div>
        @endif

        <div class="mb-6">
            <a href="/wisata-desain" class="inline-flex items-center text-sm font-semibold text-emerald-600 hover:text-emerald-700 transition gap-1 group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Pencarian
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

            {{-- Kolom Kiri: Gambar, Judul, Deskripsi --}}
            <div class="lg:col-span-2 space-y-6">

                <div class="relative rounded-3xl overflow-hidden shadow-lg border border-slate-100 aspect-[16/9] bg-slate-200">
                    <img
                        src="{{ $wisata['image'] ?? 'https://via.placeholder.com/1200x700?text=No+Image' }}"
                        alt="{{ $wisata['name'] ?? 'Destinasi Wisata' }}"
                        class="w-full h-full object-cover">
                </div>

                <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-100">
                    <h1 class="text-2xl sm:text-4xl font-black text-slate-900 tracking-tight">
                        {{ $wisata['name'] ?? 'Destinasi Wisata' }}
                    </h1>
                    <p class="text-slate-500 mt-2 flex items-center text-sm sm:text-base">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-500 mr-1.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        </svg>
                        {{ $wisata['address'] ?? '-' }}, {{ $wisata['city'] ?? '-' }}, {{ $wisata['province'] ?? '-' }}
                    </p>
                </div>

                <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-100 space-y-4">
                    <h2 class="text-xl font-bold text-slate-900 border-b border-slate-100 pb-3">Deskripsi Tempat</h2>
                    <p class="text-slate-600 leading-relaxed text-sm sm:text-base">
                        {{ $wisata['description'] ?? 'Deskripsi tidak tersedia.' }}
                    </p>
                </div>
            </div>

            {{-- Kolom Kanan: Peta + Tombol --}}
            <div class="space-y-6">
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 space-y-4">

                    <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0022 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                        </svg>
                        Peta Lokasi Interaktif
                    </h2>

                    {{-- Peta Leaflet --}}
                    <div id="map" class="relative z-0 w-full h-64 rounded-2xl border border-slate-200"></div>

                    {{-- Tombol Google Maps tepat di bawah peta --}}
                    <a href="https://www.google.com/maps?q={{ $wisata['lat'] }},{{ $wisata['lon'] }}"
                       target="_blank"
                       class="block text-center bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-3 rounded-xl transition shadow-md">
                        📍 Buka di Google Maps
                    </a>

                    {{-- Tombol Favorit --}}
                    @auth
                        <form action="{{ route('favorite.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="xid"      value="{{ $wisata['xid'] }}">
                            <input type="hidden" name="name"     value="{{ $wisata['name'] }}">
                            <input type="hidden" name="image"    value="{{ $wisata['image'] }}">
                            <input type="hidden" name="city"     value="{{ $wisata['city'] }}">
                            <input type="hidden" name="province" value="{{ $wisata['province'] }}">
                            <button type="submit"
                                class="w-full text-center bg-rose-500 hover:bg-rose-600 text-white font-semibold py-3 rounded-xl transition shadow-md">
                                ❤️ Simpan ke Favorit
                            </button>
                        </form>
                    @else
                        <a href="/login"
                           class="block text-center bg-slate-100 hover:bg-slate-200 text-slate-600 font-semibold py-3 rounded-xl transition text-sm">
                            🔒 Masuk untuk menyimpan favorit
                        </a>
                    @endauth

                </div>

                {{-- Card Tips Perjalanan --}}
                <div class="bg-gradient-to-br from-slate-900 to-emerald-950 rounded-3xl p-6 shadow-md border border-slate-800 space-y-4">
                    <h3 class="font-bold text-emerald-400 uppercase tracking-wider text-[11px]">💡 Tips Perjalanan</h3>
                    <h2 class="text-xl font-extrabold tracking-tight leading-snug text-white">Datang dari Luar Negeri?</h2>
                    <p class="text-xs text-slate-300 leading-relaxed">
                        Hitung estimasi pengeluaran wisatamu dengan mengonversi mata uang asing langsung ke Rupiah secara instan.
                    </p>
                    <a href="/currency-desain" class="block text-center bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-bold py-3 rounded-xl shadow-lg shadow-emerald-900/30 transition">
                        Buka Konverter Kurs ➡️
                    </a>
                </div>

            </div>
        </div>
    </main>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const lat = {{ $wisata['lat'] ?? 0 }};
            const lon = {{ $wisata['lon'] ?? 0 }};

            const map = L.map('map').setView([lat, lon], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            L.marker([lat, lon])
                .addTo(map)
                .bindPopup("{{ $wisata['name'] }}")
                .openPopup();
        });
    </script>
</body>
</html>