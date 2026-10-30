<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\Kategori;
use App\Models\Wilayah;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder {
    public function run(): void {
        // 1. Buat Akun Admin Default
        Admin::firstOrCreate(
            ['name' => 'admin'],
            [
                'email' => 'admin@pidie.com',
                'password' => Hash::make('admin123')
            ]
        );

        // 2. Tambah Data Kategori Awal
        $kategoris = [
            'Wisata Pantai',
            'Air Terjun',
            'Wisata Alam',
            'Wisata Religi',
            'Panorama Alam'
        ];

        foreach ($kategoris as $kat) {
            Kategori::firstOrCreate(['nama_kategori' => $kat]);
        }

        // 3. Tambah Data Wilayah Awal di Pidie
        $wilayahs = [
            'Sigli',
            'Tangse',
            'Geuni, Tangse',
            'Kota Sigli',
            'Pidie'
        ];

        foreach ($wilayahs as $wil) {
            Wilayah::firstOrCreate(['nama_wilayah' => $wil]);
        }
    }
}