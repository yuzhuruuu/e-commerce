# E-Commerce (PHP + MySQL)

Proyek toko online sederhana berbasis PHP dan MySQL. Template front-end memakai file statis di folder `css`, `js`, `images`, dan fungsi CRUD sederhana berada di dalam folder `src/`.

## Fitur
- Halaman depan: `index.php`
- Manajemen produk (tambah/edit/hapus/list) di `src/produk/`
- Manajemen pelanggan di `src/pelanggan/`
- Manajemen penjual/toko di `src/penjual/`
- Detail pesanan di `src/detail_pesanan/`

## Persyaratan
- PHP (disarankan PHP 7.4+)
- MySQL / MariaDB
- Web server (Apache, Nginx) atau paket seperti XAMPP/WAMP/Laragon

## Instalasi & Setup
1. Salin seluruh folder proyek ke folder web server Anda, mis. `C:\xampp\htdocs\e-commerce`.
2. Buat database dan impor file SQL: buka phpMyAdmin atau CLI, lalu impor file [ecommerce_db.sql](ecommerce_db.sql#L1).
3. Sesuaikan konfigurasi koneksi database di file [koneksi.php](koneksi.php#L1). Ubah `host`, `username`, `password`, dan `database` sesuai lingkungan Anda.
4. Akses aplikasi melalui browser: `http://localhost/e-commerce/` atau `http://localhost/e-commerce/index.php`.

## Struktur Proyek (ringkasan)
- `index.php` — Halaman utama
- `koneksi.php` — Konfigurasi koneksi database
- `ecommerce_db.sql` — Dump database untuk impor
- `css/`, `js/`, `images/`, `fonts/` — Asset front-end
- `src/` — Folder fungsi backend dan halaman CRUD
  - `produk/` — Tambah / edit / hapus / list produk
  - `pelanggan/` — Tambah / edit / hapus / list pelanggan
  - `penjual/` — Tambah / edit / hapus / list penjual
  - `detail_pesanan/` — Halaman pesanan dan detail

## Cara Menggunakan
- Setelah konfigurasi DB, buka `index.php` untuk melihat toko.
- Gunakan halaman di `src/` untuk menambahkan atau mengelola data produk, pelanggan, dan penjual.

## Catatan
- Jika gambar atau asset tidak muncul, periksa path di file HTML/PHP dan pastikan folder `images/`, `css/`, dan `js/` tersedia.
- Backup file `koneksi.php` sebelum mengganti kredensial.
