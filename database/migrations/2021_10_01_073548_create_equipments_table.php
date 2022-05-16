<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipments', function (Blueprint $table) {
            $table->id();
            $table->string('point_id');
            $table->string('site')->nullable();
            $table->string('area')->nullable();
            $table->string('unit')->nullable();
            $table->string('equipment');
            $table->string('description')->nullable();
            $table->string('fluid_in_use');
            $table->string('fluid_grade')->nullable();
            $table->string('equipment_type')->nullable();
            $table->string('recent_sample')->nullable();
            $table->string('last_sample_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipments');
    }
}
