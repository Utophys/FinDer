<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;

class Food extends Model
{
    protected $table = 'FOOD';
    protected $primaryKey = 'FOOD_ID';
    public $incrementing = false;
    public $keyType = 'string';
    public $timestamps = false;

    protected $fillable = ['FOOD_ID', 'NAME', 'DESCRIPTION', 'IMAGE', 'IS_DELETED'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Generate UUID hanya jika FOOD_ID belum di-set
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    public function alternativeFish()
    {
        return $this->hasMany(AlternativeFish::class, 'FOOD_ID', 'FOOD_ID');
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn($image) => url('/storage/foods/' . $image),
        );
    }
}
