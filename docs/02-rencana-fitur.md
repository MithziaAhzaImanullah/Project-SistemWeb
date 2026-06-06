# Rencana Fitur

> Dokumentasikan minimal **5 fitur utama** proyek Anda.
> Salin dan ulangi blok di bawah untuk setiap fitur tambahan.

---

## Fitur 1 — Pencarian Destinasi Wisata

**Role Penanggung Jawab:** `Backend`

**Sumber Data:** `Third-Party API — OpenTripMap API`

**Deskripsi & Ekspektasi:**
`Pengguna dapat mencari destinasi wisata di Indonesia berdasarkan nama kota atau provinsi. Backend Laravel mengirimkan request ke OpenTripMap API dengan parameter lokasi, lalu mengembalikan daftar tempat wisata yang relevan ke frontend. Ekspektasinya adalah hasil pencarian muncul dalam bentuk daftar kartu wisata yang memuat nama tempat, kategori, dan jarak dari pusat kota.`

---

## Fitur 2 — Detail Tempat Wisata

**Role Penanggung Jawab:** `Backend`

**Sumber Data:** `Third-Party API — OpenTripMap API`

**Deskripsi & Ekspektasi:**
`Ketika pengguna mengklik salah satu destinasi dari hasil pencarian, sistem akan menampilkan halaman detail yang memuat informasi lengkap tempat wisata tersebut, termasuk foto, deskripsi, koordinat geografis, dan peta lokasi interaktif (menggunakan embed Google Maps atau Leaflet.js). Backend mengambil data detail berdasarkan ID tempat dari OpenTripMap API.`

---

## Fitur 3 — Konverter Nilai Tukar ke Rupiah

**Role Penanggung Jawab:** `Backend`

**Sumber Data:** `Third-Party API — ExchangeRate-API`

**Deskripsi & Ekspektasi:**
`Pengguna dapat mengkonversi berbagai mata uang asing (USD, EUR, MYR, SGD, dll) ke Rupiah (IDR) secara real-time. Backend Laravel mengambil data kurs terkini dari ExchangeRate-API lalu menghitung dan mengembalikan hasil konversi. Fitur ini berguna khususnya bagi wisatawan mancanegara yang ingin mengetahui estimasi biaya perjalanan dalam Rupiah.`

---

## Fitur 4 — Simpan Wisata Favorit

**Role Penanggung Jawab:** `Backend`

**Sumber Data:** `Internal System`

**Deskripsi & Ekspektasi:**
`Pengguna yang sudah login dapat menyimpan destinasi wisata ke daftar favorit pribadi mereka. Data favorit disimpan di database MySQL dan terikat dengan akun pengguna. Pengguna dapat melihat, mengelola, dan menghapus daftar favorit kapan saja melalui halaman profil. Backend menyediakan endpoint untuk operasi CRUD pada data favorit.`

---

## Fitur 5 — Autentikasi & History Pencarian

**Role Penanggung Jawab:** `Backend`

**Sumber Data:** `Internal System`

**Deskripsi & Ekspektasi:**
`Sistem menyediakan fitur registrasi dan login pengguna menggunakan Laravel Breeze. Setiap kali pengguna yang sudah login melakukan pencarian destinasi, sistem secara otomatis menyimpan riwayat pencarian tersebut ke database. Pengguna dapat melihat history pencarian sebelumnya dan mengkliknya kembali untuk pencarian ulang dengan cepat.`

---

*(Salin blok di atas untuk fitur selanjutnya)*

