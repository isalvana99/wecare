<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'likeId';
    // public function user(){
    //   return $this->belongsTo('App\Model\User');
      
    // }
    
    //ADDED
    public function user() 
    { 
        return $this->hasOne('App\User', 'id', 'user_id'); 
    }
}
