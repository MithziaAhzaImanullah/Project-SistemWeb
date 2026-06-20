@vite(['resources/css/app.css', 'resources/js/app.js'])

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Akun - Jelajah Indonesia</title>
</head>
<body class="bg-slate-50 text-slate-800 font-sans antialiased min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8 relative overflow-hidden">
    
    <div class="absolute -top-40 -left-40 w-96 h-96 bg-emerald-500/10 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-teal-500/10 rounded-full blur-3xl"></div>

    <div class="sm:mx-auto w-full max-w-md z-10">
        <div class="flex items-center justify-center space-x-2 mb-6">
            <span class="text-3xl">🇮🇩</span>
            <a href="/wisata-desain" class="text-3xl font-black tracking-tight bg-gradient-to-r from-emerald-600 to-teal-700 bg-clip-text text-transparent">
                Jelajah<span class="text-slate-900 font-semibold">Indonesia</span>
            </a>
        </div>
        <h2 class="text-center text-2xl font-extrabold tracking-tight text-slate-900">
            Selamat datang kembali
        </h2>
        <p class="mt-2 text-center text-sm text-slate-500">
            Masuk untuk mengelola wisata favorit dan melihat history pencarianmu.
        </p>
    </div>

    <div class="mt-8 sm:mx-auto w-full max-w-md z-10">
        <div class="bg-white py-8 px-4 shadow-xl border border-slate-100 rounded-3xl sm:px-10">
            
            <form class="space-y-6" action="{{ route('login') }}" method="POST">
                @csrf
                
                <div>
                    <label for="email" class="block text-sm font-bold text-slate-700 mb-2">
                        Alamat Email
                    </label>
                    <div class="relative rounded-xl bg-slate-50 border border-slate-200 focus-within:border-emerald-500 focus-within:ring-2 focus-within:ring-emerald-100 transition">
                        <input id="email" name="email" type="email" autocomplete="email" required class="w-full py-3 px-4 bg-transparent text-slate-900 placeholder-slate-400 text-sm focus:outline-none" placeholder="nama@email.com">
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label for="password" class="block text-sm font-bold text-slate-700">
                            Password
                        </label>
                        <div class="text-sm">
                            <a href="#" class="font-semibold text-emerald-600 hover:text-emerald-700 transition">
                                Lupa password?
                            </a>
                        </div>
                    </div>
                    <div class="relative rounded-xl bg-slate-50 border border-slate-200 focus-within:border-emerald-500 focus-within:ring-2 focus-within:ring-emerald-100 transition">
                        <input id="password" name="password" type="password" autocomplete="current-password" required class="w-full py-3 px-4 bg-transparent text-slate-900 placeholder-slate-400 text-sm focus:outline-none" placeholder="••••••••">
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-slate-300 rounded transition">
                        <label for="remember_me" class="ml-2 block text-sm text-slate-600 font-medium select-none">
                            Ingat saya di perangkat ini
                        </label>
                    </div>
                </div>

                <div>
                    <button type="submit" class="w-full flex justify-center bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold py-3.5 px-4 rounded-xl transition shadow-lg shadow-emerald-600/20 text-sm">
                        Masuk ke Akun
                    </button>
                </div>
            </form>

            <div class="mt-6 pt-6 border-t border-slate-100 text-center">
                <p class="text-sm text-slate-500">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="font-bold text-emerald-600 hover:text-emerald-700 transition">
                        Daftar Akun Baru
                    </a>
                </p>
            </div>

        </div>
        
        <div class="text-center mt-6">
            <a href="/wisata-desain" class="text-xs font-semibold text-slate-400 hover:text-slate-600 transition inline-flex items-center gap-1 group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 transform group-hover:-translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Beranda Wisata
            </a>
        </div>
    </div>

</body>
</html>