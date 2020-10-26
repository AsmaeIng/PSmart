<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suppressions extends Model
{
    protected $fillable = ['name', 'path', 'offre_id'];	
	
	protected $guarded = [];
}