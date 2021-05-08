<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
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
        $this->call(LaratrustSeeder::class);
        $this->call(JurusanSeeder::class);
        $user = User::create([
            'name' => 'Administrator',
            'email' => 'admin@app.com',
            'password' => Hash::make('password'),
        ]);
        $user->attachRole('administrator');
    }
}
