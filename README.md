Aplikasi Laundry (Laravel)

Aplikasi web sederhana untuk manajemen laundry: customer, transaksi, laporan, dan multi-user.

Teknologi

Laravel 10.x, PHP ≥ 8.1

MySQL / MariaDB

Frontend: Bootstrap 5 / AdminLTE

Node.js & NPM (untuk assets)

Instalasi singkat
git clone https://github.com/denisyarif1997/apliaksi-laundry-dengan-laravel.git
cd apliaksi-laundry-dengan-laravel
composer install
npm install
cp .env.example .env
# edit .env -> DB_*
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
npm run dev        # atau npm run build untuk production
php artisan serve


Akses: http://localhost:8000

Default akun

Admin — admin@laundry.com
 / password

Kasir — kasir@laundry.com
 / password

Ganti password setelah login pertama.

Fitur utama

Manajemen Customer

Transaksi laundry (create / bayar / status)

Dashboard & laporan

Hak akses (Admin / Kasir)

Responsive (Bootstrap / AdminLTE)

Struktur singkat project
app/       // controllers, models
resources/ // views (Blade)
routes/    // web.php
database/  // migrations & seeders
public/    // assets

Troubleshoot cepat

Specified key was too long → tambahkan Schema::defaultStringLength(191); di AppServiceProvider::boot.

Permission → chmod -R 775 storage bootstrap/cache

Composer autoload → composer dump-autoload && php artisan config:clear && php artisan cache:clear

Lisensi & kontribusi

MIT — kontribusi welcome (fork → branch → PR).

Kontak: denisyarif196@gmail.com

Repo: https://github.com/denisyarif1997/apliaksi-laundry-dengan-laravel
