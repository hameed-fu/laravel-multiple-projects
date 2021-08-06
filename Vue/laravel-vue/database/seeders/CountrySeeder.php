<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countories = [
            [
                'name'  => 'Pakistan',
            ],
            [
                'name'  => 'India',
            ],
            [
                'name'  => 'Iran',
            ],
            [
                'name'  => 'Chiana',
            ],
        ];

        foreach ($countories as $countory ) {
            \DB::table("countries")->insert($countory);
        }
    }
}
