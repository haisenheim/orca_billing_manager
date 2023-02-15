<?php

use App\Models\Client;
use Database\Seeders\ClientTableSeeder;
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
        // $this->call(UserSeeder::class);
       // $this->call(ClientTableSeeder::class);
       Client::factory()->count(5)->create();
    }
}
