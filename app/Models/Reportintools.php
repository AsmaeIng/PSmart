<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reportintools extends Model
{
    protected $table = 'reportintools';
    public $timestamps = false; 

    
     public function user()
    {
        return $this->belongsTo('App\User', 'users_id')->withTrashed();
    }
}
