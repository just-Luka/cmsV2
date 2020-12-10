<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'created_at'    => now(),
            'status'        => 'Administrator',
            'permissions'   => '{
                "media": {
                    "files": true,
                    "images": true
                },
                "menus": {
                    "edit": true,
                    "type": true,
                    "index": true,
                    "store": true,
                    "create": true,
                    "inside": true,
                    "update": true,
                    "destroy": true,
                    "visible": true
                },
                "pages": {
                    "edit": true,
                    "show": true,
                    "type": true,
                    "index": true,
                    "store": true,
                    "create": true,
                    "inside": true,
                    "update": true,
                    "destroy": true,
                    "visible": true
                },
                "roles": {
                    "edit": true,
                    "show": true,
                    "index": true,
                    "store": true,
                    "create": true,
                    "update": true,
                    "destroy": true
                },
                "users": {
                    "edit": true,
                    "show": true,
                    "index": true,
                    "store": true,
                    "create": true,
                    "update": true,
                    "destroy": true
                },
                "banners": {
                    "edit": true,
                    "index": true,
                    "store": true,
                    "trans": true,
                    "create": true,
                    "update": true,
                    "destroy": true,
                    "visible": true
                },
                "switcher": {
                    "index": true
                },
                "dashboard": {
                    "index": true
                },
                "translation": {
                    "edit": true,
                    "index": true,
                    "store": true,
                    "create": true,
                    "update": true,
                    "destroy": true
                }
            }'
        ]);
    }
}
