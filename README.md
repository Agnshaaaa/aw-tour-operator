# 🌴 AW Tour Operator — Platform Biro Perjalanan & Manajemen Wisata

[![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2%2B-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.4-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com/)
[![Vite](https://img.shields.io/badge/Vite-6.x-646CFF?style=for-the-badge&logo=vite&logoColor=white)](https://vitejs.dev/)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg?style=for-the-badge)](LICENSE)

Platform digital terintegrasi untuk **AW Tour Operator Surabaya**, dirancang untuk modernisasi operasional biro perjalanan wisata, otomasi penerimaan penawaran rombongan (*custom quotation*), etalase paket wisata (*open trip* & *destinasi*), serta promosi produk UMKM lokal.

---

## 📌 Ringkasan & Arah Pengembangan Proyek

Platform ini dibangun untuk menyelesaikan friksi konvensional pada biro perjalanan wisata dengan fokus pada:

1. **Digitalisasi Penawaran Rombongan (*Custom Group Quotation*):**
   - Menghilangkan proses tawar-menawar manual yang lambat melalui form *multi-step* terstruktur.
   - Penerbitan otomatis **Nomor Tiket Permintaan** untuk kemudahan penelusuran status penawaran oleh klien rombongan (perusahaan, sekolah, instansi, atau komunitas).
2. **Ketersediaan Transparan (*Interactive Availability Calendar*):**
   - Kalender ketersediaan tanggal/armada (*booked dates*) interaktif yang dapat diakses publik guna mencegah *double-booking*.
3. **Pemberdayaan Ekonomi Lokal (*Etalase UMKM*):**
   - Etalase khusus produk oleh-oleh dan kerajinan khas daerah dari mitra UMKM lokal untuk diintegrasikan ke dalam paket perjalanan wisata.
4. **Sentralisasi Operasional (*Back-Office Admin Dashboard*):**
   - Pengelolaan alur penawaran masuk (*approval pipeline*), pembaruan status pemesanan, penjadwalan kalender, serta manajemen katalog destinasi dan produk UMKM.

---

## 🚀 Fitur Utama

### 👥 Sisi Pengunjung (Publik)
- **Halaman Utama (*Landing Page*):** *Showcase* layanan unggulan, testimoni, dan nilai tambah biro perjalanan.
- **Katalog Destinasi Wisata:** Informasi komprehensif terkait rute perjalanan, fasilitas, dan detail tiap destinasi.
- **Custom Group Quotation Builder:** Form multi-step dinamis untuk pengajuan paket rombongan kustom.
- **Jadwal Open Trip:** Informasi jadwal tur terbuka (*lead generation* wisatawan individual/kelompok kecil).
- **Etalase Produk UMKM:** Katalog produk oleh-oleh khas daerah mitra lokal.
- **Kalender Ketersediaan:** Pengecekan tanggal operasional yang sudah terisi (*booked*) atau masih tersedia.

### 🛡️ Sisi Pengelola (Admin Back-Office)
- **Dashboard Ringkasan & Metrik:** Statistik jumlah permintaan quotation, pesanan, dan status operasional.
- **Manajemen Permintaan (*Request Pipeline*):** Detail permintaan grup, verifikasi data, perubahan status (*pending, processed, approved, rejected*).
- **Pengelolaan Kalender Tanggal Terpesan:** Menandai dan mengunci tanggal operasional tur.
- **CRUD Destinasi Wisata:** Penambahan, modifikasi, dan manajemen visual destinasi.
- **CRUD Produk UMKM:** Pengelolaan katalog produk, harga, dan ketersediaan barang mitra.

---

## 🛠️ Tech Stack

- **Backend Framework:** [Laravel 11](https://laravel.com/)
- **Bahasa Pemrograman:** PHP >= 8.2
- **Frontend / UI:** Blade Templates, [Tailwind CSS 3.4](https://tailwindcss.com/), JavaScript (ES Modules)
- **Asset Bundler:** [Vite 6](https://vitejs.dev/)
- **Database:** SQLite (default lokal) / MySQL (rekomendasi *production*)
- **Task Runner / Concurrency:** Concurrently

---

## 📋 Prasyarat Sistem

Sebelum memulai instalasi, pastikan lingkungan lokal Anda telah terpasang:
- **PHP** versi 8.2 atau lebih baru
- Ekstensi PHP: `pdo_sqlite`, `mbstring`, `openssl`, `curl`, `xml`, `fileinfo`
- **Composer** (Dependency Manager PHP)
- **Node.js** (versi 18.x atau LTS terbaru) & **NPM**
- **Git**

---

## ⚙️ Panduan Setup Lokal (Step-by-Step)

Ikuti langkah-langkah berikut untuk menjalankan proyek di komputer lokal:

### 1. Clone Repository
```bash
git clone https://github.com/Agnshaaaa/aw-tour-operator.git
cd aw-tour-operator
```

### 2. Install Dependensi
Pasang semua paket pustaka PHP dan JavaScript yang dibutuhkan:
```bash
# Dependensi PHP
composer install

# Dependensi Frontend (Node.js)
npm install
```

### 3. Konfigurasi Environment File
Salin template konfigurasi dan hasilkan Application Key unik:
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Setup Database & Migrasi
Secara bawaan, konfigurasi lokal menggunakan **SQLite**. Buat file databasenya:

```bash
# Buat file database SQLite jika belum ada
touch database/database.sqlite
```

Jalankan migrasi tabel beserta *seeder* data awal (akun admin, kategori, destinasi, UMKM, open trip):
```bash
php artisan migrate --seed
```

> **Catatan jika menggunakan MySQL:**
> Ubah variabel berikut pada file `.env` sebelum menjalankan `migrate`:
> ```env
> DB_CONNECTION=mysql
> DB_HOST=127.0.0.1
> DB_PORT=3306
> DB_DATABASE=aw_tour_operator
> DB_USERNAME=root
> DB_PASSWORD=your_password
> ```

### 5. Buat Storage Symlink
Tautkan direktori penyimpanan publik untuk menangani berkas unggahan gambar/media:
```bash
php artisan storage:link
```

### 6. Menjalankan Server Lokal
Aplikasi menyediakan *concurrent runner* melalui Composer untuk menyalakan Laravel server, antrean, dan Vite secara bersamaan:

```bash
composer run dev
```

*Atau jika ingin menjalankan terminal secara terpisah:*
```bash
# Terminal 1: Laravel Web Server
php artisan serve

# Terminal 2: Vite Hot Reloading
npm run dev
```

Aplikasi sekarang dapat diakses melalui peramban web di:
**`http://localhost:8000`**

---

## 🔐 Kredensial Pengujian (Demo / Seeder)

Setelah menjalankan `php artisan migrate --seed`, akun admin bawaan berikut siap digunakan untuk mengakses dashboard manajemen:

| Role | URL Login | Email | Password |
|---|---|---|---|
| **Super Admin** | `http://localhost:8000/admin/login` | `admin@awtour.com` | `admin123` |
| **Admin Operasional** | `http://localhost:8000/admin/login` | `admin2@awtour.com` | `admin123` |

> ⚠️ **Peringatan Keamanan:** Ganti kata sandi bawaan ini segera setelah aplikasi di-*deploy* ke lingkungan staging atau produksi!

---

## 📂 Struktur Direktori Utama

```plaintext
aw-tour-operator/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/         # Controller back-office & dashboard
│   │   │   └── Auth/          # Autentikasi sesi admin
│   │   └── Middleware/        # Proteksi rute & verifikasi role admin
│   └── Models/                # Model Eloquent (Destination, CustomRequest, UMKM, dll.)
├── database/
│   ├── migrations/            # Skema basis data
│   └── seeders/               # Data dummy & akun inisial
├── resources/
│   ├── css/                   # Asset styling (Tailwind CSS)
│   ├── js/                    # Modul script frontend
│   └── views/                 # Blade Templates (Halaman publik & admin)
├── routes/
│   └── web.php                # Rute aplikasi (Publik & Panel Admin)
└── tests/                     # Automated Test Suites (Unit & Feature)
```

---

## 🧪 Pengujian (*Testing*) & Kode Kualitas

Jalankan automated test suite untuk memastikan seluruh fitur berjalan dengan baik:
```bash
# Menjalankan PHPUnit test suite
php artisan test

# Format kode sesuai standar PSR-12 menggunakan Laravel Pint
./vendor/bin/pint
```

---

## 📄 Lisensi

Proyek ini dirilis di bawah naungan lisensi [MIT License](LICENSE).
