<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'created_at' => now(),
            'name'       => 'admin',
            'role_id'    => 1,
            'email'      => 'admin@mail.ru',
            'email_verified_at' => now(),
            'password'   => Hash::make('admin123')
        ]);
    }
}
