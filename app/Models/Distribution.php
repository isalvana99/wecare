<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distribution extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = "distributions";
    protected $primaryKey = 'distributionId';
    public function user(){
        return $this->belongsTo('App\Model\User');
    }
}
