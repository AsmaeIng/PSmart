<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Countrys extends Model
{
	protected $fillable = [
  
		  'name','sortname', 'phonecode',
      ];
	
    
	protected $guarded = [];
}
