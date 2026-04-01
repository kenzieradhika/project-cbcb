# TokoKita - E-Commerce Laravel 11

Aplikasi toko online sederhana berbasis Laravel 11 dengan SQLite. Fitur: katalog produk, keranjang belanja, checkout, riwayat pesanan, dan panel admin.

## Fitur

- Katalog produk dengan gambar, harga, dan stok
- Keranjang belanja berbasis session
- Checkout dengan pengurangan stok otomatis (transaksi database)
- Riwayat pesanan untuk pelanggan
- Panel admin: dashboard statistik, CRUD produk, manajemen status pesanan
- Autentikasi (register / login / logout)

## Persyaratan

- PHP >= 8.2
- Composer

## Instalasi

```bash
composer install
cp .env.example .env
touch database/database.sqlite
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
php artisan serve
```

Akses aplikasi di `http://127.0.0.1:8000`.

## Pengujian

Suite berjalan di atas SQLite in-memory (`phpunit.xml`), jadi tidak perlu
menyiapkan database terpisah dan perintahnya aman dijalankan di klon bersih.

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan test
```

Perintah `composer install` dan `php artisan key:generate` tetap diperlukan
karena Laravel mem-bootstrap aplikasi sebelum test dijalankan.

Format kode memakai [Laravel Pint](https://laravel.com/docs/pint); CI menolak
pull request yang belum diformat:

```bash
./vendor/bin/pint          # rapikan
./vendor/bin/pint --test   # cek saja, dipakai CI
```

## Akun Demo (dari seeder)

| Role    | Email                | Password  |
|---------|----------------------|-----------|
| Admin   | admin@tokokita.test  | admin123  |
| User    | user@tokokita.test   | password  |

## Struktur

```
app/Http/Controllers/    Auth, Home, Product, Cart, Checkout, Order, Admin/*
app/Models/              Product, Order, OrderItem, User
database/migrations/     users, products, orders, order_items
database/seeders/        DatabaseSeeder (admin, user, 12 produk)
resources/views/         Layout, home, produk, cart, checkout, orders, admin
routes/web.php           Semua route (guest, auth, admin)
```