<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Schema::disableForeignKeyConstraints();
        // App\Models\Term::truncate();
        \DB::table('term')->insert(
            [
                // 1
                [
                    'term' => 'One',
                ],
                //  2
                [
                    'term' => 'Two',
                ]
            ]
        );
        // Schema::enableForeignKeyConstraints();
    }
}
