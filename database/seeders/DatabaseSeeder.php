<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'is_admin'=> 1,
            'name' => 'Admin',
            'username' => 'admin',
            'password' => Hash::make('newpass@123'),
            'email'=> 'imjoloffial@gmail.com',
            'email_verified_at'=> now(),
            'avatar'=> avatar('admin')

        ]);
        $this->call([
            FeatureSeeder::class,
            SettingSeeder::class
        ]);
    }
}
