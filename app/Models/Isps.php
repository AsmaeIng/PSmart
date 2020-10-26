<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Isps extends Model
{
    protected $table = 'isps';
    public $timestamps = false; 

    
     public function user()
    {
        return $this->belongsTo('App\User', 'users_id')->withTrashed();
    }
}
