<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BodyMetric extends Model
{
  public function user() {
        return $this->belongsTo(User::class);
    }

    public $guarded = []; // Allow mass assignment for all attributes
}
