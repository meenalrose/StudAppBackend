<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Schema::disableForeignKeyConstraints();
        // App\Models\Gender::truncate();
        \DB::table('gender')->insert(
            [
                ["gender" => "Male"],
                ["gender" => "Female"],
            ]
        );
        // Schema::enableForeignKeyConstraints();
    }
}
