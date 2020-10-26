<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class inbox_attachment extends Model
{
    //
    public function inbox(){
        return $this->belongTo('App\inbox');
    }
	 protected $fillable = [
  
		  'inbox_id', 'title', 'path',
      ];
}
