<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EquipmentsSeeder extends Seeder
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
            DB::table('equipments')->insert([
                'point_id' => rand(1000000,9999999),
                'name' => 'Equipmet'.Str::random(4),
                'fluid_in_use' => 'use'.Str::random(10),
                'unit_name' => 'unit'.Str::random(8),
                'type_of_equipment' => 'type'.Str::random(4),
                'client_id' => rand(3,9),
            ]);
        }
    }
}
