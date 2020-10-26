<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domains extends Model
{
	protected $fillable = [
  
		  'name', 'saleDate', 'expirationDate', 'provider_id',
      ];
	
	protected $guarded = [];
}
