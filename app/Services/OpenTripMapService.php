<?php

namespace App\Services;

use App\Contracts\TourismServiceInterface;
use Illuminate\Support\Facades\Http;
use Exception;

class OpenTripMapService implements TourismServiceInterface
{
    protected string $apiKey;
    protected string $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('services.opentripmap.key', env('OPENTRIPMAP_API_KEY'));
        $this->baseUrl = "https://api.opentripmap.com/0.1/en/places";
    }

    /**
     * Fitur 1: Pencarian Destinasi Wisata berdasarkan lokasi (Kota/Provinsi)
     */
    public function searchByLocation(string $location, array $filters = []): array
    {
        $limit = $filters['limit'] ?? 10;

        // Langkah 1: Ambil koordinat (Geoname)
        $geoResponse = Http::withoutVerifying()->get("{$this->baseUrl}/geoname", [
            'name' => $location,
            'country' => 'ID',
            'apikey' => $this->apiKey,
        ]);

        if ($geoResponse->failed() || !isset($geoResponse['lat'])) {
            throw new Exception('City not found or OpenTripMap API error');
        }

        $lat = $geoResponse['lat'];
        $lon = $geoResponse['lon'];

        // Langkah 2: Ambil daftar wisata berdasarkan radius koordinat tersebut
        $placesResponse = Http::withoutVerifying()->get("{$this->baseUrl}/radius", [
            'radius' => 10000, // 10 KM
            'lon' => $lon,
            'lat' => $lat,
            'kinds' => 'interesting_places',
            'limit' => $limit,
            'apikey' => $this->apiKey,
        ]);

        return $placesResponse['features'] ?? [];
    }

    /**
     * Fitur 2: Detail Tempat Wisata berdasarkan XID
     */
    public function getPlaceDetail(string $placeId): array
    {
        $response = Http::withoutVerifying()->get("{$this->baseUrl}/xid/{$placeId}", [
            'apikey' => $this->apiKey,
        ]);

        if ($response->failed()) {
            throw new Exception('Destination not found');
        }

        return $response->json();
    }
}