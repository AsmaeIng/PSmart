<?php

namespace App\Console\Commands;
use Illuminate\Http\Request;
use Illuminate\Console\Command;
use App\Servers;
use App\Domains;
use App\Sips;
use DB;
class ListCommande extends Command
{
	
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
  ////  protected $signature = 'command:name';
	protected $signature = 'COMMANDES:SERVER';

    /**
     * The console command description.
     *
     * @var string
     */
    //protected $description = 'Command description';
	protected $description = 'RUN COMMANDES';
	

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle($id)
    {
		$connection=null;
		$server = Servers::findOrFail($id);
		
		$ip = $server['ip'];
		$password = $server['password'];
		$userName = $server['userName'];
		$sshPort =  $server['sshPort'];
		$domain_id = $server['domain_id'];
		
		$domain = domains::findOrFail($domain_id);
//1 cas no domain no random en Db		
/*		if($server['domain_id']==1 && $server['random']=='')
 {
	//appel Update
	echo "no host";
	
	
 }*/
//2 eme cas domain exist en Db	=> on l affecte à hostname(au niveau de server)	
		if($server['domain_id']==$domain['id'] && ($server['domain_id']!=1) )
		{
			
		$Vhost=  $domain['name'];
		}
//3 eme cas domain(Random)  exist en Db	=> on l affecte (Random) à hostname(au niveau de server)		
		elseif ($server['domain_id']==1)
		{
			$Vhost=  $server['random'];
		}
		
		
       $connection = ssh2_connect($ip, $sshPort);
	 
        if($connection)  
		{
	      
         if (ssh2_auth_password($connection, $userName, $password))    
				  
			{
              echo "Identification réussi !\n";
			  // echo $Vhost;
			  // echo $server['domain_id'];
  ///////delete  hostname


         // $stream = ssh2_exec($connection,'hostnamectl set-hostname ""');
         // $stream = ssh2_exec($connection,'hostnamectl set-hostname "" --static');
         // $stream = ssh2_exec($connection,'hostnamectl set-hostname "" --pretty');
  ////set the hostname
         // $stream = ssh2_exec($connection,'hostnamectl set-hostname '.$Vhost);
          // $stream = ssh2_exec($connection,'hostnamectl set-hostname '.$Vhost.' --pretty');
         // $stream = ssh2_exec($connection,'hostnamectl set-hostname '.$Vhost.' --static');
         // $stream = ssh2_exec($connection,'hostnamectl set-hostname '.$Vhost.' --transient');
/////

		 /////// add Domains
		  
		$stream = ssh2_exec($connection,'grep -s  '.$ip.'  /etc/httpd/sites-available/*');
		stream_set_blocking($stream, true);
		$output = stream_get_contents($stream);
		// $output  => /etc/httpd/sites-available/nom_domain.conf:<VirtualHost IP:80>

		//echo $output;
		if($output) 
		{
			//echo "oui";
			$nom = rtrim($output, "/etc/httpd/sites-available");


            $Nom_Domain = substr($nom, 27, -39); 
			
			
			//delete /var/www/html/..
		    // $stream = ssh2_exec($connection,'sudo rm -rf /var/www/'.$Nom_Domain);
		   /////or rename 
		   $stream = ssh2_exec($connection,'sudo mv  /var/www/'.$Nom_Domain.'  /var/www/'.$Vhost);
			// delete /etc/httpd/sites-available/..conf
		   $stream = ssh2_exec($connection,'sudo rm /etc/httpd/sites-available/'.$Nom_Domain.'.conf');
		   $stream = ssh2_exec($connection,'sudo rm /etc/httpd/sites-enabled/'.$Nom_Domain.'.conf');
		   
			
		}


 
		 
		 
		$stream = ssh2_exec($connection,'mkdir -p /var/www/'.$Vhost.'/html');
		$stream = ssh2_exec($connection,'sudo mkdir -p /var/www/'.$Vhost.'/log');
		$stream = ssh2_exec($connection,'sudo chown -R apache:apache /var/www/'.$Vhost.'/html');
		$stream = ssh2_exec($connection,'sudo chmod -R 755 /var/www');
		//
	    $stream = ssh2_exec($connection,'sudo touch /var/www/'.$Vhost.'/html/index.html');
	
		$stream = ssh2_exec($connection,'echo  "<html>"   "<head>"   "<title>" Welcome to '.$Vhost.'! "</title>"     "</head>"   "<body>"   "<h1>" Success! The '.$Vhost.' virtual  host is working! "</h1>"    "</body>"      "</html>" >> /var/www/'.$Vhost.'/html/index.html');
		
	
		
		
			/// create
		$stream = ssh2_exec($connection,'sudo touch /etc/httpd/sites-available/'.$Vhost.'.conf');
		
		$stream = ssh2_exec($connection,'echo -e "<VirtualHost '.$ip.':80>" "\n" ServerName www.'.$Vhost.'    "\n"   ServerAlias '.$Vhost.'  "\n"  DocumentRoot /var/www/'.$Vhost.'/html   "\n" ErrorLog /var/www/'.$Vhost.'/log/error.log   "\n"    CustomLog /var/www/'.$Vhost.'/log/requests.log combined  "\n"  "</VirtualHost>" >> /etc/httpd/sites-available/'.$Vhost.'.conf');
		
		$stream = ssh2_exec($connection,'sudo chmod -R 755 /etc/httpd/sites-available');
		$stream = ssh2_exec($connection,'sudo chmod -R 755 /etc/httpd/sites-enabled');
		
		$stream = ssh2_exec($connection,'sudo ln -s /etc/httpd/sites-available/'.$Vhost.'.conf /etc/httpd/sites-enabled/'.$Vhost.'.conf');
		
	
		

        		
		///////////////
		
		$stream = ssh2_exec($connection,'sudo semanage fcontext -a -t httpd_log_t "/var/www/'.$Vhost.'/log(/.*)?"');
		
		$stream = ssh2_exec($connection,'echo -e '.$ip.' '.$Vhost.' >> /etc/hosts');
		
		
	    $stream = ssh2_exec($connection,'sudo systemctl restart httpd');
		
		
		 //// end 
      
            }
	    }	   
	     else
		    {
            die('Echec de l\'identification...');
            }
	

    }
	
	
}
