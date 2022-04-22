<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $fillable = [
        'fileName',
        'filePath'
    ];
    public $timestamps = false;
    protected $primaryKey = 'fileId';
    public function user(){
      return $this->belongsTo('App\Model\User');
    }
}
