<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    // ✅ Fix: Add UUID generation
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) \Illuminate\Support\Str::uuid();
            }
        });
    }
    
    protected $fillable = [
        'staff_id',
        'base_salary',
        'amount_paid',
        'pending_amount',
        'payment_status',
        'payment_date',
        'remarks',
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }
}
