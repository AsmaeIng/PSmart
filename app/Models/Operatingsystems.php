<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Operatingsystems extends Model
{
    protected $table = 'operatingsystems';
    public $timestamps = false; 

    
     public function user()
    {
        return $this->belongsTo('App\User', 'users_id')->withTrashed();
    }
}
