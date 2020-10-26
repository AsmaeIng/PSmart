<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Listesends extends Model
{
    protected $table = 'listesends';
    public $timestamps = false; 

    
     public function user()
    {
        return $this->belongsTo('App\User', 'users_id')->withTrashed();
    }
}
