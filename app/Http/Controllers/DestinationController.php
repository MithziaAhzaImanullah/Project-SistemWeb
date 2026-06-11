<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\SearchHistory;

class DestinationController extends Controller
{
    public function search(Request $request)
    {
        $request->validate([
            'city' => 'required|string',
        ]);

        $city = $request->query('city');
        $limit = $request->query('limit', 10);
        $apiKey = env('OPENTRIPMAP_API_KEY');

        // Ambil koordinat kota
        $geoResponse = Http::withoutVerifying()->get("https://api.opentripmap.com/0.1/en/places/geoname", [
            'name' => $city,
            'country' => 'ID',
            'apikey' => $apiKey,
        ]);

        if ($geoResponse->failed() || !isset($geoResponse['lat'])) {
            return response()->json([
                'status' => 'error',
                'message' => 'City not found or API key invalid',
            ], 404);
        }

        $lat = $geoResponse['lat'];
        $lon = $geoResponse['lon'];

        // Simpan history pencarian kalau user login
        if (auth()->check()) {
            SearchHistory::create([
                'user_id' => auth()->id(),
                'keyword' => $city,
            ]);
        }

        // Ambil daftar wisata
        $placesResponse = Http::withoutVerifying()->get("https://api.opentripmap.com/0.1/en/places/radius", [
            'radius' => 10000,
            'lon' => $lon,
            'lat' => $lat,
            'kinds' => 'interesting_places',
            'limit' => $limit,
            'apikey' => $apiKey,
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $placesResponse['features'] ?? [],
        ]);
    }

    public function detail($xid)
    {
        $apiKey = env('OPENTRIPMAP_API_KEY');

        $response = Http::get("https://api.opentripmap.com/0.1/en/places/xid/{$xid}", [
            'apikey' => $apiKey,
        ]);

        if ($response->failed()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Destination not found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $response->json(),
        ]);
    }
}