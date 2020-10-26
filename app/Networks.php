<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Networks extends Model
{
	protected $fillable = [

		  'name', 'login', 'password', 'URLSignIn', 'AffiliateID', 'APIAccessKey', 'APIHostURL', 'id-Plateform', 'logo', 'type','token',
      ];

}
