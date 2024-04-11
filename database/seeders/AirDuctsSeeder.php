<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\AirDuct;
use Illuminate\Database\Seeder;

class AirDuctsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'no_of_furnace' => '1',
                'square_footage_min' => 0,
                'square_footage_max' => 2000,
                'price_side_by_side' => 0,
                'price_different_location' => 0,
                'price_no_location' => 120,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'no_of_furnace' => '1',
                'square_footage_min' => 2001,
                'square_footage_max' => 3200,
                'price_side_by_side' => 0,
                'price_different_location' => 0,
                'price_no_location' => 130,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'no_of_furnace' => '1',
                'square_footage_min' => 3201,
                'square_footage_max' => 4999,
                'price_side_by_side' => 0,
                'price_different_location' => 0,
                'price_no_location' => 150,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'no_of_furnace' => '2',
                'square_footage_min' => 0,
                'square_footage_max' => 2000,
                'price_side_by_side' => 210,
                'price_different_location' => 220,
                'price_no_location' => 200,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'no_of_furnace' => '2',
                'square_footage_min' => 2001,
                'square_footage_max' => 4999,
                'price_side_by_side' => 260,
                'price_different_location' => 270,
                'price_no_location' => 250,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'no_of_furnace' => '3+',
                'square_footage_min' => 0,
                'square_footage_max' => 10000,
                'price_side_by_side' => 0,
                'price_different_location' => 0,
                'price_no_location' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        AirDuct::insert($data);
    }
}
