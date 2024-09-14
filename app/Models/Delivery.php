<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    // Especifica la tabla asociada
    protected $table = 'delivery';
    protected $fillable = [
        'title',
        'location',
        'id_user',
    ];
}
