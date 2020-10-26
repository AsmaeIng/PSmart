<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offres extends Model
{
  protected $fillable = [
  
		  'country_id', 'network_id', 'osid', 'name', 'vertical_id', 'froms', 'subjects','active', 'sensitiv', 'olink', 'unsub',
		  'downloadSuppression', 'notWorkingDays', 'Creative', 'Suppression','DirectLink','isImage','vertical_id','TreatSuppression','TypeSuppression',
      ];
}
