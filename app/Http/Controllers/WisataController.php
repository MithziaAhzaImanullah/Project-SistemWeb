<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WisataController extends Controller
{
    // 1. Fungsi untuk mencari daftar tempat wisata berdasarkan nama daerah
    public function index(Request $request)
    {
        $search = $request->query('search');
        $places = [];

        if ($search) {
            // Langkah A: Dapatkan koordinat Lat & Lon dari nama daerah (Geocoding)
            $geoResponse = Http::get("https://api.opentripmap.com/0.1/en/places/geoname", [
                'name' => $search,
                'apikey' => env('OPENTRIPMAP_API_KEY'),
            ]);

            if ($geoResponse->successful() && isset($geoResponse['lat'])) {
                $lat = $geoResponse['lat'];
                $lon = $geoResponse['lon'];

                // Langkah B: Cari objek wisata di sekitar koordinat tersebut
                $placesResponse = Http::get("https://api.opentripmap.com/0.1/en/places/radius", [
                    'radius' => 5000, // radius 5km
                    'lon' => $lon,
                    'lat' => $lat,
                    'rate' => '2',    // Filter objek populer yang memiliki dokumentasi/gambar
                    'format' => 'json',
                    'apikey' => env('OPENTRIPMAP_API_KEY'),
                ]);

                if ($placesResponse->successful()) {
                    $places = $placesResponse->json();
                }
            }
        }

        return view('wisata.index', compact('places', 'search'));
    }

    // 2. Fungsi OTOMATIS untuk mengambil detail objek wisata apapun menggunakan XID dari API
    public function show(Request $request)
    {
        // 1. Ambil query parameter 'xid' dari URL browser (?xid=W779341107)
        $xid = $request->query('xid');

        if (!$xid) {
            return redirect('/wisata-desain')->with('error', 'ID destinasi tidak ditemukan.');
        }

        // 2. Tembak endpoint detail OpenTripMap menggunakan xid objek secara dinamis
        $response = Http::get("https://api.opentripmap.com/0.1/en/places/xid/{$xid}", [
            'apikey' => env('OPENTRIPMAP_API_KEY'),
        ]);

        if ($response->failed()) {
            return redirect('/wisata-desain')->with('error', 'Gagal memuat detail destinasi wisata dari API.');
        }

        $data = $response->json();

        // 3. Susun data secara dinamis dari response API untuk dilempar ke file Blade
        $wisata = [
            'xid'         => $data['xid'] ?? '',
            'name'        => $data['name'] ?? 'Nama Tidak Tersedia',
            'image'       => $data['preview']['source'] ?? null, // Mengambil gambar asli dari objek API
            'kinds'       => $data['kinds'] ?? 'Destinasi Wisata',
            'address'     => $data['address']['road'] ?? ($data['address']['city'] ?? 'Lokasi tidak spesifik'),
            'city'        => $data['address']['city'] ?? ($data['address']['county'] ?? ''),
            'province'    => $data['address']['state'] ?? '',
            'description' => $data['wikipedia_extracts']['text'] ?? 'Tidak ada deskripsi tambahan untuk objek wisata ini.',
            'lat'         => $data['point']['lat'] ?? '0',
            'lon'         => $data['point']['lon'] ?? '0'
        ];

        // 4. Lemparkan variabel $wisata yang beralih dinamis ini ke view
        return view('wisata.show', compact('wisata'));
    }
}