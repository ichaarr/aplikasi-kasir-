<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
{
    // Tambah Admin
    User::create([
        'name' => 'Admin',
        'email' => 'admin@example.com',
        'password' => Hash::make('password'),
        'role' => 'admin',
    ]);

    // Tambah Kasir
    User::create([
        'name' => 'Kasir',
        'email' => 'kasir@example.com',
        'password' => Hash::make('password'),
        'role' => 'kasir',
    ]);
}
}
