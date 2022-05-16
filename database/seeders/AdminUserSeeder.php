<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'SuperAdmin',
            'email' => 'super.admin@mrt.com',
            'role' => '1',
            'password' => \Hash::make('super@admin'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
