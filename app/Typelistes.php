<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Typelistes extends Model
{
	protected $fillable = [
  
		  'name', 'abriviation'
      ];
	  
	  
	protected $guarded = [];
}