<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Jelajah Indonesia</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
        <h2 class="text-center text-2xl font-extrabold tracking-tight text-slate-900">Buat Akun Baru</h2>
        <p class="mt-2 text-center text-sm text-slate-500">Daftar sekarang dan mulai jelajahi destinasi wisata Indonesia.</p>
    </div>

    <div class="mt-8 sm:mx-auto w-full max-w-md z-10">
        <div class="bg-white py-8 px-4 shadow-xl border border-slate-100 rounded-3xl sm:px-10">
            <form class="space-y-5" method="POST" action="{{ route('register') }}">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-bold text-slate-700 mb-2">Nama Lengkap</label>
                    <div class="rounded-xl bg-slate-50 border border-slate-200 focus-within:border-emerald-500 focus-within:ring-2 focus-within:ring-emerald-100 transition">
                        <input id="name" name="name" type="text" autocomplete="name" required value="{{ old('name') }}"
                            class="w-full py-3 px-4 bg-transparent text-slate-900 placeholder-slate-400 text-sm focus:outline-none"
                            placeholder="Nama lengkap kamu">
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div>
                    <label for="email" class="block text-sm font-bold text-slate-700 mb-2">Alamat Email</label>
                    <div class="rounded-xl bg-slate-50 border border-slate-200 focus-within:border-emerald-500 focus-within:ring-2 focus-within:ring-emerald-100 transition">
                        <input id="email" name="email" type="email" autocomplete="username" required value="{{ old('email') }}"
                            class="w-full py-3 px-4 bg-transparent text-slate-900 placeholder-slate-400 text-sm focus:outline-none"
                            placeholder="nama@email.com">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div>
                    <label for="password" class="block text-sm font-bold text-slate-700 mb-2">Password</label>
                    <div class="rounded-xl bg-slate-50 border border-slate-200 focus-within:border-emerald-500 focus-within:ring-2 focus-within:ring-emerald-100 transition">
                        <input id="password" name="password" type="password" autocomplete="new-password" required
                            class="w-full py-3 px-4 bg-transparent text-slate-900 placeholder-slate-400 text-sm focus:outline-none"
                            placeholder="Min. 8 karakter">
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-bold text-slate-700 mb-2">Konfirmasi Password</label>
                    <div class="rounded-xl bg-slate-50 border border-slate-200 focus-within:border-emerald-500 focus-within:ring-2 focus-within:ring-emerald-100 transition">
                        <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required
                            class="w-full py-3 px-4 bg-transparent text-slate-900 placeholder-slate-400 text-sm focus:outline-none"
                            placeholder="Ulangi password">
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <button type="submit" class="w-full flex justify-center bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold py-3.5 px-4 rounded-xl transition shadow-lg shadow-emerald-600/20 text-sm">
                    Buat Akun Sekarang
                </button>
            </form>

            <div class="mt-6 pt-6 border-t border-slate-100 text-center">
                <p class="text-sm text-slate-500">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="font-bold text-emerald-600 hover:text-emerald-700 transition">Masuk Sekarang</a>
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