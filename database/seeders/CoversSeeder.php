<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cover;

class CoversSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cover::factory(3)->create();
    }
}
