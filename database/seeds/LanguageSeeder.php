<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('languages')->insert([
            'created_at' => now(),
            'country'    => 'USA',
            'lang'       => 'en',
        ]);
    }
}
