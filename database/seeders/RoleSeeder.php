<?php

namespace Database\Seeders;

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
        $data = [
            ['role_name' => 'admin'],
            ['role_name' => 'kasir'],
            ['role_name' => 'staff-dapur'],
            ['role_name' => 'buyer'],
        ];
        
        DB::table('roles')->insert($data);
    }
}