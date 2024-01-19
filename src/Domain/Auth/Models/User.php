<?php

namespace Domain\Auth\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected  $fillable = [
        'name',
        'password',
        'email'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    public function avatar(): Attribute
    {
        return Attribute::make(
            get: fn() => "https://ui-avatars.com/api/?name=John"
        );
    }
}
