<?php

namespace Database\Seeders;

use App\Models\Package;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Admin (Pengelola Utama Laundry)
        User::create([
            'name'     => 'Administrator Laundry',
            'email'    => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        // 2. Akun Kasir (Operator Kasir Laundry)
        User::create([
            'name'     => 'Kasir Laundry',
            'email'    => 'kasir@gmail.com',
            'password' => Hash::make('password'),
            'role'     => 'kasir',
        ]);

        // 3. Akun Pelanggan (Pengguna Umum)
        User::create([
            'name'     => 'Budi Santoso',
            'email'    => 'user@gmail.com',
            'password' => Hash::make('password'),
            'role'     => 'pengguna',
        ]);

        // 4. Data Master Layanan Sesuai Soal Ujian (PDF)
        Package::create([
            'name'        => 'Reguler',
            'price'       => 7000,
            'stock'       => 100, // Kapasitas 100 Kg/hari
            'description' => 'Pencucian pakaian harian bersih wangi, dikeringkan, dan disetrika rapi standar.',
            'estimate'    => '3-4 Hari',
        ]);

        Package::create([
            'name'        => 'Ekspres',
            'price'       => 12000,
            'stock'       => 50, // Kuota 50 Kg/hari
            'description' => 'Layanan cepat prioritas, pakaian wangi tahan lama, disetrika uap rapi.',
            'estimate'    => '1-2 Hari',
        ]);

        Package::create([
            'name'        => 'Superkilat',
            'price'       => 25000,
            'stock'       => 25, // Kuota kilat 25 Kg/hari
            'description' => 'Layanan super ekspres khusus kebutuhan mendesak, langsung dicuci dan kering kilat dalam hitungan jam.',
            'estimate'    => '5 Jam Selesai',
        ]);
    }
}
