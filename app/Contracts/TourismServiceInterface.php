<?php

namespace App\Contracts;

interface TourismServiceInterface
{
    /**
     * Fitur 1: Pencarian Destinasi Wisata
     * Mencari tempat wisata berdasarkan nama kota atau provinsi.
     *
     * @param string $location Nama kota atau provinsi (e.g., "Banda Aceh")
     * @param array $filters Filter tambahan seperti kategori atau limit data
     * @return array Daftar tempat wisata format standar (kartu wisata)
     */
    public function searchByLocation(string $location, array $filters = []): array;

    /**
     * Fitur 2: Detail Tempat Wisata
     * Mengambil detail lengkap objek wisata berdasarkan ID dari OpenTripMap.
     *
     * @param string $placeId ID unik destinasi dari pihak ketiga
     * @return array Detail tempat mencakup koordinat, foto, deskripsi, dll.
     */
    public function getPlaceDetail(string $placeId): array;
}