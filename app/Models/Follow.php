<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'followId';
    public function user(){
      return $this->belongsTo('App\Model\User');
    }
}
