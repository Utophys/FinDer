<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
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
        'ROLE',
        'EMAIL',
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

    public function getAuthPassword()
    {
        return $this->PASSWORD;
    }
}
