<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Isps extends Model
{
    protected $table = 'sips';
    public $timestamps = false; 

    
     public function user()
    {
        return $this->belongsTo('App\User', 'users_id')->withTrashed();
    }
}
