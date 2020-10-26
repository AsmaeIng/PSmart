<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offres extends Model
{
    protected $table = 'offres';
    public $timestamps = false; 

    
     public function user()
    {
        return $this->belongsTo('App\User', 'users_id')->withTrashed();
    }
}
