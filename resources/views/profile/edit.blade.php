<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil - Jelajah Indonesia</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-800 font-sans antialiased">

    {{-- Navbar --}}
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
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 rounded-full bg-emerald-600 text-white font-bold text-xs flex items-center justify-center shadow-md">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <span class="text-sm font-bold text-slate-700">{{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-xs text-slate-400 hover:text-rose-500 transition font-medium">Keluar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-6">

        {{-- Header --}}
        <div class="bg-gradient-to-r from-slate-900 to-emerald-950 text-white p-8 rounded-3xl shadow-sm border border-slate-800 relative overflow-hidden">
            <div class="absolute right-0 bottom-0 top-0 opacity-10 flex items-center justify-center text-9xl font-black pr-10 pointer-events-none select-none">👤</div>
            <h1 class="text-2xl sm:text-3xl font-black tracking-tight">Edit Profil</h1>
            <p class="text-slate-400 text-sm mt-2">Perbarui informasi akun, email, dan password kamu.</p>
        </div>

        {{-- Kembali ke Dashboard --}}
        <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm font-semibold text-emerald-600 hover:text-emerald-700 transition gap-1 group">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke Dashboard
        </a>

        {{-- Section 1: Update Nama & Email --}}
        <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-100">
            <div class="mb-6">
                <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Informasi Profil
                </h2>
                <p class="text-xs text-slate-400 mt-1">Perbarui nama dan alamat email akun kamu.</p>
            </div>
            @include('profile.partials.update-profile-information-form')
        </div>

        {{-- Section 2: Update Password --}}
        <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-100">
            <div class="mb-6">
                <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    Ubah Password
                </h2>
                <p class="text-xs text-slate-400 mt-1">Pastikan akun kamu menggunakan password yang kuat dan aman.</p>
            </div>
            @include('profile.partials.update-password-form')
        </div>

        {{-- Section 3: Hapus Akun --}}
        <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-rose-100">
            <div class="mb-6">
                <h2 class="text-lg font-bold text-rose-600 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    Hapus Akun
                </h2>
                <p class="text-xs text-slate-400 mt-1">Setelah akun dihapus, semua data akan dihilangkan secara permanen.</p>
            </div>
            @include('profile.partials.delete-user-form')
        </div>

    </main>

</body>
</html>