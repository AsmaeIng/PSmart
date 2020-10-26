<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sends extends Model
{
	protected $fillable = [
  
		  'id_isps', 'fraction', 'x-delay', 'seed', 'count'
	 ];
	 
	protected $guarded = [];
}
