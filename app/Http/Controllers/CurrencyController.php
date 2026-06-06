<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CurrencyController extends Controller
{
    public function convert(Request $request)
    {
        $request->validate([
            'from' => 'required|string|size:3',
            'amount' => 'required|numeric|min:0',
        ]);

        $from = strtoupper($request->query('from'));
        $amount = $request->query('amount');
        $apiKey = env('EXCHANGERATE_API_KEY');

        $response = Http::get("https://v6.exchangerate-api.com/v6/{$apiKey}/pair/{$from}/IDR/{$amount}");

        if ($response->failed() || $response['result'] === 'error') {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid currency code or API key invalid',
            ], 400);
        }

        return response()->json([
            'status' => 'success',
            'data' => [
                'from' => $from,
                'to' => 'IDR',
                'amount' => (float) $amount,
                'rate' => $response['conversion_rate'],
                'result' => $response['conversion_result'],
                'last_updated' => $response['time_last_update_utc'],
            ],
        ]);
    }
}