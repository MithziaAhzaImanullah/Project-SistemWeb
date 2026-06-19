<?php

namespace App\Services;

use App\Contracts\CurrencyConverterInterface;
use Illuminate\Support\Facades\Http;
use Exception;

class ExchangeRateService implements CurrencyConverterInterface
{
    protected string $apiKey;
    protected string $baseUrl;

    public function __construct()
    {
        // Mengambil API key dari env atau config
        $this->apiKey = config('services.exchangerate.key', env('EXCHANGERATE_API_KEY'));
        $this->baseUrl = "https://v6.exchangerate-api.com/v6/{$this->apiKey}";
    }

    /**
     * Fitur 3: Mengonversi nominal mata uang asing ke IDR.
     */
    public function convertToIdr(string $fromCurrency, float $amount): float
    {
        $from = strtoupper($fromCurrency);
        
        $response = Http::withoutVerifying()->get("{$this->baseUrl}/pair/{$from}/IDR/{$amount}");

        if ($response->failed() || $response->json('result') === 'error') {
            throw new Exception('Invalid currency code or API key invalid');
        }

        // Return detail raw array atau sesuaikan dengan kebutuhan, 
        // Namun di interface kita set return float (untuk conversion_result)
        return (float) $response->json('conversion_result');
    }

    /**
     * Alternatif jika Anda ingin mengambil full data object response API (termasuk rate & update time)
     */
    public function getConversionDetails(string $fromCurrency, float $amount): array
    {
        $from = strtoupper($fromCurrency);
        $response = Http::withoutVerifying()->get("{$this->baseUrl}/pair/{$from}/IDR/{$amount}");

        if ($response->failed() || $response->json('result') === 'error') {
            throw new Exception('Invalid currency code or API key invalid');
        }

        return $response->json();
    }

    /**
     * Mengambil semua rates terbaru (bawaan interface)
     */
    public function getLatestRates(): array
    {
        $response = Http::withoutVerifying()->get("{$this->baseUrl}/latest/IDR");
        return $response->json('conversion_rates') ?? [];
    }
}