<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        if (!User::where('email', 'librarian@brs.com')->exists()) {
            User::create([
                'name' => 'Librarian User',
                'email' => 'librarian@brs.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'is_librarian' => true
            ]);
        }

        if (!User::where('email', 'reader@brs.com')->exists()) {
            User::create([
                'name' => 'Reader User',
                'email' => 'reader@brs.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'is_librarian' => false
            ]);
        }
    }
}
