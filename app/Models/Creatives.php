<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Creatives extends Model
{
    protected $table = 'creatives';
    public $timestamps = false; 

    
     public function user()
    {
        return $this->belongsTo('App\User', 'users_id')->withTrashed();
    }
}
