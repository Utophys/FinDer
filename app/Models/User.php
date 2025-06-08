<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;


class User extends Authenticatable implements CanResetPasswordContract
{
    use CanResetPassword;

    use HasFactory, Notifiable;

    protected $table = 'user_account';
    protected $primaryKey = 'USER_ID';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'USER_ID',
        'USERNAME',
        'DISPLAY_NAME',
        'PASSWORD',
        'SET_PASSWORD',
        'ROLE',
        'EMAIL',
        'PHONE_NUMBER',
        'IMAGE',
        'IS_DELETED',
    ];

    protected $hidden = [
        'PASSWORD',
    ];

    protected function casts(): array
    {
        return [
            'IS_DELETED' => 'boolean',
            'PASSWORD' => 'hashed',
        ];
    }

    public function getEmailForPasswordReset()
    {
        return $this->EMAIL;
    }

    public function getNameAttribute()
    {
        return $this->DISPLAY_NAME;
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) => !empty($attributes['IMAGE'])
            ? url('/storage/user/' . $attributes['IMAGE'])
            : null
        );
    }

    public function getAuthPassword()
    {
        return $this->PASSWORD;
    }
}
