<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function index()
    {
        // 1. Ambil semua data favorit milik user yang sedang login dari database SQLite
        $favorites = Favorite::where('user_id', auth()->id())->get();

        // 2. Return ke view dashboard.blade.php sambil membawa variabel $favorites
        return view('dashboard', compact('favorites'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'xid' => 'required|string',
            'name' => 'required|string',
            'image' => 'nullable|string',
            'city' => 'nullable|string',
            'province' => 'nullable|string',
        ]);

        // Cek apakah sudah ada di favorit
        $exists = Favorite::where('user_id', auth()->id())
            ->where('xid', $request->xid)
            ->exists();

        if ($exists) {
            return redirect('/dashboard')->with('error', 'Destinasi sudah ada di daftar favorit kamu!');
        }

        $favorite = Favorite::create([
            'user_id' => auth()->id(),
            'xid' => $request->xid,
            'name' => $request->name,
            'image' => $request->image,
            'city' => $request->city,
            'province' => $request->province,
        ]);

        // KEMBALI KE DASHBOARD dengan membawa session success agar data langsung muncul
        return redirect('/dashboard')->with('success', 'Destinasi berhasil disimpan ke favorit!');
    }

    public function destroy($id)
    {
        // Cari data favorit milik user yang sedang login
        $favorite = Favorite::where('user_id', auth()->id())
            ->where('id', $id)
            ->first();

        // Jika data tidak ditemukan, redirect balik dengan pesan error
        if (!$favorite) {
            return redirect()->back()->with('error', 'Destinasi tidak ditemukan atau tidak sah.');
        }

        // Proses hapus data
        $favorite->delete();

        // KEMBALI KE DASHBOARD dengan membawa session success
        return redirect()->back()->with('success', 'Destinasi berhasil dihapus dari favorit');
    }
}