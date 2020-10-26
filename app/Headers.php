<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Headers extends Model
{
	protected $fillable = [
		  'name', 'texte',
      ];
	  
	protected $guarded = [];
}
