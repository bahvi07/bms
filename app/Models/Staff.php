<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\StaffRole;
use Illuminate\Support\Str;

class Staff extends Model
{
    use HasFactory;
    
    public $incrementing = false;
    protected $keyType = 'string';
    
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }
    
    protected $fillable = [
        'staff_code',
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
    protected static function booted()
    {
        
        static::creating(function($staff) {
            // Get the highest existing staff code number
            $lastStaffCode = Staff::whereNotNull('staff_code')
                ->orderByRaw('CAST(SUBSTRING(staff_code, 5) AS UNSIGNED) DESC')
                ->value('staff_code');
            
            if ($lastStaffCode) {
                // Extract number from STF-XXX format
                $lastNumber = (int) substr($lastStaffCode, 4);
                $nextNumber = $lastNumber + 1;
            } else {
                $nextNumber = 1; // First staff member
            }
            
            $staff->staff_code = 'STF-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
        });
        
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

public function salary()
{
    return $this->hasOne(Salary::class, 'staff_id');
}


}
