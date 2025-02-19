## Jangan lupa sawer orang baik :)

![QRIS Support](public/assets/css/style.jpeg)


# Sistem Manajemen Uang Kas
## Laravel 11 Project

Ini adalah proyek berbasis Laravel 11 yang berfungsi untuk mengelola uang kas secara efisien. Fitur utama meliputi:
- Pengelolaan member
- Sistem pembayaran pekanan
- Pengiriman notifikasi via WhatsApp
- Dan fitur lainnya yang akan dikembangkan

## Persyaratan Sistem
Sebelum memulai instalasi, pastikan sistem Anda telah memiliki:
- **PHP** >= 8.1
- **Composer**
- **MySQL** (untuk database)
- **Node.js & NPM** (untuk aset frontend)

## Instalasi

### 1. Clone Repository
```bash
git clone https://github.com/EBRENTINAMBUNAN/kaskita.git
cd kaskita
```

### 2. Install Dependensi Composer
Jalankan perintah berikut untuk mengunduh semua dependensi Laravel:
```bash
composer install
```

### 3. Copy File Environment
Salin file `.env.example` menjadi `.env` untuk konfigurasi environment:
```bash
cp .env.example .env
```

### 4. Generate Application Key
Laravel membutuhkan application key yang unik. Anda dapat menghasilkannya dengan perintah berikut:
```bash
php artisan key:generate
```

### 5. Atur Konfigurasi Database
Edit file `.env` dan sesuaikan dengan konfigurasi database Anda:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=user_database
DB_PASSWORD=password_database
```

### 6. Migrasi dan Seed Database
Jalankan migrasi database untuk membuat tabel dan masukkan data awal:
```bash
php artisan migrate --seed
```

### 7. Install Dependensi NPM
Untuk mengelola aset frontend, jalankan perintah berikut:
```bash
npm install
npm run build
```

### 8. Jalankan Server
Setelah semua langkah di atas selesai, jalankan server lokal dengan perintah berikut:
```bash
php artisan serve
```
Aplikasi akan berjalan di `http://localhost:8000` secara default.

## Cara Menggunakan

### Fitur Utama
1. **Pengelolaan Member**
   - Akses halaman pengelolaan member melalui `/admin/members`
   - Tambah, edit, atau hapus data member sesuai kebutuhan

2. **Sistem Pembayaran Pekanan**
   - Member dapat melakukan pembayaran pekanan sesuai jadwal yang ditentukan
   - Admin dapat memproses atau menolak pembayaran melalui dashboard admin

3. **Notifikasi WhatsApp**
   - Sistem akan mengirimkan notifikasi otomatis ke nomor WhatsApp member saat status pembayaran diperbarui

## Pengujian
Jalankan pengujian unit atau fitur aplikasi dengan perintah:
```bash
php artisan test
```

## Deployment

### 1. Compile Assets untuk Produksi
```bash
npm run build
```

### 2. Set Permission untuk Direktori Storage
Pastikan direktori `storage` dan `bootstrap/cache` memiliki izin yang benar:
```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### 3. Konfigurasi di Server
- Pastikan server (Apache/Nginx) diarahkan ke folder `public`
- Jalankan perintah migrasi di server produksi:
```bash
php artisan migrate --force
```

## Kontribusi
Jika Anda ingin berkontribusi pada proyek ini, silakan fork repository ini dan buat pull request dengan perubahan yang Anda usulkan.

---
**Dibuat dengan ❤️ menggunakan Laravel 11.**

