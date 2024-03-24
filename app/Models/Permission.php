<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use HasFactory, SoftDeletes;
    /**
     * با این تابع کاری می کنیم که هر موقع خواستیم 
     * یک سطح دسترسی جدید ایجاد کنیم خود به خود به رول ادمین هم
     * اضافه شود و رول ادمین سوپر یوزر شود
     */
    protected static function boot()
    {
        parent::boot();
        static::created(function ($permission) {
            Role::whereName('admin')->first()->permissions()->attach([$permission->id]);
        });
    }
}
