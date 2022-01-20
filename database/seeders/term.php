<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class term extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Schema::disableForeignKeyConstraints();
        App\Models\term::truncate();
        DB::table('gender')->insert(
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
        Schema::enableForeignKeyConstraints();
    }
}
