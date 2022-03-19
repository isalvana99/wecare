<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recactivity extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'recactivityId';
    public function user(){
      return $this->belongsTo('App\Model\User');
    }
}
