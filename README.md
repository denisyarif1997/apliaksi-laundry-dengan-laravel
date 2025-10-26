# 🧺 Aplikasi Laundry dengan Laravel

Aplikasi manajemen laundry berbasis web menggunakan Laravel untuk mengelola data customer, transaksi, dan operasional laundry.

## ✨ Fitur Utama

- 📋 Manajemen Customer
- 💰 Transaksi Laundry
- 📊 Dashboard & Laporan
- 👥 Multi-user Management
- 🔐 Autentikasi & Autorisasi
- 📱 Responsive Design

## 🛠️ Teknologi

- **Framework:** Laravel 10.x
- **Database:** MySQL
- **Frontend:** Bootstrap 5 / AdminLTE
- **PHP Version:** 8.1+

## 📋 Persyaratan Sistem

Pastikan sistem Anda memiliki:

- PHP >= 8.1
- Composer
- MySQL >= 5.7 atau MariaDB
- Node.js & NPM (untuk asset compilation)
- Web Server (Apache/Nginx)

## 🚀 Cara Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/denisyarif1997/apliaksi-laundry-dengan-laravel.git
cd apliaksi-laundry-dengan-laravel
```

### 2. Install Dependencies

```bash
composer install
npm install
```

### 3. Setup Environment

```bash
cp .env.example .env
```

Edit file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laundry_db
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

> **📧 Untuk Akses Database:**  
> Silahkan hubungi: **denisyarif196@gmail.com**

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Jalankan Migration & Seeder

```bash
php artisan migrate
php artisan db:seed
```

### 6. Compile Assets

```bash
npm run dev
```

Atau untuk production:

```bash
npm run build
```

### 7. Create Storage Link

```bash
php artisan storage:link
```

### 8. Jalankan Aplikasi

```bash
php artisan serve
```

Aplikasi akan berjalan di: `http://localhost:8000`

## 🔑 Default Login

Setelah seeder dijalankan, gunakan kredensial berikut:

**Admin:**
- Email: `admin@laundry.com`
- Password: `password`

**Kasir:**
- Email: `kasir@laundry.com`
- Password: `password`

> ⚠️ **Penting:** Segera ubah password default setelah login pertama!

## 📁 Struktur Project

```
├── app/
│   ├── Http/Controllers/
│   ├── Models/
│   └── ...
├── database/
│   ├── migrations/
│   └── seeders/
├── public/
├── resources/
│   ├── views/
│   └── ...
├── routes/
│   └── web.php
└── ...
```

## 🔧 Konfigurasi Tambahan

### Queue Worker (Opsional)

Jika menggunakan queue untuk email/notifikasi:

```bash
php artisan queue:work
```

### Scheduler (Opsional)

Tambahkan ke crontab untuk scheduled tasks:

```bash
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

## 📝 Penggunaan

### Modul Customer

1. Login ke aplikasi
2. Navigate ke menu **Customer**
3. Klik tombol **New** untuk menambah customer baru
4. Isi form dengan data customer
5. Klik **Save**

### Fitur Pagination

- Data customer ditampilkan 20 per halaman
- Gunakan tombol navigasi untuk berpindah halaman
- Fitur search tersedia untuk mencari data spesifik

## 🐛 Troubleshooting

### Error: "Specified key was too long"

Tambahkan di `AppServiceProvider.php`:

```php
use Illuminate\Support\Facades\Schema;

public function boot()
{
    Schema::defaultStringLength(191);
}
```

### Error: Permission Denied

```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### Error: Class not found

```bash
composer dump-autoload
php artisan clear-compiled
php artisan config:clear
php artisan cache:clear
```

## 🤝 Kontribusi

Kontribusi selalu welcome! Silakan:

1. Fork repository ini
2. Buat branch baru (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

## 📞 Kontak

**Developer:** Denis Yarif  
**Email:** denisyarif196@gmail.com  
**Repository:** [https://github.com/denisyarif1997/apliaksi-laundry-dengan-laravel](https://github.com/denisyarif1997/apliaksi-laundry-dengan-laravel)

## 📄 Lisensi

Project ini menggunakan lisensi MIT. Lihat file `LICENSE` untuk detail.

## 🙏 Acknowledgments

- Laravel Framework
- AdminLTE Template
- Bootstrap
- Komunitas Open Source

---

⭐ Jika project ini bermanfaat, jangan lupa berikan **star** di GitHub!
