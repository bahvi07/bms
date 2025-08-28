<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Staff_Roles extends Model
{
    //
     use HasFactory;
    protected $fillable = ['role', 'description'];
}
