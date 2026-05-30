<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\AdminSeeder;
use Database\Seeders\DigitalProductSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            DigitalProductSeeder::class,
            DigitalServiceSeeder::class,
            SiteContentSeeder::class,
            CountryStatsSeeder::class
        ]);
    }
}
