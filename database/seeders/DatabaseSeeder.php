<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        DB::table('users')->insert([
            [
                'nama' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123456'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'budi',
                'email' => 'budi@gmail.com',
                'password' => Hash::make('123456'),
                'role' => 'anggota',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('penulis')->insert([
            [
                'nama' => 'Tere Liye',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Andrea Hirata',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('kategoris')->insert([
            [
                'nama' => 'Fiksi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Pendidikan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('bukus')->insert([
            [
                'judul' => 'Bumi',
                'penulis_id' => 1,
                'kategori_id' => 1,
                'penerbit' => 'Gramedia',
                'tahun_terbit' => 2014,
                'isbn' => '1234567890',
                'edisi' => '1',
                'jumlah_halaman' => 300,
                'ukuran' => '14x20 cm',
                'stok' => 10,
                'deskripsi' => 'Novel populer karya Tere Liye',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Laskar Pelangi',
                'penulis_id' => 2,
                'kategori_id' => 2,
                'penerbit' => 'Bentang',
                'tahun_terbit' => 2005,
                'isbn' => '0987654321',
                'edisi' => '1',
                'jumlah_halaman' => 250,
                'ukuran' => '13x19 cm',
                'stok' => 5,
                'deskripsi' => 'Novel inspiratif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}