<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notif extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'notifId';
    public function user(){
      return $this->belongsTo('App\Model\User');
    }
}
