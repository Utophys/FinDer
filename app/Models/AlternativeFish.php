<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AlternativeFish extends Model
{
    protected $table = 'ALTERNATIVE_FISH';
    protected $primaryKey = 'FISH_ID';
    public $incrementing = false;
    public $timestamps = false;

    protected $keyType = 'string'; // penting karena UUID adalah string

    protected $fillable = ['FISH_ID', 'NAME', 'DESCRIPTION', 'FOOD_ID', 'IMAGE'];

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
            get: fn($image) => url('/storage/alternative_fishes/' . $image),
        );
    }

    public function food()
    {
        return $this->belongsTo(Food::class, 'FOOD_ID', 'FOOD_ID');
    }
}
