<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Providers extends Model
{
    protected $table = 'providers';
    public $timestamps = false; 

    
     public function user()
    {
        return $this->belongsTo('App\User', 'users_id')->withTrashed();
    }
}
