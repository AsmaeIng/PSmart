<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logonetworks extends Model
{
    protected $fillable = ['name', 'path', 'network_id'];	
	
	protected $guarded = [];
}