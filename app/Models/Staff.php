<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
#use Illuminate\Support\Str;
use App\Models\StaffRole;
class Staff extends Model
{
    
    public static function boot(){
        parent::boot();
        // When staff member added than increament assigned count in staff_roles table
        static::created(function($staff){
            if($staff->role_id){
               if ($staff->role_id) {
            $staff->role()->increment('assigned');
        }
            }
        });
        // When staff member deleted than decreament assigned count in staff_roles table
        static::deleted(function($staff){
            if($staff->role_id){
               if ($staff->role_id) {
            $staff->role()->decrement('assigned');
        }
            }
        });

    // when update staff role than decreament old role assigned count and increament new role assigned count
         static::updating(function ($staff) {
        if ($staff->isDirty('role_id')) {
            // decrement old role
            if ($staff->getOriginal('role_id')) {
                StaffRole::where('id', $staff->getOriginal('role_id'))
                         ->decrement('assigned');
            }
            // increment new role
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
