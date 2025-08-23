<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Garment extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function measurements()
    {
        return $this->belongsToMany(Measurements::class, 'garment_measurement', 'garment_id', 'measurement_id');
    }

}

