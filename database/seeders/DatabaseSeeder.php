<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Call other seeders here
        $this->call([
            UsersTableSeeder::class,
            // You can add other seeders here as needed
        ]);
    }
}
