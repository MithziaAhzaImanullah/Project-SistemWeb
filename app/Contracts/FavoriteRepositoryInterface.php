<?php

namespace App\Contracts;

interface FavoriteRepositoryInterface
{
    /**
     * Mengambil semua daftar wisata favorit milik user yang sedang login.
     *
     * @param int $userId ID pengguna
     * @return array|\Illuminate\Database\Eloquent\Collection
     */
    public function getByUserId(int $userId);

    /**
     * Menambahkan destinasi wisata baru ke dalam daftar favorit.
     *
     * @param int $userId ID pengguna
     * @param array $placeData Data tempat wisata (ID, nama, kategori, dll)
     * @return bool
     */
    public function addToFavorite(int $userId, array $placeData): bool;

    /**
     * Menghapus destinasi wisata dari daftar favorit pribadi.
     *
     * @param int $userId ID pengguna
     * @param string $placeId ID tempat wisata yang ingin dihapus
     * @return bool
     */
    public function removeFromFavorite(int $userId, string $placeId): bool;

    /**
     * Mengecek apakah suatu tempat sudah difavoritkan oleh user atau belum.
     *
     * @param int $userId ID pengguna
     * @param string $placeId ID tempat wisata
     * @return bool
     */
    public function isFavorited(int $userId, string $placeId): bool;
}