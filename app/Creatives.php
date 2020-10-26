<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Creatives extends Model
{
	protected $fillable = [
  
		  'network_id', 'vertical_id','offer_id','creative'
      ];
	
	protected $guarded = [];
}
