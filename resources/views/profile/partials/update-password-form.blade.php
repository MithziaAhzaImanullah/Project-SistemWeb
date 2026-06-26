<form method="post" action="{{ route('password.update') }}" class="space-y-5">
    @csrf
    @method('put')

    {{-- Password Lama --}}
    <div>
        <label for="current_password" class="block text-sm font-semibold text-slate-700 mb-1.5">Password Saat Ini</label>
        <input
            id="current_password"
            name="current_password"
            type="password"
            autocomplete="current-password"
            class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 transition"
        >
        @error('current_password', 'updatePassword')
            <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Password Baru --}}
    <div>
        <label for="password" class="block text-sm font-semibold text-slate-700 mb-1.5">Password Baru</label>
        <input
            id="password"
            name="password"
            type="password"
            autocomplete="new-password"
            class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 transition"
        >
        @error('password', 'updatePassword')
            <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Konfirmasi Password Baru --}}
    <div>
        <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 mb-1.5">Konfirmasi Password Baru</label>
        <input
            id="password_confirmation"
            name="password_confirmation"
            type="password"
            autocomplete="new-password"
            class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 transition"
        >
        @error('password_confirmation', 'updatePassword')
            <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Tombol Simpan --}}
    <div class="flex items-center gap-4 pt-1">
        <button type="submit"
            class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-6 py-2.5 rounded-xl text-sm transition shadow-sm">
            Perbarui Password
        </button>
        @if (session('status') === 'password-updated')
            <p class="text-xs text-emerald-600 font-semibold">✅ Password berhasil diperbarui.</p>
        @endif
    </div>
</form>