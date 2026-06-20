@vite(['resources/css/app.css', 'resources/js/app.js'])

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pengguna - Jelajah Indonesia</title>
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
                    <a href="/wisata-desain" class="text-sm font-medium text-slate-600 hover:text-emerald-600 transition">Cari Wisata</a>
                    <a href="/currency-desain" class="text-sm font-medium text-slate-600 hover:text-emerald-600 transition">Konverter Kurs</a>
                    <div class="h-5 w-[1px] bg-slate-200"></div>
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 rounded-full bg-emerald-600 text-white font-bold text-xs flex items-center justify-center shadow-md shadow-emerald-200">
                            M
                        </div>
                        <span class="text-sm font-bold text-slate-700">Mithzia Ahza</span>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        <div class="bg-gradient-to-r from-slate-900 to-emerald-950 text-white p-8 rounded-3xl shadow-sm border border-slate-800 mb-10 relative overflow-hidden">
            <div class="absolute right-0 bottom-0 top-0 opacity-10 flex items-center justify-center text-9xl font-black pr-10 pointer-events-none select-none">🌴</div>
            <h1 class="text-2xl sm:text-3xl font-black tracking-tight">Selamat Datang di Panel Jelajahmu!</h1>
            <p class="text-slate-400 text-sm mt-2 max-w-xl">
                Kelola destinasi wisata yang kamu favoritkan dan akses kembali riwayat pencarian daerah liburanmu dengan cepat.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            
            <div class="lg:col-span-2 space-y-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-bold tracking-tight text-slate-900">❤️ Destinasi Favorit Saya</h2>
                        <p class="text-xs text-slate-500 mt-0.5">Daftar tempat wisata penting yang sudah kamu simpan.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    
                    <div class="group bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden flex flex-col justify-between">
                        <div class="relative overflow-hidden aspect-[16/10]">
                            <img src="https://images.unsplash.com/photo-1596402184320-417e7178b2cd?auto=format&fit=crop&w=500&q=80" alt="Borobudur" class="w-full h-full object-cover">
                        </div>
                        <div class="p-5 space-y-4">
                            <div>
                                <h3 class="font-bold text-base text-slate-900 leading-tight">Candi Borobudur</h3>
                                <p class="text-slate-400 text-xs mt-1">Magelang, Jawa Tengah</p>
                            </div>
                            <div class="grid grid-cols-2 gap-2 pt-2">
                                <a href="/wisata-detail-desain" class="text-center bg-slate-50 hover:bg-emerald-50 text-slate-700 hover:text-emerald-700 font-semibold py-2 rounded-xl border border-slate-200 text-xs transition">
                                    Detail
                                </a>
                                <button type="button" class="text-center bg-rose-50 hover:bg-rose-100 text-rose-600 font-semibold py-2 rounded-xl border border-rose-100 text-xs transition">
                                    Hapus
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="group bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden flex flex-col justify-between">
                        <div class="relative overflow-hidden aspect-[16/10]">
                            <img src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=500&q=80" alt="Kuta" class="w-full h-full object-cover">
                        </div>
                        <div class="p-5 space-y-4">
                            <div>
                                <h3 class="font-bold text-base text-slate-900 leading-tight">Pantai Kuta</h3>
                                <p class="text-slate-400 text-xs mt-1">Badung, Bali</p>
                            </div>
                            <div class="grid grid-cols-2 gap-2 pt-2">
                                <a href="/wisata-detail-desain" class="text-center bg-slate-50 hover:bg-emerald-50 text-slate-700 hover:text-emerald-700 font-semibold py-2 rounded-xl border border-slate-200 text-xs transition">
                                    Detail
                                </a>
                                <button type="button" class="text-center bg-rose-50 hover:bg-rose-100 text-rose-600 font-semibold py-2 rounded-xl border border-rose-100 text-xs transition">
                                    Hapus
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 space-y-4">
                <div>
                    <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Riwayat Pencarian
                    </h2>
                    <p class="text-[11px] text-slate-400 mt-0.5">Klik kata kunci untuk mencari ulang dengan instan.</p>
                </div>

                <div class="divide-y divide-slate-100">
                    
                    <a href="/wisata-desain" class="py-3 flex.items-center justify-between flex hover:bg-slate-50 px-2 rounded-xl transition group">
                        <div class="flex items-center space-x-3">
                            <span class="text-sm font-semibold text-slate-700 group-hover:text-emerald-600 transition">"Banda Aceh"</span>
                        </div>
                        <span class="text-[10px] text-slate-400 font-medium">Baru saja</span>
                    </a>

                    <a href="/wisata-desain" class="py-3 flex items-center justify-between flex hover:bg-slate-50 px-2 rounded-xl transition group">
                        <div class="flex items-center space-x-3">
                            <span class="text-sm font-semibold text-slate-700 group-hover:text-emerald-600 transition">"Yogyakarta"</span>
                        </div>
                        <span class="text-[10px] text-slate-400 font-medium">2 jam yang lalu</span>
                    </a>

                    <a href="/wisata-desain" class="py-3 flex items-center justify-between flex hover:bg-slate-50 px-2 rounded-xl transition group">
                        <div class="flex items-center space-x-3">
                            <span class="text-sm font-semibold text-slate-700 group-hover:text-emerald-600 transition">"Raja Ampat"</span>
                        </div>
                        <span class="text-[10px] text-slate-400 font-medium">Kemarin</span>
                    </a>

                </div>
            </div>

        </div>
    </main>

</body>
</html>