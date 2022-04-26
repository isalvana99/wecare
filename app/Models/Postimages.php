<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postimages extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'postImagesId';
    public function user(){
      return $this->belongsTo('App\Model\User');
    }
}
