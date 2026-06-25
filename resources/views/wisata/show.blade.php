<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Destinasi - Jelajah Indonesia</title>
    <link
        rel="stylesheet"
        href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        .leaflet-container {
            z-index: 1 !important;
        }
    </style>    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
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
                    <a href="{{ route('dashboard') }}">
                        Dashboard
                    </a>
                    @endauth
                    @auth
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 rounded-full bg-emerald-600 text-white font-bold text-xs flex items-center justify-center shadow-md">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <span class="text-sm font-bold text-slate-700">{{ Auth::user()->name }}</span>
                        </div>
                    @else
                        <a href="/login" class="text-sm font-medium text-slate-700 hover:text-emerald-600 transition mr-2">Masuk</a>
                        <a href="/register" class="bg-gradient-to-r from-emerald-600 to-teal-600 text-white text-sm font-semibold px-5 py-2.5 rounded-xl shadow-md transition">
                            Daftar Akun
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        {{-- Alert Notifikasi Sukses/Error --}}
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
            
            <div class="lg:col-span-2 space-y-6">

                {{-- ✅ FIX 1: Badge kinds DIHAPUS dari sini --}}
                <div class="relative rounded-3xl overflow-hidden shadow-lg border border-slate-100 aspect-[16/9] bg-slate-200">
                    <img
                        src="{{ $wisata['image'] ?? 'https://via.placeholder.com/1200x700?text=No+Image' }}"
                        alt="{{ $wisata['name'] ?? 'Destinasi Wisata' }}"
                        class="w-full h-full object-cover">
                </div>

                <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <h1 class="text-2xl sm:text-4xl font-black text-slate-900 tracking-tight">
                            {{ $wisata['name'] ?? 'Destinasi Wisata' }}
                        </h1>
                        <p class="text-slate-500 mt-2 flex items-center text-sm sm:text-base">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-500 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            </svg>
                            {{ $wisata['address'] ?? '-' }},
                            {{ $wisata['city'] ?? '-' }},
                            {{ $wisata['province'] ?? '-' }}
                        </p>
                    </div>
                </div>

                <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-100 space-y-4">
                    <h2 class="text-xl font-bold text-slate-900 border-b border-slate-100 pb-3">Deskripsi Tempat</h2>
                    <p class="text-slate-600 leading-relaxed text-sm sm:text-base">
                        {{ $wisata['description'] ?? 'Deskripsi tidak tersedia.' }}
                    </p>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 space-y-4">
                    <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0022 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                        </svg>
                        Peta Lokasi Interaktif
                    </h2>
                    
                    <div id="map"
                        class="relative z-0 w-full h-64 rounded-2xl border border-slate-200">
                    </div>

                    {{-- ✅ FIX 2: Tombol Google Maps dipindah ke sini, tepat di bawah peta --}}
                    
                        href="https://www.google.com/maps?q={{ $wisata['lat'] }},{{ $wisata['lon'] }}"
                        target="_blank"
                        class="block text-center bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-3 rounded-xl transition shadow-md"
                    >
                        📍 Buka di Google Maps
                    </a>

                    <h3 class="font-bold text-lg">
                        📍 Lokasi Wisata
                    </h3>
                    <p class="text-sm text-gray-500">
                        Koordinat lokasi destinasi berdasarkan data OpenTripMap.
                    </p>

                    <div class="grid grid-cols-2 gap-2 bg-slate-50 p-3 rounded-xl border border-slate-100 text-center text-xs text-slate-500">
                        <div>
                            <span class="block text-[10px] uppercase font-bold tracking-wider text-slate-400">Latitude</span>
                            <span class="font-mono text-slate-700 font-medium">{{ $wisata['lat'] ?? '-' }}</span>
                        </div>
                        <div class="border-l border-slate-200">
                            <span class="block text-[10px] uppercase font-bold tracking-wider text-slate-400">Longitude</span>
                            <span class="font-mono text-slate-700 font-medium">{{ $wisata['lon'] ?? '-' }}</span>
                        </div>
                    </div>

                    {{-- ✅ FIX 3: Tombol Simpan ke Favorit --}}
                    @auth
                        <form action="{{ route('favorite.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="xid"      value="{{ $wisata['xid'] }}">
                            <input type="hidden" name="name"     value="{{ $wisata['name'] }}">
                            <input type="hidden" name="image"    value="{{ $wisata['image'] }}">
                            <input type="hidden" name="city"     value="{{ $wisata['city'] }}">
                            <input type="hidden" name="province" value="{{ $wisata['province'] }}">
                            <button type="submit"
                                class="w-full block text-center bg-rose-500 hover:bg-rose-600 text-white font-semibold py-3 rounded-xl transition shadow-md">
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

        L.tileLayer(
            'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
            {
                attribution:
                    '&copy; OpenStreetMap contributors'
            }
        ).addTo(map);

        L.marker([lat, lon])
            .addTo(map)
            .bindPopup("{{ $wisata['name'] }}")
            .openPopup();
    
    });
    </script>
</body>
</html>