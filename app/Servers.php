<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servers extends Model
{
	protected $fillable = [
  
		  'OS_id', 'domain_id', 'provider_id', 'isps', 'alias', 'ips', 'userName', 'password', 'saleDate', 'active', 'ip', 
		  'expirationDate', 'price', 'sshPort', 'user_providers', 'password_providers', 'NIP', 'panel', 'random',
		  'typeSpamInbox', 'mailers'
    ];
	
	protected $guarded = [];
}
