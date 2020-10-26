<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Imaps extends Model
{
    protected $table = 'imaps';
    public $timestamps = false; 

    
     public function user()
    {
        return $this->belongsTo('App\User', 'users_id')->withTrashed();
    }
}
