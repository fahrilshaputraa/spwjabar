<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Level;
use App\Models\Wirausaha;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'kode_user' => 'admin',
            'level_id' => 1,
        ]);
        User::create([
            'name' => 'Disdik',
            'username' => 'disdik',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'kode_user' => 'disdik',
            'level_id' => 2,
        ]);
        User::create([
            'name' => 'KCD I',
            'username' => 'kcdi',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'kode_user' => '1001',
            'level_id' => 3,
        ]);
        User::create([
            'name' => 'KCD II',
            'username' => 'kcdii',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'kode_user' => '1002',
            'level_id' => 3,
        ]);
        User::create([
            'name' => 'KCD XIII',
            'username' => 'kcdxiii',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'kode_user' => '1013',
            'level_id' => 3,
        ]);
        User::create([
            'name' => 'SPW SMKN 1 Kawali',
            'username' => 'smkn1kawali',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'kode_user' => '20233694',
            'level_id' => 4,
        ]);
        User::create([
            'name' => 'SPW SMKN 1 Ciamis',
            'username' => 'smkn1ciamis',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'kode_user' => '20211510',
            'level_id' => 4,
        ]);

        Level::create([
            'level' => 'superadmin'
        ]);
        Level::create([
            'level' => 'disdik'
        ]);
        Level::create([
            'level' => 'kcd'
        ]);
        Level::create([
            'level' => 'sekolah'
        ]);
    }
}
