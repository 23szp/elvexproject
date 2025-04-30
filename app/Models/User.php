<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_image',
            'email_verification_token',
    'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function savedProducts()
{
    return $this->belongsToMany(Product::class, 'saved_products')->withTimestamps();
}
public function loginLogs()
{
    return $this->hasMany(LoginLog::class);
}
public function lastLogin()
{
    return $this->loginLogs()->latest()->first();
}

}