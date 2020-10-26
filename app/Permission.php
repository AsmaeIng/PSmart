<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Permission extends Model
{
	
protected $fillable = [
  
		  'name', 'description', 'slug'
      ];


	public function roles() {

		return $this->belongsToMany(Role::class,'role_has_permissions');
       
	}

	public function users() {

	   return $this->belongsToMany(User::class,'user_has_permissions');
		   
	}
	protected $guarded = [];
}
