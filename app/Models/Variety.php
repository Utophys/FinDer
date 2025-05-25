<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Variety extends Model
{
    protected $table = 'FISH_VARIETY';
    protected $primaryKey = 'FISH_VARIETY_ID';
    public $incrementing = false;
    public $keyType = 'string';
    public $timestamps = false;

    protected $fillable = ['FISH_VARIETY_ID', 'VARIETY_NAME', 'DESCRIPTION', 'FISH_ID', 'IMAGE', 'IS_DELETED'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn($image) => url('/storage/fish_varieties/' . $image),
        );
    }

    public function fish()
    {
        return $this->belongsTo(AlternativeFish::class, 'FISH_ID', 'FISH_ID');
    }
}
