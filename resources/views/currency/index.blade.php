<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konverter Mata Uang - Jelajah Indonesia</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-800 font-sans antialiased">

    <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-slate-100 shadow-sm">
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
                    <a href="/currency-desain" class="text-sm font-medium text-emerald-600 transition">Konverter Kurs</a>
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

    <main class="max-w-4xl mx-auto px-4 py-16">
        <div class="text-center mb-10">
            <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200 mb-4">
                💱 Fitur Kalkulator Kurs Real-Time
            </span>
            <h1 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">Konverter Mata Uang Asing ke Rupiah</h1>
            <p class="text-slate-500 mt-2 text-sm sm:text-base max-w-xl mx-auto">
                Hitung estimasi pengeluaran perjalananmu dengan data kurs terkini langsung dari ExchangeRate-API.
            </p>
        </div>

        <div class="bg-white rounded-3xl p-6 sm:p-10 shadow-xl border border-slate-100">
            <form action="#" method="POST" class="space-y-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    
                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-slate-700">Jumlah Mata Uang Asing</label>
                        <div class="relative rounded-xl bg-slate-50 border border-slate-200 focus-within:border-emerald-500 focus-within:ring-2 focus-within:ring-emerald-100 transition">
                            <input type="number" name="amount" value="100" class="w-full py-3.5 pl-4 pr-12 bg-transparent text-slate-900 font-semibold focus:outline-none text-base" placeholder="0.00">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-slate-700">Mata Uang Asal</label>
                        <select name="from_currency" class="w-full py-3.5 px-4 rounded-xl bg-slate-50 border border-slate-200 text-slate-800 font-medium focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 transition text-base">
                            <option value="USD">USD - United States Dollar</option>
                            <option value="EUR">EUR - Euro</option>
                            <option value="SGD">SGD - Singapore Dollar</option>
                            <option value="MYR">MYR - Malaysian Ringgit</option>
                            <option value="SAR">SAR - Saudi Arabian Riyal</option>
                        </select>
                    </div>

                </div>

                <button type="button" class="w-full bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold py-4 rounded-xl transition shadow-lg shadow-emerald-600/20 text-sm">
                    Konversi Sekarang
                </button>
            </form>

            <div class="mt-10 pt-8 border-t border-slate-100 text-center space-y-2">
                <p class="text-sm font-medium text-slate-400 uppercase tracking-wider">Hasil Estimasi Konversi</p>
                <div class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">
                    100 USD = <span class="text-emerald-600">IDR 1.635.000,00</span>
                </div>
                <p class="text-xs text-slate-400 italic">
                    *Nilai tukar ini bersifat estimasi real-time untuk kebutuhan perencanaan perjalanan wisata.
                </p>
            </div>
        </div>
    </main>

</body>
</html>