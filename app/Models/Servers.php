<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servers extends Model
{
    protected $table = 'servers';
    public $timestamps = false; 

    
     public function user()
    {
        return $this->belongsTo('App\User', 'users_id')->withTrashed();
    }
}
