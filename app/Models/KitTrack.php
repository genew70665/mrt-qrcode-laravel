<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KitTrack extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'equipment_id',
        'point_id',
        'kit_id',
        'identified_equipment',
        'fluid_in_use',
        'fluid_grade',
        'type',
        'description'
    ];

    /**
     * method for relations between kit track and user
     */
    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * method for relations between user and kit
     */
    public function kit(){
        return $this->hasOne(Kit::class, 'id', 'kit_id');
    }

    /**
     * method for relations between user and equipment
     */
    public function equipment(){
        return $this->hasOne(Equipment::class, 'id', 'equipment_id');
    }
}
