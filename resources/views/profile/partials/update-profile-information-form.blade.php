<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>

<form method="post" action="{{ route('profile.update') }}" class="space-y-5">
    @csrf
    @method('patch')

    {{-- Nama --}}
    <div>
        <label for="name" class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Lengkap</label>
        <input
            id="name"
            name="name"
            type="text"
            value="{{ old('name', $user->name) }}"
            required
            autofocus
            autocomplete="name"
            class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 transition"
        >
        @error('name')
            <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Email --}}
    <div>
        <label for="email" class="block text-sm font-semibold text-slate-700 mb-1.5">Alamat Email</label>
        <input
            id="email"
            name="email"
            type="email"
            value="{{ old('email', $user->email) }}"
            required
            autocomplete="username"
            class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 transition"
        >
        @error('email')
            <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
        @enderror

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div class="mt-2 p-3 bg-amber-50 border border-amber-200 rounded-xl text-xs text-amber-700">
                Email kamu belum terverifikasi.
                <button form="send-verification" class="underline font-semibold hover:text-amber-900 transition">
                    Kirim ulang verifikasi
                </button>
                @if (session('status') === 'verification-link-sent')
                    <p class="mt-1 text-emerald-600 font-semibold">Link verifikasi baru telah dikirim ke email kamu.</p>
                @endif
            </div>
        @endif
    </div>

    {{-- Tombol Simpan --}}
    <div class="flex items-center gap-4 pt-1">
        <button type="submit"
            class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-6 py-2.5 rounded-xl text-sm transition shadow-sm">
            Simpan Perubahan
        </button>
        @if (session('status') === 'profile-updated')
            <p class="text-xs text-emerald-600 font-semibold">✅ Profil berhasil diperbarui.</p>
        @endif
    </div>
</form>