<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flags extends Model
{
    protected $fillable = ['name', 'path', 'country_id'];	
	
	protected $guarded = [];
}