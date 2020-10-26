<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class inbox extends Model
{
    //
    protected $primaryKey = 'inbox_id';

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function attachments(){
        return $this->hasMany('App\inbox_attachment');
    }
}
