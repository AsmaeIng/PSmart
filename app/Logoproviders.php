<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logoproviders extends Model
{
    protected $fillable = ['name', 'path', 'provider_id'];	
	
	protected $guarded = [];
}