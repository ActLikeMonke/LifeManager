<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    protected $table = 'meals';
    protected $fillable = [
        'name',
    ];
    public function foods()
    {
        return $this->belongsToMany(Food::class, 'food_meal')
                    ->withPivot('quantity');
    }
}
