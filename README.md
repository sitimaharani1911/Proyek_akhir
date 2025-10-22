# Sistem Informasi Hibah

## Panduan Instalasi
Berikut adalah langkah-langkah yang jelas untuk menginstal dan menjalankan proyek ini di komputer Anda.

## 1. Clone Repository
Buka terminal Anda, lalu jalankan perintah berikut:
```
git clone https://github.com/sitimaharani1911/Proyek_akhir
cd proyek_akhir
```

## 2. Setup Backend (Laravel)
Instal dependensi PHP dan konfigurasikan environment.

#### Instal dependensi via Composer
`composer install`

#### Buat file .env dari contoh
`cp .env.example .env`

#### Generate application key
`php artisan key:generate`

Penting: Buka file .env dan sesuaikan koneksi database Anda (nama database, username, password)

## 3. Migrasi Database
Jalankan migrasi untuk membuat semua tabel yang dibutuhkan.

`php artisan migrate`

## Menjalankan Aplikasi
Setelah instalasi selesai, ikuti langkah ini untuk menjalankan server pengembangan.

#### Di Terminal 1, jalankan server PHP:
`php artisan serve`


Setelah itu, buka browser dan akses alamat berikut: http://127.0.0.1:8000
