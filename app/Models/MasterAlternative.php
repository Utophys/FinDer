<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MasterAlternative extends Model
{
    protected $table = 'MASTER_ALTERNATIVES';
    protected $primaryKey = 'MASTER_ALTERNATIVES_ID';
    public $incrementing = false;
    public $keyType = 'string';
    public $timestamps = false;

    protected $fillable = ['MASTER_ALTERNATIVES_ID', 'CRITERIA_ID', 'FISH_ID', 'VALUE'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    public function alternativeFish()
    {
        return $this->belongsTo(AlternativeFish::class, 'FISH_ID', 'FISH_ID');
    }

    public function criteria()
    {
        return $this->belongsTo(Criteria::class, 'CRITERIA_ID', 'CRITERIA_ID');
    }


}
