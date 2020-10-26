<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Drops extends Model
{
    protected $table = 'drops';
    public $timestamps = false; 

    
     public function user()
    {
        return $this->belongsTo('App\User', 'users_id')->withTrashed();
    }
}