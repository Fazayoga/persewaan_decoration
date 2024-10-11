<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',  // Tambahkan username
        'email',
        'phone',
        'address',
        'image',
        'password',
        'user_type', // Tambahkan user_type
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Mutator untuk password hashing
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
