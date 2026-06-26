<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WisataController extends Controller
{
    // ── Helper: Terjemahkan teks ke Bahasa Indonesia via MyMemory API ──
    private function terjemahkan(string $teks, string $dariLang = 'en'): string
    {
        // Jika teks kosong atau terlalu pendek, tidak perlu diterjemahkan
        if (empty(trim($teks)) || mb_strlen($teks) < 10) {
            return $teks;
        }

        // Potong teks jika terlalu panjang (MyMemory gratis max ~500 kata)
        $teks = mb_substr($teks, 0, 1500);

        try {
            $response = Http::withoutVerifying()
                ->timeout(5)
                ->get('https://api.mymemory.translated.net/get', [
                    'q'        => $teks,
                    'langpair' => "{$dariLang}|id",
                ]);

            if ($response->successful()) {
                $data = $response->json();
                $hasil = $data['responseData']['translatedText'] ?? null;

                // MyMemory kadang mengembalikan error sebagai teks — cek dulu
                if ($hasil && !str_starts_with(strtoupper($hasil), 'MYMEMORY WARNING')) {
                    return $hasil;
                }
            }
        } catch (\Exception $e) {
            // Jika API terjemahan gagal, kembalikan teks asli saja
        }

        return $teks;
    }

    // ── Helper: Deteksi bahasa teks (sederhana berdasarkan karakter) ──
    private function deteksiBahasa(string $teks): string
    {
        // Deteksi karakter Arab
        if (preg_match('/[\x{0600}-\x{06FF}]/u', $teks)) return 'ar';
        // Deteksi karakter Jepang/China/Korea
        if (preg_match('/[\x{3000}-\x{9FFF}]/u', $teks)) return 'ja';
        // Deteksi karakter Cyrillic (Rusia, dll)
        if (preg_match('/[\x{0400}-\x{04FF}]/u', $teks)) return 'ru';
        // Default anggap bahasa Inggris
        return 'en';
    }

    // ── Helper: Ambil gambar dari Wikipedia berdasarkan nama tempat ──
    private function ambilGambarWikipedia(string $namaTempat): ?string
    {
        try {
            $response = Http::withoutVerifying()
                ->timeout(4)
                ->get('https://en.wikipedia.org/w/api.php', [
                    'action'      => 'query',
                    'titles'      => $namaTempat,
                    'prop'        => 'pageimages',
                    'format'      => 'json',
                    'pithumbsize' => 500,
                ]);

            if ($response->successful()) {
                $pages = $response->json()['query']['pages'] ?? [];
                $page  = reset($pages);
                return $page['thumbnail']['source'] ?? null;
            }
        } catch (\Exception $e) {
            // Gagal ambil gambar Wikipedia, lanjut ke fallback
        }

        return null;
    }

    // ── 1. Daftar tempat wisata berdasarkan nama daerah ──
    public function index(Request $request)
    {
        $search = $request->query('search');
        $places = [];

        if ($search) {
            $geoResponse = Http::withoutVerifying()->get(
                "https://api.opentripmap.com/0.1/en/places/geoname",
                [
                    'name'   => $search,
                    'apikey' => env('OPENTRIPMAP_API_KEY'),
                ]
            );

            if ($geoResponse->successful() && isset($geoResponse['lat'])) {
                $lat = $geoResponse['lat'];
                $lon = $geoResponse['lon'];

                $placesResponse = Http::withoutVerifying()->get(
                    "https://api.opentripmap.com/0.1/en/places/radius",
                    [
                        'radius' => 50000,
                        'lon'    => $lon,
                        'lat'    => $lat,
                        'rate'   => '2',
                        'limit'  => 30,
                        'format' => 'json',
                        'apikey' => env('OPENTRIPMAP_API_KEY'),
                    ]
                );

                if ($placesResponse->successful()) {
                    $rawPlaces = collect($placesResponse->json())
                        ->filter(fn($item) => !empty($item['name']))
                        ->values()
                        ->all();

                    // ── Tambahkan gambar Wikipedia jika API tidak punya gambar ──
                    foreach ($rawPlaces as &$item) {
                        if (empty($item['preview']['source'])) {
                            $gambar = $this->ambilGambarWikipedia($item['name']);
                            if ($gambar) {
                                $item['preview']['source'] = $gambar;
                            }
                        }
                    }
                    unset($item);

                    $places = $rawPlaces;
                }
            }
        }

        return view('wisata.index', compact('places', 'search'));
    }

    // ── 2. Detail objek wisata berdasarkan XID ──
    public function show(Request $request)
    {
        $xid = $request->query('xid');

        if (!$xid) {
            return redirect('/wisata-desain')->with('error', 'ID destinasi tidak ditemukan.');
        }

        $response = Http::withoutVerifying()->get(
            "https://api.opentripmap.com/0.1/en/places/xid/{$xid}",
            ['apikey' => env('OPENTRIPMAP_API_KEY')]
        );

        if ($response->failed()) {
            return redirect('/wisata-desain')->with('error', 'Gagal memuat detail destinasi wisata dari API.');
        }

        $data = $response->json();

        // ── Ambil deskripsi mentah ──
        $deskripsiMentah =
            $data['wikipedia_extracts']['text']
            ?? $data['info']['descr']
            ?? '';

        // ── Terjemahkan deskripsi ke Bahasa Indonesia ──
        if (!empty($deskripsiMentah)) {
            $bahasaAsal  = $this->deteksiBahasa($deskripsiMentah);
            $deskripsiId = $this->terjemahkan($deskripsiMentah, $bahasaAsal);
        } else {
            $deskripsiId = 'Tidak ada deskripsi tambahan untuk objek wisata ini.';
        }

        // ── Ambil gambar: utamakan dari API, fallback ke Wikipedia ──
        $gambar = $data['preview']['source'] ?? null;
        if (!$gambar) {
            $gambar = $this->ambilGambarWikipedia($data['name'] ?? '');
        }

        $wisata = [
            'xid'         => $data['xid'] ?? '',
            'name'        => $data['name'] ?? 'Nama Tidak Tersedia',
            'image'       => $gambar,
            'kinds'       => ucfirst(str_replace('_', ' ', explode(',', $data['kinds'] ?? 'Wisata')[0])),
            'address'     => $data['address']['road'] ?? ($data['address']['city'] ?? 'Lokasi tidak spesifik'),
            'city'        => $data['address']['city'] ?? ($data['address']['county'] ?? ''),
            'province'    => $data['address']['state'] ?? '',
            'description' => $deskripsiId,
            'lat'         => $data['point']['lat'] ?? '0',
            'lon'         => $data['point']['lon'] ?? '0',
        ];

        return view('wisata.show', compact('wisata'));
    }
}