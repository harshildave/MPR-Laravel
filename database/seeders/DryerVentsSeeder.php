<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\DryerVent;
use Illuminate\Database\Seeder;

class DryerVentsSeeder extends Seeder
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
                'exit_point' => '0-10 Feet Off the Ground',
                'price' => 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'exit_point' => '10+ Feet Off the Ground',
                'price' => 20,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'exit_point' => 'Rooftop',
                'price' => 30,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DryerVent::insert($data);
    }
}
