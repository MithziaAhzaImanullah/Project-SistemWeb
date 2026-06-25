<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ExchangeRateService;
use App\Contracts\CurrencyConverterInterface;
use App\Contracts\TourismServiceInterface;
use App\Services\OpenTripMapService;
use App\Contracts\SearchHistoryRepositoryInterface;
use App\Repositories\SearchHistoryRepository;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(CurrencyConverterInterface::class, ExchangeRateService::class);
        $this->app->bind(TourismServiceInterface::class, OpenTripMapService::class);
        $this->app->bind(SearchHistoryRepositoryInterface::class, SearchHistoryRepository::class);
    }

    public function boot(): void
    {
        \Illuminate\Support\Facades\Http::withoutVerifying();
    }
}