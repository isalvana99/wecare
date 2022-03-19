<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adminlog extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'adminlogId';
    public function user(){
      return $this->belongsTo('App\Model\User');
    }
}
