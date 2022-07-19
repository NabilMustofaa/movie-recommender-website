<?php

namespace Database\Seeders;

use App\Http\Controllers\favorite;
use App\Models\favorite as ModelsFavorite;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        User::create([
            'name' => 'nabil',
            'email' => 'nabilmustofa6@gmail.com',
            'password' => bcrypt('nabil'),
        ]);
        ModelsFavorite::factory(100)->create();
    }
}
