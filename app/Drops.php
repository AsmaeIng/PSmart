<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drops extends Model
{
	
	public function listesends() {

		return $this->belongsToMany(Listesends::class,'drops_has_liste');
       
	}
	public function sips() {

		return $this->belongsToMany(Sips::class,'drops_has_sips');
       
	}public function servers() {

		return $this->belongsToMany(Servers::class,'drops_has_servers');
       
	}
	protected $fillable = [
		'network_id', 'offre_id', 'id_isps', 'country_id', 'data_id', 'body_id', 'header_id', 'file_id'
                        ];
	protected $guarded = [];
}
