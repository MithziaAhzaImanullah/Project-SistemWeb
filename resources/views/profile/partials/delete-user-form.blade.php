<div>
    <p class="text-sm text-slate-500 mb-4">
        Setelah akun kamu dihapus, semua data termasuk daftar favorit wisata akan hilang secara permanen. Tindakan ini tidak dapat dibatalkan.
    </p>

    <button
        onclick="document.getElementById('modal-hapus-akun').classList.remove('hidden')"
        class="bg-rose-500 hover:bg-rose-600 text-white font-semibold px-6 py-2.5 rounded-xl text-sm transition shadow-sm"
    >
        Hapus Akun Saya
    </button>
</div>

{{-- Modal Konfirmasi Hapus Akun --}}
<div id="modal-hapus-akun" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm px-4">
    <div class="bg-white rounded-3xl shadow-2xl p-8 w-full max-w-md border border-slate-100">
        <h3 class="text-lg font-black text-slate-900 mb-1">Yakin ingin menghapus akun?</h3>
        <p class="text-sm text-slate-500 mb-6">
            Masukkan password kamu untuk mengonfirmasi penghapusan akun secara permanen.
        </p>

        <form method="post" action="{{ route('profile.destroy') }}" class="space-y-4">
            @csrf
            @method('delete')

            <div>
                <label for="password-delete" class="block text-sm font-semibold text-slate-700 mb-1.5">Password</label>
                <input
                    id="password-delete"
                    name="password"
                    type="password"
                    placeholder="Masukkan password kamu"
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-rose-400 focus:border-rose-400 transition"
                >
                @error('password', 'userDeletion')
                    <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3 pt-1">
                <button type="submit"
                    class="flex-1 bg-rose-500 hover:bg-rose-600 text-white font-semibold py-2.5 rounded-xl text-sm transition">
                    Ya, Hapus Akun
                </button>
                <button type="button"
                    onclick="document.getElementById('modal-hapus-akun').classList.add('hidden')"
                    class="flex-1 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold py-2.5 rounded-xl text-sm transition">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>