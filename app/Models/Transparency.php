<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transparency extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = "transparencies";
    protected $primaryKey = 'transparencyId';
    public function user(){
        return $this->belongsTo('App\Model\User');
    }
}
