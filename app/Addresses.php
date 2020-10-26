<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Addresses extends Model
{
	protected $fillable = [
         'city_id', 'street', 'PostalCode', 'latitude', 'longitude',
      ];
	
	protected $guarded = [];
}
