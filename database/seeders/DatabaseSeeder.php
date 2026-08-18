<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@tokokita.test'],
            [
                'name' => 'Admin TokoKita',
                'password' => Hash::make('admin123'),
                'is_admin' => true,
            ]
        );

        User::firstOrCreate(
            ['email' => 'user@tokokita.test'],
            [
                'name' => 'User TokoKita',
                'password' => Hash::make('password'),
                'is_admin' => false,
            ]
        );

        $products = [
            ['T-Shirt Polos Premium', 'Kaos katun combed 24s dengan bahan adem dan nyaman dipakai sehari-hari. Tersedia ukuran S hingga XL.', 89000, 50],
            ['Sneakers Urban White', 'Sepatu sneakers putih dengan sol empuk, cocok untuk gaya harian maupun jalan-jalan.', 349000, 25],
            ['Headphone Wireless Pro', 'Headphone bluetooth dengan noise cancelling, baterai tahan 40 jam, dan kualitas suara jernih.', 799000, 15],
            ['Smartwatch Fitness S2', 'Jam tangan pintar dengan monitor detak jantung, pelacak langkah, dan notifikasi panggilan.', 549000, 30],
            ['Tas Ransel Anti Air', 'Ransel 25L dengan bahan anti air, kompartemen laptop 15 inci, dan desain ergonomis.', 275000, 40],
            ['Lampu Meja LED Minimalis', 'Lampu meja dengan 3 mode cahaya dan pencahayaan eye-care untuk belajar dan bekerja.', 159000, 60],
            ['Botol Minum Stainless 750ml', 'Botol minum stainless steel double-wall yang menjaga minuman tetap dingin 12 jam.', 125000, 80],
            ['Mouse Wireless Silent', 'Mouse nirkabel dengan klik senyap, sensor presisi 1600 DPI, dan baterai tahan lama.', 99000, 100],
            ['Keyboard Mechanical RGB', 'Keyboard mechanical switch merah dengan pencahayaan RGB dan keycaps double-shot.', 429000, 20],
            ['Powerbank 20000mAh', 'Powerbank kapasitas besar dengan fast charging 22.5W dan dual output USB-C.', 289000, 45],
            ['Kemeja Flanel Kasual', 'Kemeja flanel berbahan lembut dengan motif kotak klasik, cocok untuk gaya santai.', 179000, 35],
            ['Kabel Data USB-C Nylon', 'Kabel data fast charging 60W dengan anyaman nylon yang awet dan tidak mudah kusut.', 45000, 150],
        ];

        foreach ($products as [$name, $description, $price, $stock]) {
            Product::create([
                'name' => $name,
                'slug' => Str::slug($name) . '-' . Str::lower(Str::random(5)),
                'description' => $description,
                'price' => $price,
                'stock' => $stock,
                'image' => 'https://picsum.photos/seed/' . Str::slug($name) . '/600/400',
                'is_active' => true,
            ]);
        }
    }
}