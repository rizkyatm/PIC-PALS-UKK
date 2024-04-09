<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'username' => 'admin',
            'nama_lengkap' => 'Admin',
            'role' => 'admin',
            'password' => Hash::make('123'),
            'email' => 'admin@gmail.com',
            'alamat' => 'Alamat Admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'username' => 'user1',
            'nama_lengkap' => 'User Satu',
            'role' => 'user',
            'password' => Hash::make('123'),
            'email' => 'user1@gmail.com',
            'alamat' => 'Alamat User Satu',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
