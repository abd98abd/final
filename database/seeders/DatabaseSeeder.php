<?php

namespace Database\Seeders;

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

       $this->call(BloodSeeder::class);

       $this->call(NationalitiesSeeder::class);

       $this->call(ReligionSeeder::class);

       $this->call(GenderSeeder::class);

       $this->call(SpecializationSeeder::class);

    }


}
