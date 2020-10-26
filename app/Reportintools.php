<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reportintools extends Model
{
	protected $fillable = [
  
	
		  'id_isps', 'NumberReportl', 'spam', 'toindex', 'move', 'mark'
      ];
	protected $guarded = [];
}
