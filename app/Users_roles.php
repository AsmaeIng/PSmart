<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users_roles extends Model
{
	protected $fillable = [
		  'role_id', 'user_id', 
      ];
	
	protected $guarded = [];
}
