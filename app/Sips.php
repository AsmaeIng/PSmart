<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sips extends Model
{
	protected $fillable = [
		  'id_domain', 'server_id', 'IP', 'random',
      ];
	  
	protected $guarded = [];
}
