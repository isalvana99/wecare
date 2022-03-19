<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = "transactions";
    protected $primaryKey = 'transactionId';
    public function user(){
        return $this->belongsTo('App\Model\User');
    }
}
