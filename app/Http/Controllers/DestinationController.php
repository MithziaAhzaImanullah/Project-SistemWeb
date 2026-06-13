<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\TourismServiceInterface;
use App\Contracts\SearchHistoryRepositoryInterface;
use Exception;

class DestinationController extends Controller
{
    protected TourismServiceInterface $tourismService;
    protected SearchHistoryRepositoryInterface $historyRepository;

    // Inject kedua interface yang dibutuhkan lewat constructor
    public function __construct(
        TourismServiceInterface $tourismService,
        SearchHistoryRepositoryInterface $historyRepository
    ) {
        $this->tourismService = $tourismService;
        $this->historyRepository = $historyRepository;
    }

    public function search(Request $request)
    {
        $request->validate([
            'city' => 'required|string',
        ]);

        $city = $request->query('city');
        $limit = (int) $request->query('limit', 10);

        try {
            // 1. Ambil data destinasi dari service OpenTripMap
            $destinations = $this->tourismService->searchByLocation($city, ['limit' => $limit]);

            // 2. Simpan history pencarian via Repository secara internal jika user sudah terautentikasi
            if (auth()->check()) {
                $this->historyRepository->saveHistory(auth()->id(), $city);
            }

            return response()->json([
                'status' => 'success',
                'data' => $destinations,
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage() === 'City not found or OpenTripMap API error' 
                    ? 'City not found or API key invalid' 
                    : $e->getMessage(),
            ], 404);
        }
    }

    public function detail($xid)
    {
        try {
            // Ambil detail tempat wisata berdasarkan XID
            $detail = $this->tourismService->getPlaceDetail($xid);

            return response()->json([
                'status' => 'success',
                'data' => $detail,
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 404);
        }
    }
}