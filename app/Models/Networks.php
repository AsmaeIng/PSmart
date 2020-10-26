<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Networks extends Model
{
    protected $table = 'networks';
    public $timestamps = false; 

    
     public function user()
    {
        return $this->belongsTo('App\User', 'users_id')->withTrashed();
    }
}
