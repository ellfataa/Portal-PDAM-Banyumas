![logo-pdam](https://github.com/user-attachments/assets/b5a88844-dde6-44e9-a491-5e66be9bb942)

# Sistem Pembayaran Pelanggan PDAM Banyumas

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![Midtrans](https://img.shields.io/badge/Midtrans-00A9F4?style=for-the-badge&logo=midtrans&logoColor=white)

> Sebuah aplikasi web inovatif yang dikembangkan sebagai proyek Kerja Praktik (KP) di PDAM Banyumas.

## Tentang Proyek

Proyek ini adalah sebuah sistem pembayaran pelanggan yang dibangun dengan menggunakan **Laravel 12**, dirancang untuk efisiensi dan kemudahan penggunaan. Sistem ini mengintegrasikan layanan pembayaran pihak ketiga, **Midtrans**, untuk memfasilitasi transaksi pembayaran secara online yang aman dan real-time.

**Fitur Utama:**
* **Pendaftaran Pelanggan Online:** Memungkinkan calon pelanggan untuk mendaftar layanan PDAM secara mandiri melalui aplikasi web.
* **Pembayaran Tagihan Online:** Memfasilitasi pembayaran tagihan PDAM menggunakan berbagai metode pembayaran yang didukung oleh Midtrans (Virtual Account, E-Wallet, Kartu Kredit, dll.).

## Teknologi yang Digunakan

* **Framework:** Laravel 12 (PHP)
* **Database:** MySQL
* **Frontend:** Blade Templates, Tailwind CSS
* **Payment Gateway:** Midtrans Snap (Integrated with Webhook)
* **Development Tools:** Composer, npm, Git, Ngrok (untuk testing webhook lokal)

## Instalasi dan Konfigurasi

Untuk menjalankan proyek ini di lingkungan lokal Anda, ikuti langkah-langkah berikut:

### 1. Klon Repositori
```bash
git clone <URL_REPO_ANDA>
cd nama-folder-proyek-anda
```

### 2. Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 3. Konfigurasi Environment
```bash
# Salin file environment
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Konfigurasi Database
Edit file `.env` dan sesuaikan konfigurasi database Anda:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pdam_db
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. Konfigurasi Midtrans
Tambahkan konfigurasi Midtrans di file `.env`:
```env
MIDTRANS_SERVER_KEY=your_midtrans_server_key
MIDTRANS_CLIENT_KEY=your_midtrans_client_key
MIDTRANS_IS_PRODUCTION=false
```

### 6. Migrasi Database
```bash
# Jalankan migrasi database
php artisan migrate

# Jalankan seeder (opsional)
php artisan db:seed
```

### 7. Build Assets
```bash
# Compile assets untuk development
npm run dev

# Atau untuk production
npm run build
```

### 8. Konfigurasi Storage Link
```bash
php artisan storage:link
```

### 9. Menjalankan Aplikasi
```bash
# Jalankan server development
php artisan serve

# Aplikasi akan tersedia di http://localhost:8000
```

## Konfigurasi Webhook Midtrans

Untuk testing di lingkungan lokal, gunakan Ngrok untuk expose aplikasi Anda:

### 1. Install dan Jalankan Ngrok
```bash
# Install Ngrok (jika belum ada)
# Download dari https://ngrok.com/

# Jalankan Ngrok
ngrok http 8000
```

### 2. Konfigurasi Webhook URL
* Masuk ke dashboard Midtrans
* Pergi ke Settings > Configuration
* Set Notification URL dengan URL Ngrok Anda: `https://your-ngrok-url.ngrok-free.app/callback/midtrans`

## Kontribusi

Proyek ini dikembangkan sebagai bagian dari program Kerja Praktik. Untuk kontribusi lebih lanjut:

1. Fork repositori ini
2. Buat branch feature (`git checkout -b feature/amazing-feature`)
3. Commit perubahan (`git commit -m 'Add some amazing feature'`)
4. Push ke branch (`git push origin feature/amazing-feature`)
5. Buat Pull Request

## Lisensi

Proyek ini dikembangkan untuk keperluan akademik dan internal PDAM Banyumas. Tidak untuk penggunaan komersial tanpa izin.

## Kontak

**Developer:** Luthfi Emillulfata | **Email:** luthfi.efata@gmail.com  
**Institution:** Perumdam Tirta Satria (PDAM) Banyumas  
**Program:** Kerja Praktik - Universitas Jenderal Soedirman - Program Studi Informatika
