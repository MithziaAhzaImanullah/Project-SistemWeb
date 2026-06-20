<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jelajah Indonesia - Temukan Destinasi Wisata Terbaik</title>
    <!-- Tailwind via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-800 font-sans antialiased">

    <!-- NAVBAR PREMIUM -->
    <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-slate-100 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <!-- Logo -->
                <div class="flex items-center space-x-2">
                    <span class="text-2xl">🇮🇩</span>
                    <a href="#" class="text-2xl font-black tracking-tight bg-gradient-to-r from-emerald-600 to-teal-700 bg-clip-text text-transparent">
                        Jelajah<span class="text-slate-900 font-semibold">Indonesia</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#" class="text-sm font-medium text-slate-600 hover:text-emerald-600 transition">Beranda</a>
                    <a href="#" class="text-sm font-medium text-slate-600 hover:text-emerald-600 transition">Konverter Kurs</a>
                    <a href="#" class="text-sm font-medium text-slate-600 hover:text-emerald-600 transition">Favorit Saya</a>
                    <div class="h-5 w-[1px] bg-slate-200"></div>
                    <button class="text-sm font-medium text-slate-700 hover:text-emerald-600 transition mr-2">Masuk</button>
                    <button class="bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white text-sm font-semibold px-5 py-2.5 rounded-xl shadow-md shadow-emerald-100 transition">
                        Daftar Akun
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION WIth BG GRADIENT DEEP -->
    <header class="relative bg-slate-950 py-24 sm:py-32 overflow-hidden">
        <!-- Decorative Glow Blur Background -->
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-emerald-500/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-teal-500/10 rounded-full blur-3xl"></div>

        <div class="relative max-w-5xl mx-auto px-4 text-center">
            <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 mb-6">
                ✨ Cari & Temukan Keindahan Nusantara
            </span>
            <h1 class="text-4xl sm:text-6xl font-black tracking-tight text-white mb-6 leading-tight">
                Eksplorasi Destinasi Wisata <br>
                <span class="bg-gradient-to-r from-emerald-400 to-teal-300 bg-clip-text text-transparent">Tanpa Batas di Indonesia</span>
            </h1>
            <p class="text-slate-400 max-w-2xl mx-auto text-base sm:text-lg mb-10 leading-relaxed">
                Temukan informasi lengkap, rute peta interaktif, dan estimasi biaya penukaran mata uang real-time hanya dalam satu platform terintegrasi.
            </p>
            
            <!-- SEARCH CONTAINER (FITUR 1) -->
            <div class="max-w-3xl mx-auto bg-white p-3 rounded-2xl shadow-2xl shadow-slate-950/50 border border-slate-100">
                <form action="#" method="GET" class="flex flex-col sm:flex-row gap-2">
                    <div class="flex-1 flex items-center px-4 rounded-xl bg-slate-50 border border-slate-200 focus-within:border-emerald-500 focus-within:ring-2 focus-within:ring-emerald-100 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" name="keyword" placeholder="Ketik nama kota, provinsi, atau daerah... (cth: Banda Aceh, Bali)" class="w-full py-3.5 bg-transparent text-slate-900 font-medium placeholder-slate-400 text-sm focus:outline-none">
                    </div>
                    <button type="submit" class="bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold px-8 py-3.5 rounded-xl transition shadow-lg shadow-emerald-600/20 text-sm whitespace-nowrap">
                        Cari Destinasi
                    </button>
                </form>
            </div>

            <!-- HISTORY PENCARIAN (FITUR 5) -->
            <div class="mt-6 flex flex-wrap items-center justify-center gap-3 text-xs sm:text-sm text-slate-400">
                <span class="flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    Pencarian terbaru:
                </span>
                <div class="flex flex-wrap gap-2">
                    <a href="#" class="bg-slate-900 hover:bg-slate-800 px-3 py-1.5 rounded-lg border border-slate-800 text-slate-300 hover:text-white transition font-medium">Banda Aceh</a>
                    <a href="#" class="bg-slate-900 hover:bg-slate-800 px-3 py-1.5 rounded-lg border border-slate-800 text-slate-300 hover:text-white transition font-medium">Yogyakarta</a>
                    <a href="#" class="bg-slate-900 hover:bg-slate-800 px-3 py-1.5 rounded-lg border border-slate-800 text-slate-300 hover:text-white transition font-medium">Raja Ampat</a>
                </div>
            </div>
        </div>
    </header>

    <!-- HASIL PENCARIAN SECTION -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">Rekomendasi Destinasi Populer</h2>
                <p class="text-slate-500 text-sm mt-1">Berdasarkan pencarian paling hits minggu ini di seluruh Indonesia.</p>
            </div>
        </div>

        <!-- GRID LAYOUT CARD PREMIUM -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            
            <!-- Card 1 -->
            <div class="group bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col">
                <div class="relative overflow-hidden aspect-[4/3]">
                    <img src="https://images.unsplash.com/photo-1596402184320-417e7178b2cd?auto=format&fit=crop&w=600&q=80" alt="Borobudur" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-3 left-3">
                        <span class="bg-white/90 backdrop-blur-md px-2.5 py-1 rounded-lg text-xs font-bold text-emerald-700 shadow-sm">🏛️ Budaya</span>
                    </div>
                </div>
                <div class="p-6 flex-1 flex flex-col justify-between">
                    <div>
                        <h3 class="font-bold text-lg text-slate-900 leading-snug group-hover:text-emerald-600 transition mb-1.5">Candi Borobudur</h3>
                        <p class="text-slate-500 text-xs flex items-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /></svg>
                            Magelang, Jawa Tengah
                        </p>
                    </div>
                    <a href="#" class="block text-center bg-slate-50 group-hover:bg-emerald-600 group-hover:text-white text-slate-700 font-semibold py-2.5 rounded-xl border border-slate-200 group-hover:border-emerald-600 transition duration-300 text-sm">
                        Lihat Detail Wisata
                    </a>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="group bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col">
                <div class="relative overflow-hidden aspect-[4/3]">
                    <img src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=600&q=80" alt="Kuta" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-3 left-3">
                        <span class="bg-white/90 backdrop-blur-md px-2.5 py-1 rounded-lg text-xs font-bold text-emerald-700 shadow-sm">🏖️ Alam</span>
                    </div>
                </div>
                <div class="p-6 flex-1 flex flex-col justify-between">
                    <div>
                        <h3 class="font-bold text-lg text-slate-900 leading-snug group-hover:text-emerald-600 transition mb-1.5">Pantai Kuta</h3>
                        <p class="text-slate-500 text-xs flex items-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /></svg>
                            Badung, Bali
                        </p>
                    </div>
                    <a href="#" class="block text-center bg-slate-50 group-hover:bg-emerald-600 group-hover:text-white text-slate-700 font-semibold py-2.5 rounded-xl border border-slate-200 group-hover:border-emerald-600 transition duration-300 text-sm">
                        Lihat Detail Wisata
                    </a>
                </div>
            </div>

        </div>
    </main>

</body>
</html>