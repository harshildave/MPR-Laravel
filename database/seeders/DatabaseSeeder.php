<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\AirDuctsSeeder;
use Database\Seeders\DryerVentsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Call the AirDuctsSeeder
        $this->call(AirDuctsSeeder::class);

        // Call the DryerVentsSeeder
        $this->call(DryerVentsSeeder::class);
    }
}
