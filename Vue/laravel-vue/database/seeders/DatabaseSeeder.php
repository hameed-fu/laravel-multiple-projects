<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\RegionSeeder;
use Database\Seeders\CountrySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(CountrySeeder::class);
        $this->call(RegionSeeder::class);

    }
}
