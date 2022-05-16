<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ClientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i <=20;$i++)
        {
            DB::table('clients')->insert([
                'name' => 'Client'.Str::random(6),
                'email' => 'client'.Str::random(10).'@gmail.com',
                'company' => 'Company'.Str::random(6),
                'phone' => rand(1000000000,9999999999),
                'address' => Str::random(40),
                'notes' => 'Note: '.Str::random(20),
                'user_id' => rand(20,22),
                'sample_id' => rand(1,8),
            ]);
        }
    }
}
