<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MasterCriteria extends Model
{
    protected $table = 'MASTER_CRITERIA';
    protected $primaryKey = 'MASTER_CRITERIA_ID';
    public $incrementing = false;
    public $keyType = 'string';
    public $timestamps = false;

    protected $fillable = ['MASTER_CRITERIA_ID', 'WEIGHT_TXT', 'WEIGHT_INT', 'USER_ID', 'CRITERIA_ID', 'RESULT_ID'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    public function result()
    {
        return $this->belongsTo(Results::class, 'RESULT_ID', 'RESULT_ID');
    }

    // Scope untuk filter berdasarkan RESULT_ID
    public function scopeByResult($query, $resultId)
    {
        return $query->where('RESULT_ID', $resultId);
    }

    // Scope untuk urutkan berdasarkan peringkat (rank)
    public function scopeOrdered($query)
    {
        return $query->orderBy('RANK', 'asc');
    }
}
