<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drops_has_liste extends Model
{
 public function permissions() {

   return $this->belongsToMany(Permission::class,'role_has_permissions');
       
}

public function users() {

   return $this->belongsToMany(User::class,'users_roles');
       
}

protected $fillable = [
  
		  'name', 'slug',
      ];

protected $guarded = [];
}
