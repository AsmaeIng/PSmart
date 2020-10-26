<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logoisps extends Model
{
    protected $fillable = ['name', 'path', 'isp_id'];	
	
	protected $guarded = [];
}