<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Destinasi - Jelajah Indonesia</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-800 font-sans antialiased">

    <nav class="sticky top-0 z-50 bg-white border-b border-slate-100 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center space-x-2">
                    <span class="text-2xl">🇮🇩</span>
                    <a href="/wisata-desain" class="text-2xl font-black tracking-tight bg-gradient-to-r from-emerald-600 to-teal-700 bg-clip-text text-transparent">
                        Jelajah<span class="text-slate-900 font-semibold">Indonesia</span>
                    </a>
                </div>
                <div class="flex items-center space-x-6">
                    <a href="/wisata-desain" class="text-sm font-medium text-emerald-600 transition">Beranda</a>
                    <a href="/currency-desain" class="text-sm font-medium text-slate-600 hover:text-emerald-600 transition">Konverter Kurs</a>
                    <a href="/dashboard" class="text-sm font-medium text-slate-600 hover:text-emerald-600 transition">Favorit Saya</a>
                    <div class="h-5 w-[1px] bg-slate-200"></div>
                    @auth
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 rounded-full bg-emerald-600 text-white font-bold text-xs flex items-center justify-center shadow-md">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <span class="text-sm font-bold text-slate-700">{{ Auth::user()->name }}</span>
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

        {{-- Form Pencarian Destinasi Wisata --}}
        <div class="max-w-3xl mx-auto mb-12 text-center space-y-4">
            <h1 class="text-3xl sm:text-5xl font-black tracking-tight text-slate-950">
                Temukan Destinasi <span class="bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent">Impianmu</span>
            </h1>
            <p class="text-slate-500 text-sm sm:text-base max-w-xl mx-auto">
                Cari kota atau daerah liburan di Indonesia untuk mengeksplorasi ragam objek budaya, sejarah, dan keindahan alam tersembunyi.
            </p>
            <form action="{{ route('wisata.index') }}" method="GET" class="pt-2">
                <div class="flex items-center bg-white border border-slate-200 rounded-2xl shadow-sm p-2 max-w-2xl mx-auto focus-within:border-emerald-500 focus-within:ring-2 focus-within:ring-emerald-100 transition">
                    <div class="pl-3 text-slate-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Ketik nama kota (Contoh: Banda Aceh, Yogyakarta, Bali)..." class="w-full bg-transparent px-4 py-3 text-sm border-none focus:outline-none focus:ring-0 text-slate-800 placeholder-slate-400" required>
                    <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-6 py-3 rounded-xl text-sm transition shrink-0 shadow-md shadow-emerald-100">
                        Cari
                    </button>
                </div>
            </form>
        </div>

        {{-- Section Hasil Pencarian atau Rekomendasi Awal --}}
        @if($search)
            <div class="mb-6">
                <h2 class="text-2xl font-black text-slate-900 tracking-tight">Destinasi di "{{ $search }}"</h2>
                <p class="text-xs text-slate-500 mt-1">Ditemukan {{ count($places) }} objek wisata potensial dari OpenTripMap API.</p>
            </div>
        @else
            <div class="mb-6">
                <h2 class="text-2xl font-black text-slate-900 tracking-tight">Rekomendasi Destinasi Terpopuler</h2>
                <p class="text-xs text-slate-500 mt-1">Cari daerah di atas untuk mengeksplorasi lokasi wisata secara langsung.</p>
            </div>
        @endif

        {{-- Grid Daftar Kartu Tempat Wisata --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($places as $item)
                <div class="group bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden flex flex-col justify-between transition hover:shadow-md">
                    
                    {{-- Bagian Visual Gambar (Placeholder Estetik / Gambar API jika ada) --}}
                    <div class="relative overflow-hidden aspect-[16/10] bg-slate-100 flex items-center justify-center">
                        @if(!empty($item['preview']['source']))
                            <img src="{{ $item['preview']['source'] }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        @else
                            {{-- Jika tempat lokal kecil tidak punya gambar bawaan dari API --}}
                            <div class="text-center p-4 space-y-2 select-none">
                                <span class="text-3xl block">🌴</span>
                                <span class="text-[10px] uppercase font-bold tracking-wider text-slate-400 bg-slate-50 px-2 py-0.5 rounded-md">OpenTripMap</span>
                            </div>
                        @endif
                        <div class="absolute top-3 left-3">
                            <span class="bg-slate-900/80 backdrop-blur-sm text-white px-2 py-0.5 rounded-lg text-[10px] font-medium tracking-wide">
                                {{ current(explode(',', $item['kinds'])) }}
                            </span>
                        </div>
                    </div>

                    {{-- Bagian Konten Teks Deskripsi Singkat --}}
                    <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                        <div>
                            <h3 class="font-bold text-sm text-slate-900 leading-tight line-clamp-2 min-h-[40px] group-hover:text-emerald-600 transition">
                                {{ $item['name'] ?? 'Tempat Wisata Tanpa Nama' }}
                            </h3>
                            <p class="text-slate-400 text-[11px] mt-1 uppercase font-bold tracking-wider">
                                Rate Skala: {{ $item['rate'] ?? '1' }}
                            </p>
                        </div>
                        
                        {{-- Tombol Lihat Detail mengarah dinamis ke parameter ?xid=... --}}
                        <div class="pt-1">
                            <a href="/wisata-detail-desain?xid={{ $item['xid'] }}" class="block text-center bg-slate-50 hover:bg-emerald-600 text-slate-700 hover:text-white font-semibold py-2.5 rounded-xl border border-slate-200 hover:border-emerald-600 text-xs transition shadow-sm">
                                Lihat Detail Wisata
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                {{-- Kondisi Tampilan ketika user belum mencari atau pencarian tidak ditemukan --}}
                <div class="col-span-1 sm:col-span-2 lg:col-span-4 bg-white rounded-3xl p-12 text-center border border-slate-100 shadow-sm space-y-3">
                    <span class="text-4xl block">🔍</span>
                    @if($search)
                        <h3 class="font-bold text-slate-800 text-base">Destinasi Tidak Ditemukan</h3>
                        <p class="text-slate-400 text-xs max-w-sm mx-auto">Tidak dapat mendeteksi objek wisata ber-rating populer di daerah "{{ $search }}". Cobalah memasukkan nama kota besar lain.</p>
                    @else
                        <h3 class="font-semibold text-slate-500 text-sm">Kolom Pencarian Masih Kosong</h3>
                        <p class="text-slate-400 text-xs max-w-xs mx-auto">Silakan masukkan kata kunci kota pada bar pencarian di atas untuk memuat data OpenTripMap.</p>
                    @endif
                </div>
            @endforelse
        </div>
    </main>

</body>
</html>