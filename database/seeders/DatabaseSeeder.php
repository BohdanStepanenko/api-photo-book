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
        $this->call(UsersSeeder::class);
        $this->call(CoversSeeder::class);
        $this->call(BooksSeeder::class);
        $this->call(RolesAndPermissionsSeeder::class);
    }
}
