<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlternativeFish extends Model
{
    protected $table = 'ALTERNATIVE_FISH';
    protected $primaryKey = 'FISH_ID';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ['NAME', 'DESCRIPTION', 'FOOD_ID'];

    public function food()
    {
        return $this->belongsTo(Food::class, 'FOOD_ID', 'FOOD_ID');
    }
}
