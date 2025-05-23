<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Results extends Model
{
    protected $table = 'RESULT';
    protected $primaryKey = 'RESULT_ID';
    public $incrementing = false;
    public $keyType = 'string';
    public $timestamps = false;

    protected $fillable = ['RESULT_ID', 'TIME_ADDED', 'USER_ID'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'USER_ID', 'USER_ID');
    }

    // Accessor untuk format waktu
    public function getFormattedTimeAddedAttribute()
    {
        return \Carbon\Carbon::parse($this->TIME_ADDED)->format('d M Y, H:i');
    }

    // Scope untuk filter berdasarkan user
    public function scopeByUser($query, $userId)
    {
        return $query->where('USER_ID', $userId);
    }

    public function details()
    {
        return $this->hasMany(ResultDetails::class, 'RESULT_ID', 'RESULT_ID');
    }

    public function masterCriteria()
    {
        return $this->hasMany(MasterCriteria::class, 'RESULT_ID', 'RESULT_ID');
    }
}
