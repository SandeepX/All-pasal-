<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CEO;
use Faker\Generator as Faker;

class CEOSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\CEO::factory()->count(30)->create();

    }
}
