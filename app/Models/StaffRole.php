<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class StaffRole extends Model
{
    protected $table = 'staff_roles';
    protected $fillable = ['role', 'description', 'status'];

    // Tell Eloquent: primary key is not auto-increment
    public $incrementing = false;

    // UUID is string
    protected $keyType = 'string';
// Model Events to auto-generate UUID
    // Auto-generate UUID on create
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }
    public function staff()
    {
        return $this->hasMany(Staff::class, 'role_id');
    }
}
