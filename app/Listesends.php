<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Listesends extends Model
{
	
	public function drops() {

		return $this->belongsToMany(Drops::class,'drops_has_liste');
       
	}
	protected $fillable = [
    'name','country_id', 'active','typeListe_id','isp_id', 'withMessageID', 'optIn','delimiter','firstname','lastname','email','Fields' 
      ];
	
	protected $guarded = [];
}
