@vite(['resources/css/app.css', 'resources/js/app.js'])

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jelajah Indonesia - Solusi Perjalanan Wisata Nusantara</title>
</head>
<body class="bg-slate-950 text-white font-sans antialiased min-h-screen flex flex-col justify-between relative overflow-hidden">

    <div class="absolute top-0 left-1/4 w-[500px] h-[500px] bg-emerald-500/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 right-1/4 w-[500px] h-[500px] bg-teal-500/10 rounded-full blur-3xl"></div>

    <header class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 h-24 flex items-center justify-between z-10">
        <div class="flex items-center space-x-2">
            <span class="text-2xl">🇮🇩</span>
            <span class="text-2xl font-black tracking-tight bg-gradient-to-r from-emerald-400 to-teal-300 bg-clip-text text-transparent">
                Jelajah<span class="text-white font-semibold">Indonesia</span>
            </span>
        </div>
        <a href="/login-desain" class="text-sm font-bold bg-white/5 hover:bg-white/10 text-slate-200 px-5 py-2.5 rounded-xl border border-white/10 transition">
            Masuk Aplikasi
        </a>
    </header>

    <main class="max-w-4xl mx-auto px-4 text-center my-auto z-10 space-y-8 py-12">
        <span class="inline-flex items-center gap-1.5 py-1.5 px-4 rounded-full text-xs font-bold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
            🌴 Aplikasi Sistem Web Informasi Wisata Terpadu
        </span>
        <h1 class="text-5xl sm:text-7xl font-black tracking-tight leading-tight">
            Rasakan Kedamaian <br>
            <span class="bg-gradient-to-r from-emerald-400 via-teal-300 to-cyan-400 bg-clip-text text-transparent">Keindahan Nusantara</span>
        </h1>
        <p class="text-slate-400 max-w-2xl mx-auto text-base sm:text-xl leading-relaxed">
            Platform modern untuk mencari destinasi wisata di Indonesia, memetakan lokasi interaktif secara real-time, serta konversi nilai tukar kurs mata uang asing langsung.
        </p>
        
        <div class="pt-4">
            <a href="/wisata-desain" class="inline-flex items-center justify-center bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-slate-950 font-black px-8 py-4 rounded-2xl transition shadow-xl shadow-emerald-500/10 text-base gap-2 group">
                Mulai Penjelajahan
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-14 14m14-14H3" />
                </svg>
            </a>
        </div>
    </main>

    <footer class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-8 text-center text-xs text-slate-600 z-10 border-t border-white/5">
        &copy; 2026 Jelajah Indonesia. Dibuat untuk Tugas Besar Pemrograman Web & Mobile.
    </footer>

</body>
</html>