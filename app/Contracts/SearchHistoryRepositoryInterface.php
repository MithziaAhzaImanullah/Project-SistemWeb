<?php

namespace App\Contracts;

interface SearchHistoryRepositoryInterface
{
    /**
     * Mengambil riwayat pencarian terbaru dari user tertentu.
     *
     * @param int $userId ID pengguna
     * @param int $limit Batas maksimal riwayat yang ditampilkan
     * @return array|\Illuminate\Database\Eloquent\Collection
     */
    public function getRecentHistory(int $userId, int $limit = 5);

    /**
     * Menyimpan riwayat kata kunci pencarian baru ke database secara otomatis.
     *
     * @param int $userId ID pengguna
     * @param string $query Kata kunci lokasi/provinsi yang dicari
     * @return bool
     */
    public function saveHistory(int $userId, string $query): bool;

    /**
     * Membersihkan atau menghapus seluruh riwayat pencarian milik user.
     *
     * @param int $userId ID pengguna
     * @return bool
     */
    public function clearHistory(int $userId): bool;
}