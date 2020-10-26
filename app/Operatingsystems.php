<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operatingsystems extends Model
{
	protected $fillable = [
  
		  'name', 'bit', 
      ];
	  
	protected $guarded = [];
}
