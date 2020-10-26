<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
   protected $fillable = [

		  'city', 'state_id'
      ];
	
    
	protected $guarded = [];
}
