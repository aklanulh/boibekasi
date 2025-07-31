<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user with specific credentials
        User::create([
            'name' => 'Admin BOI Bekasi',
            'email' => 'admin@boibekasi.com',
            'password' => bcrypt('boibekasi123'), // Password: boibekasi123
            'email_verified_at' => now(),
        ]);

        // Call all seeders
        $this->call([
            MemberSeeder::class,
            MerchandiseSeeder::class,
            EventSeeder::class,
            DocumentationSeeder::class,
        ]);
    }
}
