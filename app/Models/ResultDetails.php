<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ResultDetails extends Model
{
    protected $table = 'RESULT_DETAIL';
    protected $primaryKey = 'RESULT_DETAIL_ID';
    public $incrementing = false;
    public $keyType = 'string';
    public $timestamps = false;

    protected $fillable = ['RESULT_DETAIL_ID', 'RANK', 'RESULT_ID', 'FISH_ID'];

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

    // Relasi: Detail hasil ini terkait satu ikan
    public function fish()
    {
        return $this->belongsTo(AlternativeFish::class, 'FISH_ID', 'FISH_ID');
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
