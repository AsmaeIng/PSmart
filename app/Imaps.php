<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imaps extends Model
{
  protected $fillable = [
  
		  'id_isps', 'Email', 'Password', 'Folder'
      ];
	 protected $guarded = [];
}
