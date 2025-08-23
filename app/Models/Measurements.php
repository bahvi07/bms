<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;
class Measurements extends Model
{
    use HasFactory;

    protected $fillable = ['label', 'description', 'unit'];

    public function garments()
    {
        return $this->belongsToMany(Garment::class, 'garment_measurement', 'measurement_id', 'garment_id');
    }
}
