<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bodys extends Model
{
	protected $fillable = [
		  'name', 'texte',
      ];
	  
	protected $guarded = [];
}
