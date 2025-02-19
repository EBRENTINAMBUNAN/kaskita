
```markdown
# Sistem Manajemen Uang Kas
# Laravel 11 Project

Ini adalah proyek berbasis Laravel 11. Di dalam proyek ini, terdapat berbagai fitur seperti pengelolaan member, sistem pembayaran pekanan, pengiriman notifikasi via WhatsApp, dan lain-lain.

## Persyaratan Sistem

Sebelum memulai instalasi, pastikan Anda telah menginstal dan mengonfigurasi hal-hal berikut di sistem Anda:

- **PHP** >= 8.1
- **Composer**
- **MySQL** atau **PostgreSQL** (untuk database)
- **Node.js** & **NPM** (untuk asset frontend)

## Langkah Instalasi

1. **Clone Repository**
   ```bash
   git clone https://github.com/EBRENTINAMBUNAN/kaskita.git
   ```

   ```bash
   cd repository
   ```

2. **Install Dependensi Composer**
   Jalankan perintah berikut untuk mengunduh semua dependensi yang diperlukan oleh Laravel:
   ```bash
   composer install
   ```

3. **Copy File Environment**
   Salin file `.env.example` menjadi `.env` untuk konfigurasi environment.
   ```bash
   cp .env.example .env
   ```

4. **Generate Application Key**
   Laravel membutuhkan application key yang unik. Anda dapat menghasilkannya dengan perintah berikut:
   ```bash
   php artisan key:generate
   ```

5. **Atur Konfigurasi Database**
   Buka file `.env` dan sesuaikan konfigurasi database Anda:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nama_database
   DB_USERNAME=user_database
   DB_PASSWORD=password_database
   ```

6. **Migrasi dan Seed Database**
   Jalankan migrasi database untuk membuat tabel, dan gunakan seeder untuk memasukkan data awal:
   ```bash
   php artisan migrate --seed
   ```

7. **Install Dependensi NPM**
   Untuk mengelola aset frontend, jalankan perintah berikut:
   ```bash
   npm install
   npm run build
   ```

8. **Jalankan Server**
   Setelah semua langkah di atas selesai, Anda dapat menjalankan server lokal menggunakan perintah berikut:
   ```bash
   php artisan serve
   ```

   Secara default, aplikasi akan berjalan di `http://localhost:8000`.

## Cara Menggunakan

### Fitur Utama
1. **Pengelolaan Member**
   - Akses halaman pengelolaan member melalui `/admin/members`.
   - Tambah, edit, atau hapus data member sesuai kebutuhan.

2. **Sistem Pembayaran Pekanan**
   - Member dapat melakukan pembayaran pekanan sesuai dengan pekan yang ditentukan.
   - Admin dapat memproses atau menolak pembayaran melalui dashboard admin.

3. **Notifikasi WhatsApp**
   - Aplikasi ini dilengkapi fitur pengiriman notifikasi otomatis ke nomor WhatsApp member ketika status pembayaran diperbarui.

## Pengujian

Untuk menjalankan pengujian unit atau fitur pada aplikasi, gunakan perintah berikut:
```bash
php artisan test
```

## Deployment

1. **Compile Assets untuk Produksi**:
   ```bash
   npm run build
   ```

2. **Set Permission untuk Direktori Storage**:
   Pastikan direktori `storage` dan `bootstrap/cache` memiliki izin yang benar:
   ```bash
   chmod -R 775 storage
   chmod -R 775 bootstrap/cache
   ```

3. **Konfigurasi di Server**
   - Pastikan konfigurasi server (Apache/Nginx) diarahkan ke folder `public`.
   - Jalankan perintah migrasi di server produksi:
     ```bash
     php artisan migrate --force
     ```

## Kontribusi

Jika Anda ingin berkontribusi pada proyek ini, silakan fork repository ini dan buat pull request dengan perubahan yang Anda usulkan.

---

**Dibuat dengan ❤️ menggunakan Laravel 11.**
```