<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Page;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $page = new Page();

        DB::table('pages')->insert([
            'visible'   => 1,
            'sort'      => $page->getMaxSort() + 1,
            'template'  => 'index',
            'is_main'   => 1,
            'slug'      => '',
        ]);
    }
}
