<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SamplesSeeder extends Seeder
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
            DB::table('samples')->insert([
                'name' => Str::random(10),
                'description' => Str::random(40),
                'barcode' => rand(10000000,999999999),
            ]);
        }
    }
}
