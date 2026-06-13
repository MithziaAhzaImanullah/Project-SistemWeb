<?php

namespace App\Repositories;

use App\Contracts\SearchHistoryRepositoryInterface;
use App\Models\SearchHistory;

class SearchHistoryRepository implements SearchHistoryRepositoryInterface
{
    public function getRecentHistory(int $userId, int $limit = 5)
    {
        return SearchHistory::where('user_id', $userId)
            ->latest()
            ->take($limit)
            ->get();
    }

    public function saveHistory(int $userId, string $query): bool
    {
        $history = SearchHistory::create([
            'user_id' => $userId,
            'keyword' => $query,
        ]);

        return isset($history);
    }

    public function clearHistory(int $userId): bool
    {
        return SearchHistory::where('user_id', $userId)->delete() > 0;
    }
}