# API Specification

> Dokumentasikan setiap endpoint yang dikembangkan maupun yang dikonsumsi dari layanan eksternal.
> Salin dan ulangi blok di bawah untuk setiap endpoint tambahan.

---

## 1. Cari Destinasi Wisata

**Method:** `GET`

**URL:** `/api/v1/destinations`

**Deskripsi:** `Mengambil daftar destinasi wisata di Indonesia berdasarkan nama kota atau provinsi, dikonsumsi dari OpenTripMap API.`

**Autentikasi Diperlukan:** `Tidak`

**Sumber:** `Third-Party API — OpenTripMap`

**Request Headers:**
```
Content-Type: application/json
```
**Query Parameters:**
```
city    : string (wajib) — nama kota atau provinsi, contoh: "Medan", "Bali"
limit   : integer (opsional) — jumlah hasil, default 10
```

**Request Body:** `-`

**Response Sukses (`200 OK`):**
```json
{
  "status": "success",
  "data": [
    {
      "xid": "N123456",
      "name": "Danau Toba",
      "kinds": "natural,lakes",
      "distance": 1200,
      "point": {
        "lat": 2.6845,
        "lon": 98.8756
      }
    }
  ]
}
```

**Response Gagal:**
```json
{
  "status": "error",
  "message": "City not found or API key invalid"
}
```

---

## 2. Detail Tempat Wisata

**Method:** `GET`

**URL:** `/api/v1/destinations/{xid}`

**Deskripsi:** Mengambil informasi lengkap satu tempat wisata berdasarkan ID unik (xid) dari OpenTripMap API, termasuk foto, deskripsi, dan koordinat.

**Autentikasi Diperlukan:** `Tidak`

**Sumber:** `Third-Party API — OpenTripMap`

**Request Headers:**
```
Content-Type: application/json
```

**Request Body:** `-`

**Response Sukses (`200 OK`):**
```json
{
  "status": "success",
  "data": {
    "xid": "N123456",
    "name": "Danau Toba",
    "description": "Danau vulkanik terbesar di dunia yang terletak di Sumatera Utara.",
    "kinds": "natural,lakes",
    "image": "https://example.com/danau-toba.jpg",
    "point": {
      "lat": 2.6845,
      "lon": 98.8756
    },
    "address": {
      "city": "Samosir",
      "state": "Sumatera Utara",
      "country": "Indonesia"
    }
  }
}
```

**Response Gagal:**
```json
{
  "status": "error",
  "message": "Destination not found"
}
```

---

## 3. Konverter Nilai Tukar ke Rupiah

**Method:** `GET`

**URL:** `/api/v1/currency/convert`

**Deskripsi:** Mengkonversi jumlah mata uang asing ke Rupiah (IDR) secara real-time menggunakan ExchangeRate-API.

**Autentikasi Diperlukan:** `Tidak`

**Sumber:** `Third-Party API — ExchangeRate-API`

**Request Headers:**
```
Content-Type: application/json
```
**Query Parameters:**
```
from    : string (wajib) — kode mata uang asal, contoh: "USD", "EUR", "MYR"
amount  : number (wajib) — jumlah yang ingin dikonversi, contoh: 100
```

**Request Body:** `-`

**Response Sukses (`200 OK`):**
```json
{
  "status": "success",
  "data": {
    "from": "USD",
    "to": "IDR",
    "amount": 100,
    "rate": 16350.50,
    "result": 1635050.00,
    "last_updated": "2024-06-06"
  }
}
```

**Response Gagal:**
```json
{
  "status": "error",
  "message": "Invalid currency code or API key invalid"
}
```

---

*(Salin blok template di atas untuk setiap endpoint selanjutnya)*

## 4. Simpan Wisata Favorit

**Method:** `POST`

**URL:** `/api/v1/favorites`

**Deskripsi:** Menyimpan destinasi wisata ke daftar favorit pengguna yang sedang login.

**Autentikasi Diperlukan:** `Ya`

**Sumber:** `Internal System`

**Request Headers:**
```
Authorization: Bearer <token>
Content-Type: application/json
```
**Request Body:** 
```json
{
  "xid": "N123456",
  "name": "Danau Toba",
  "image": "https://example.com/danau-toba.jpg",
  "city": "Samosir",
  "province": "Sumatera Utara"
}
```

**Response Sukses (`201 created`):**
```json
{
  "status": "success",
  "message": "Destinasi berhasil disimpan ke favorit",
  "data": {
    "id": 1,
    "xid": "N123456",
    "name": "Danau Toba",
    "user_id": 5
  }
}
```

**Response Gagal:**
```json
{
  "status": "error",
  "message": "Unauthenticated or destination already in favorites"
}
```

