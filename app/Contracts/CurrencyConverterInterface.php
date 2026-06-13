<?php

namespace App\Contracts;

interface CurrencyConverterInterface
{
    /**
     * Fitur 3: Konverter Nilai Tukar ke Rupiah
     * Mengonversi nominal dari mata uang asing tertentu ke IDR secara real-time.
     *
     * @param string $fromCurrency Kode mata uang asal (e.g., "USD", "MYR", "SGD")
     * @param float $amount Jumlah uang yang ingin dikonversi
     * @return float Total nilai dalam Rupiah (IDR)
     */
    public function convertToIdr(string $fromCurrency, float $amount): float;

    /**
     * Mengambil rate dasar kurs terbaru terhadap IDR.
     * * @return array Daftar rate mata uang asing terhadap IDR
     */
    public function getLatestRates(): array;
}