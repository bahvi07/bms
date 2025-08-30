<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\StaffRole;

class Staff extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'full_name',
        'phone', 
        'email',
        'role_id',
        'joining_date',
        'address',
        'shift_start_time',
        'shift_end_time',
        'profile_picture',
        'id_proof',
    ];

    protected $casts = [
        'joining_date' => 'date',
    ];

    // Model Events to manage assigned count in staff_roles table
    public static function boot()
    {
        parent::boot();
        
        // When staff member is added, increment assigned count in staff_roles table
        static::created(function($staff) {
            if ($staff->role_id) {
                $staff->role()->increment('assigned');
            }
        });
        
        // When staff member is deleted, decrement assigned count in staff_roles table
        static::deleted(function($staff) {
            if ($staff->role_id) {
                $staff->role()->decrement('assigned');
            }
        });

        // When staff role is updated, decrement old role assigned count and increment new role assigned count
        static::updating(function ($staff) {
            if ($staff->isDirty('role_id')) {
                // Decrement old role
                if ($staff->getOriginal('role_id')) {
                    StaffRole::where('id', $staff->getOriginal('role_id'))
                             ->decrement('assigned');
                }
                // Increment new role
                if ($staff->role_id) {
                    StaffRole::where('id', $staff->role_id)->increment('assigned');
                }
            }
        });
    }

    public function role()
    {
        return $this->belongsTo(StaffRole::class, 'role_id');
    }
}
