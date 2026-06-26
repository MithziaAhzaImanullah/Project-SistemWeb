<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WisataController extends Controller
{
    // ── Helper: Terjemahkan teks ke Bahasa Indonesia (max 500 char per request) ──
    private function terjemahkan(string $teks, string $dariLang = 'en'): string
    {
        if (empty(trim($teks)) || mb_strlen($teks) < 10) {
            return $teks;
        }

        // Pecah teks menjadi potongan max 450 karakter per bagian (batas aman MyMemory)
        $potongan = [];
        $kalimat  = preg_split('/(?<=[.!?])\s+/', $teks);
        $buffer   = '';

        foreach ($kalimat as $k) {
            if (mb_strlen($buffer) + mb_strlen($k) + 1 <= 450) {
                $buffer .= ($buffer ? ' ' : '') . $k;
            } else {
                if ($buffer !== '') $potongan[] = $buffer;
                $buffer = mb_substr($k, 0, 450); // potong paksa jika 1 kalimat > 450
            }
        }
        if ($buffer !== '') $potongan[] = $buffer;

        $hasil = [];
        foreach ($potongan as $bagian) {
            try {
                $response = Http::withoutVerifying()
                    ->timeout(6)
                    ->get('https://api.mymemory.translated.net/get', [
                        'q'        => $bagian,
                        'langpair' => "{$dariLang}|id",
                    ]);

                if ($response->successful()) {
                    $data        = $response->json();
                    $terjemahan  = $data['responseData']['translatedText'] ?? null;

                    if ($terjemahan && !str_starts_with(strtoupper($terjemahan), 'MYMEMORY WARNING')) {
                        $hasil[] = $terjemahan;
                        continue;
                    }
                }
            } catch (\Exception $e) {
                // jika gagal, pakai teks asli bagian ini
            }
            $hasil[] = $bagian;
        }

        return implode(' ', $hasil);
    }

    // ── Helper: Deteksi bahasa teks ──
    private function deteksiBahasa(string $teks): string
    {
        if (preg_match('/[\x{0600}-\x{06FF}]/u', $teks)) return 'ar';
        if (preg_match('/[\x{3000}-\x{9FFF}]/u', $teks)) return 'ja';
        if (preg_match('/[\x{0400}-\x{04FF}]/u', $teks)) return 'ru';
        return 'en';
    }

    // ── Helper: Ambil gambar dari Wikipedia ──
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
        } catch (\Exception $e) {}

        return null;
    }

    // ── 1. Daftar tempat wisata ──
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

    // ── 2. Detail wisata ──
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

        $deskripsiMentah =
            $data['wikipedia_extracts']['text']
            ?? $data['info']['descr']
            ?? '';

        if (!empty($deskripsiMentah)) {
            $bahasaAsal  = $this->deteksiBahasa($deskripsiMentah);
            $deskripsiId = $this->terjemahkan($deskripsiMentah, $bahasaAsal);
        } else {
            $deskripsiId = 'Tidak ada deskripsi tambahan untuk objek wisata ini.';
        }

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