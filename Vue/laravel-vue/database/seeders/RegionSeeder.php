<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $regions = [
            [
                'countory_id'  => '13',
                'name'  => 'KPK',
            ],
            [
                'countory_id'  => '13',
                'name'  => 'Punjab',
            ],
            [
                'countory_id'  => '13',
                'name'  => 'Sindh',
            ],
        ];

        foreach ($regions as $region ) {
            \DB::table("regions")->insert($region);
        }
    }
}
