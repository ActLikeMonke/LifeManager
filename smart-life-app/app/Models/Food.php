<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{

    /** @use HasFactory<FoodFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'calories',
        'protein',
        'carbs',
        'fats',
    ];
    
}
