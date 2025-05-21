<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    protected $table = 'CRITERIA';
    protected $primaryKey = 'CRITERIA_ID';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ['CRITERIA_ID', 'NAME'];

}
