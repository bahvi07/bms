<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StaffRole extends Model
{
    use HasFactory;
    
    protected $fillable = ['role', 'description','status'];
    
    // Explicitly define the table name
    protected $table = 'staff_roles';
}
