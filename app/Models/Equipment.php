<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $table = 'equipments';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'point_id',
        'site',
        'area',
        'unit',
        'equipment',
        'description',
        'fluid_in_use',
        'fluid_grade',
        'equipment_type',
        'recent_sample',
        'last_sample_date'
    ];
}
