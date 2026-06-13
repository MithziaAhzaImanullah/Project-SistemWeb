<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\CurrencyConverterInterface;
use Exception;

class CurrencyController extends Controller
{
    protected CurrencyConverterInterface $currencyService;

    // Inject interface melalui constructor
    public function __construct(CurrencyConverterInterface $currencyService)
    {
        $this->currencyService = $currencyService;
    }

    public function convert(Request $request)
    {
        // 1. Validasi input query
        $request->validate([
            // Jika dikirim lewat query parameter (?from=USD&amount=10), 
            // validasi bagusnya menggunakan data request langsung
            'from' => 'required|string|size:3',
            'amount' => 'required|numeric|min:0',
        ]);

        $from = strtoupper($request->query('from'));
        $amount = (float) $request->query('amount');

        try {
            // 2. Ambil detail data dari service menggunakan method tambahan khusus detail
            // Atau jika menggunakan method interface asli: $this->currencyService->convertToIdr($from, $amount);
            
            // Menggunakan method dari ExchangeRateService untuk mendapatkan payload lengkap API
            $exchangeData = $this->currencyService->getConversionDetails($from, $amount);

            return response()->json([
                'status' => 'success',
                'data' => [
                    'from' => $from,
                    'to' => 'IDR',
                    'amount' => $amount,
                    'rate' => $exchangeData['conversion_rate'],
                    'result' => $exchangeData['conversion_result'],
                    'last_updated' => $exchangeData['time_last_update_utc'],
                ],
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 400);
        }
    }
}