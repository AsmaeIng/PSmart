<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Countrys extends Model
{
    protected $table = 'countrys';
    public $timestamps = false; 

    
     public function user()
    {
        return $this->belongsTo('App\User', 'users_id')->withTrashed();
    }
}