---

## 5. Lihat Daftar Favorit

**Method:** `GET`

**URL:** `/api/v1/favorites`

**Deskripsi:** Mengambil seluruh daftar destinasi wisata favorit milik pengguna yang sedang login.

**Autentikasi Diperlukan:** `Ya`

**Sumber:** `Internal System`

**Request Headers:**
```
Authorization: Bearer <token>
Content-Type: application/json
```
**Request Body:** `-`

**Response Sukses (`200 ok`):**
```json
{
  "status": "success",
  "data": [
    {
      "id": 1,
      "xid": "N123456",
      "name": "Danau Toba",
      "image": "https://example.com/danau-toba.jpg",
      "city": "Samosir",
      "province": "Sumatera Utara"
    }
  ]
}
```

**Response Gagal:**
```json
{
  "status": "error",
  "message": "Unauthenticated"
}
```

---

## 6. Hapus Wisata Favorit

**Method:** `DELETE`

**URL:** `/api/v1/favorites/{id}`

**Deskripsi:** Menghapus satu destinasi wisata dari daftar favorit pengguna berdasarkan ID favorit.

**Autentikasi Diperlukan:** `Ya`

**Sumber:** `Internal System`

**Request Headers:**
```
Authorization: Bearer <token>
Content-Type: application/json
```
**Request Body:** `-`

**Response Sukses (`200 ok`):**
```json
{
  "status": "success",
  "message": "Destinasi berhasil dihapus dari favorit"
}
```

**Response Gagal:**
```json
{
  "status": "error",
  "message": "Favorite not found or unauthorized"
}
```

---

## 7. Lihat History Pencarian

**Method:** `GET`

**URL:** `/api/v1/history`

**Deskripsi:** Mengambil riwayat pencarian destinasi wisata yang pernah dilakukan oleh pengguna yang sedang login.

**Autentikasi Diperlukan:** `Ya`

**Sumber:** `Internal System`

**Request Headers:**
```
Authorization: Bearer <token>
Content-Type: application/json
```
**Request Body:** `-`

**Response Sukses (`200 ok`):**
```json
{
  "status": "success",
  "data": [
    {
      "id": 1,
      "keyword": "Bali",
      "searched_at": "2024-06-05 14:32:00"
    },
    {
      "id": 2,
      "keyword": "Lombok",
      "searched_at": "2024-06-06 09:10:00"
    }
  ]
}
```

**Response Gagal:**
```json
{
  "status": "error",
  "message": "Unauthenticated"
}
```

---

## 8. Register

**Method:** `POST`

**URL:** `/api/v1/auth/register`

**Deskripsi:** Mendaftarkan akun pengguna baru ke sistem dan mengembalikan token akses Sanctum.

**Autentikasi Diperlukan:** `Tidak`

**Sumber:** `Internal System`

**Request Headers:**
```
Content-Type: application/json
```
**Request Body:**
```json
{
  "name": "string",
  "email": "string",
  "password": "string",
  "password_confirmation": "string"
}
```

**Response Sukses (`201 created`):**
```json
{
  "status": "success",
  "message": "Akun berhasil dibuat",
  "data": {
    "token": "1|FDReFX3Vorl8YCzdsFZZfL68eKl2th8je7Z5PzH78f1b9527",
    "user": {
      "id": 1,
      "name": "Imam Syuja",
      "email": "imam@example.com",
      "created_at": "2026-06-11T16:04:55.000000Z",
      "updated_at": "2026-06-11T16:04:55.000000Z"
    }
  }
}
```
**Response Gagal:**
```json
{
  "status": "error",
  "message": "Email already taken or validation failed"
}
```

---

## 9. Login

**Method:** `POST`

**URL:** `/api/v1/auth/login`

**Deskripsi:** Autentikasi pengguna dan mengembalikan token akses Sanctum untuk digunakan pada endpoint yang memerlukan autentikasi.

**Autentikasi Diperlukan:** `Tidak`

**Sumber:** `Internal System`

**Request Headers:**
```
Content-Type: application/json
```
**Request Body:**
```json
{
  "email": "string",
  "password": "string"
}
```

**Response Sukses (`200 ok`):**
```json
{
  "status": "success",
  "data": {
    "token": "2|zvyblMB8Xz9kc6lkjWUMBRv3OYdiAR3Rwyat4ebJd6d4a955",
    "user": {
      "id": 1,
      "name": "Imam Syuja",
      "email": "imam@example.com",
      "created_at": "2026-06-11T16:04:55.000000Z",
      "updated_at": "2026-06-11T16:04:55.000000Z"
    }
  }
}
```

**Response Gagal:**
```json
{
  "status": "error",
  "message": "Invalid email or password"
}
```

---