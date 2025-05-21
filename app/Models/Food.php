<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table = 'FOOD';
    protected $primaryKey = 'FOOD_ID';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ['NAME', 'DESCRIPTION', 'IMAGE'];

    public function alternativeFish()
    {
        return $this->hasMany(AlternativeFish::class, 'FOOD_ID', 'FOOD_ID');
    }
}
