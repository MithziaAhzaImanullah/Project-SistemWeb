<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = Favorite::where('user_id', auth()->id())->get();

        return response()->json([
            'status' => 'success',
            'data' => $favorites,
        ]);
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
            return response()->json([
                'status' => 'error',
                'message' => 'Destination already in favorites',
            ], 400);
        }

        $favorite = Favorite::create([
            'user_id' => auth()->id(),
            'xid' => $request->xid,
            'name' => $request->name,
            'image' => $request->image,
            'city' => $request->city,
            'province' => $request->province,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Destinasi berhasil disimpan ke favorit',
            'data' => $favorite,
        ], 201);
    }

    public function destroy($id)
    {
        $favorite = Favorite::where('user_id', auth()->id())
            ->where('id', $id)
            ->first();

        if (!$favorite) {
            return response()->json([
                'status' => 'error',
                'message' => 'Favorite not found or unauthorized',
            ], 404);
        }

        $favorite->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Destinasi berhasil dihapus dari favorit',
        ]);
    }
}