<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deletedusers extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = "deletedusers";
    protected $primaryKey = 'deleteduserId';
    public function user(){
        return $this->belongsTo('App\Model\User');
    }
}
