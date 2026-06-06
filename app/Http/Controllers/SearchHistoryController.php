<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SearchHistory;

class SearchHistoryController extends Controller
{
    public function index()
    {
        $histories = SearchHistory::where('user_id', auth()->id())
            ->latest()
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $histories,
        ]);
    }

    public function destroy($id)
    {
        $history = SearchHistory::where('user_id', auth()->id())
            ->where('id', $id)
            ->first();

        if (!$history) {
            return response()->json([
                'status' => 'error',
                'message' => 'History not found or unauthorized',
            ], 404);
        }

        $history->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'History berhasil dihapus',
        ]);
    }
}