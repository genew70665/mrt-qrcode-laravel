<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kit extends Model
{
    use HasFactory;

    protected $table = "kits";

    protected $fillable = [
        'kit', 'description', 
        'user'
    ];

    /**
     * relation between kit and the user.
     */
    public function userData(){
        return $this->hasOne(User::class, 'mrt_id', 'user');
    }
}

