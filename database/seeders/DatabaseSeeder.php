<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        //Admin Account
        User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@mail.com',
            'password' => Hash::make('admin'),
        ]);

        $this->call([
            ProgramSeeder::class,
            StudentSeeder::class,
        ]);
    }
}
