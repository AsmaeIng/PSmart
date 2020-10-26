<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Isps extends Model
{
	protected $fillable = [
  
		  'name', 'url', 'type', 'emailTeste',
      ];
	protected $guarded = [];
}
