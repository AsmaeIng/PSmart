<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Datas extends Model
{
	protected $fillable = [
  
                    'id', 'email_Email', 'firstName_Email', 'lastName_Email', 'dob_Email', 'state_Email', 'id_List_Email', 'messageId'
                        ];
	protected $guarded = [];
}
