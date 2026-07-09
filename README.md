# Repository Proyek UAS PPB - Naufal Elghani

Selamat datang di repositori proyek UAS mata kuliah Pemrograman Perangkat Bergerak (PPB). Repositori ini berisi struktur proyek untuk *backend* (Laravel) dan *mobile* (Flutter) sebagai bagian dari tugas akhir.

## Identitas Mahasiswa
- **Nama**: Naufal Elghani
- **NIM**: C030324100
- **Kelas**: TI-4C

---

## Prasyarat (Requirements) & Dependensi
Untuk dapat menjalankan proyek ini di komputer lokal, pastikan Anda telah menginstal perangkat lunak dan dependensi berikut:

### Backend (Laravel API)
- **PHP**: Versi 8.2 atau yang lebih baru.
- **Composer**: Untuk manajemen dependensi PHP.
- **MySQL / MariaDB**: Bisa menggunakan XAMPP, Laragon, atau layanan *database* lokal lainnya.
- **Laravel Sanctum**: Wajib terinstal dan terkonfigurasi untuk sistem autentikasi API (*Token-based*).

### Mobile (Flutter)
- **Flutter SDK**: Versi stabil (*stable channel*) terbaru.
- **VS Code atau Android Studio**: Disertai dengan ekstensi/plugin Flutter dan Dart.
- **Package Flutter Utama**:
  - `http` (untuk melakukan HTTP request ke API Laravel).
  - `shared_preferences` (untuk menyimpan token autentikasi di penyimpanan lokal).
- **Emulator** (Android) atau **Perangkat Fisik Android** untuk menjalankan aplikasi.

---

## Informasi Akses Database (Development)
Berikut adalah kredensial akses untuk *testing* pada *database* lingkungan pengembangan:

| Keterangan | Informasi |
| :--- | :--- |
| **Email** | `naufal@test.com` |
| **Password** | `naufal24` |
| **Status** | `final_ok` |

> **PERINGATAN:** Kredensial di atas hanya digunakan untuk keperluan pengujian internal. Harap tidak menyebarluaskan informasi ini untuk menjaga keamanan aplikasi.

---

## Struktur Repositori
```text
uas-ppb/
├── backend-c030324100/       # Kode sumber sisi server (Laravel API)
├── mobile_c030324100/        # Kode sumber aplikasi mobile (Flutter)
├── db-uas-ppb-c030324100.sql # File dump database backend
└── README.md                 # Dokumentasi proyek
