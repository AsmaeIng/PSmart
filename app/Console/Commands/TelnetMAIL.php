<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Sips;
use App\Servers;
use DB;
class TelnetMAIL extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:Telnets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
    public function handle($ip,$domain,$returnPath,$subject,$to,$header,$retPath,$from)
    {
		//////
		
		//$sip = Sips::findOrFail($ip);
		$server_id=DB::table('sips')
                    ->select('sips.*')
                    ->where('sips.IP',"=",$ip)
                    ->first();
	    $server = Servers::findOrFail($server_id->server_id);	
		
		$password = $server['password'];
		$userName = $server['userName'];
		$sshPort =  $server['sshPort'];
	// echo $password; 
	// echo "</br>";
	// echo $userName;
	// echo "</br>";
	// echo $sshPort;
	// echo "</br>";
	// echo $ip;
	// echo "</br>";
	// echo "retPath =>". $retPath;
	// echo "</br>";
	// echo "from =>" .$from;
		/////
        $connection = ssh2_connect($ip, $sshPort);
	 
        if($connection)  
		{
	      
            if (ssh2_auth_password($connection, $userName, $password)) 
			{
            //  echo "Identification réussi !\n";
		

		    echo $header;
			echo $to;
		
	//  $stream = ssh2_exec($connection,'echo "test hi " | mail -s "$(echo -e "This is the subjec with from\nFrom: '.$from.' <'.$retPath.'> \nMIME-Version: 1.0\nContent-Type: text/html; charset="ISO-8859-1"")"  '.$to);
        // ok ok ok spam   
		 $stream = ssh2_exec($connection,'echo "'.$header.'" | mail -s "$(echo -e "This is the subject with from ASMAE_gmail\nFrom: '.$from.' <'.$retPath.'> \nMIME-Version: 1.0\nContent-Type: text/html; charset="ISO-8859-1"")" '.$to);
		
        // echo $header;
		 // $stream = ssh2_exec($connection,'echo "'.$header.'" | mail -s "$(echo -e "This is the subjec with from\nFrom: Asmae222 <johny@paula.com> \nMIME-Version: 1.0\nContent-Type: text/html; charset="ISO-8859-1"")" '.$to);
 
 
	
		// ok  $stream = ssh2_exec($connection,'echo "<html><head></head><body><center><a href="https://google.fr"> Click Here! </a>  <br><br><center></center><br/><br/></body></html>" | mail -s "$(echo -e "This is the subject\nMIME-Version: 1.0\nContent-Type: text/html; charset="ISO-8859-1"")" '.$to);
		//modele
		// stream = ssh2_exec($connection,"echo 'body' | mailx -s 'subject' ".$to);
		

//OK	 echo "<html><head><meta http-equiv='content-type' content='text/html; charset=ISO-8859-1'><style type='text/css'>#WN {font-weight:bold;color:#F00;font-weight:bold;}</style></head><body><p id='WN'>HELLO ASMAE</p></body></html>" | mail -s "$(echo -e "This is the subject\nMIME-Version: 1.0\nContent-Type: text/html; charset="ISO-8859-1"")" elamrani.asmae@gmail.com

//ok echo "<html><head><meta http-equiv='content-type' content='text/html; charset=ISO-8859-1'></head><body><center><a href='http://site11.com/42TVdoHOszUgKP6uu#3RKLN4vuPzwAU4z@8kmDIj28mTxIPVsNYSKfuv@I#ED$DN$aA6mu8Pl#f*1izx1585061486TVdoHOszUgKP6uu#3RKLN4vuPzwAU4z@8kmDIj28mTxIPVsNYSKfuv@I#ED$DN$aA6mu8Pl#f*1izx654143310TVdoHOszUgKP6uu#3RKLN4vuPzwAU4z@8kmDIj28mTxIPVsNYSKfuv@I#ED$DN$aA6mu8Pl#f*1izx1735444994TVdoHOszUgKP6uu#3RKLN4vuPzwAU4z@8kmDIj28mTxIPVsNYSKfuv@I#ED$DN$aA6mu8Pl#f*1izx71TVdoHOszUgKP6uu#3RKLN4vuPzwAU4z@8kmDIj28mTxIPVsNYSKfuv@I#ED$DN$aA6mu8Pl#f*1izx44yzo' style='text-decoration: none;'><font size='5' color='#8A0829'> Click Here!   </font></a><br><br><center><a href='http://site11.com/42TVdoHOszUgKP6uu#3RKLN4vuPzwAU4z@8kmDIj28mTxIPVsNYSKfuv@I#ED$DN$aA6mu8Pl#f*1izx1585061486TVdoHOszUgKP6uu#3RKLN4vuPzwAU4z@8kmDIj28mTxIPVsNYSKfuv@I#ED$DN$aA6mu8Pl#f*1izx654143310TVdoHOszUgKP6uu#3RKLN4vuPzwAU4z@8kmDIj28mTxIPVsNYSKfuv@I#ED$DN$aA6mu8Pl#f*1izx1735444994TVdoHOszUgKP6uu#3RKLN4vuPzwAU4z@8kmDIj28mTxIPVsNYSKfuv@I#ED$DN$aA6mu8Pl#f*1izx71TVdoHOszUgKP6uu#3RKLN4vuPzwAU4z@8kmDIj28mTxIPVsNYSKfuv@I#ED$DN$aA6mu8Pl#f*1izx44yzo'><img src='http://site11.com/images/offres/offre2.jpg'/></a></center><center>   <a href='http://site11.com/42TVdoHOszUgKP6uu#3RKLN4vuPzwAU4z@8kmDIj28mTxIPVsNYSKfuv@I#ED$DN$aA6mu8Pl#f*1izx1585061486TVdoHOszUgKP6uu#3RKLN4vuPzwAU4z@8kmDIj28mTxIPVsNYSKfuv@I#ED$DN$aA6mu8Pl#f*1izx654143310TVdoHOszUgKP6uu#3RKLN4vuPzwAU4z@8kmDIj28mTxIPVsNYSKfuv@I#ED$DN$aA6mu8Pl#f*1izx1735444994TVdoHOszUgKP6uu#3RKLN4vuPzwAU4z@8kmDIj28mTxIPVsNYSKfuv@I#ED$DN$aA6mu8Pl#f*1izx71TVdoHOszUgKP6uu#3RKLN4vuPzwAU4z@8kmDIj28mTxIPVsNYSKfuv@I#ED$DN$aA6mu8Pl#f*1izx44yzu'><img src='http://site11.com/google.com'/></a></center><br/><br/><center>   <a href='http://site11.com/42TVdoHOszUgKP6uu#3RKLN4vuPzwAU4z@8kmDIj28mTxIPVsNYSKfuv@I#ED$DN$aA6mu8Pl#f*1izx1585061486TVdoHOszUgKP6uu#3RKLN4vuPzwAU4z@8kmDIj28mTxIPVsNYSKfuv@I#ED$DN$aA6mu8Pl#f*1izx654143310TVdoHOszUgKP6uu#3RKLN4vuPzwAU4z@8kmDIj28mTxIPVsNYSKfuv@I#ED$DN$aA6mu8Pl#f*1izx1735444994TVdoHOszUgKP6uu#3RKLN4vuPzwAU4z@8kmDIj28mTxIPVsNYSKfuv@I#ED$DN$aA6mu8Pl#f*1izx71TVdoHOszUgKP6uu#3RKLN4vuPzwAU4z@8kmDIj28mTxIPVsNYSKfuv@I#ED$DN$aA6mu8Pl#f*1izx44yoo'><img src='http://site11.com/OurUnsub1.png'/></a></center><br/><br/><center>   	<img style='width:0px;height:0px;display:none;' src='http://site11.com/42[RandomC/2]1585061486[RandomC/2]654143310[RandomC/2]1735444994[RandomC/2]44=[sender]'/></center></body></html>" | mail -s "$(echo -e "This is the subject\nMIME-Version: 1.0\nContent-Type: text/html; charset="ISO-8859-1"")" elamrani.asmae@gmail.com
	
	
// syntaxe cmd  ok echo "<html></html>" | mail -s "$(echo -e "This is the subject\nMIME-Version: 1.0\nContent-Type: text/html; charset="ISO-8859-1"")" elamrani.asmae@gmail.com	
		
	
	
//ok	$stream = ssh2_exec($connection,'echo "<html><head></head><body><center><a href="https://google.fr"> Click Here! </a>  <br><br><center></center><br/><br/></body></html>" | mail -s "$(echo -e "This is the subject\nMIME-Version: 1.0\nContent-Type: text/html; charset="ISO-8859-1"")" elamrani.asmae@gmail.com');
	  
     	 // $stream = ssh2_exec($connection,"echo ".$header." | mailx -s  'Essai Postfix2'    elamrani.asmae@gmail.com");
	
	      // $stream = ssh2_exec($connection,"echo 'Test de messag3f' | mailx -s 'Essai 333' elamrani.asmae@gmail.com");
      
			//echo "Test de messag3f' | mailx -s 'Essai 333' elamrani.asmae@gmail.com"
      
     
	 // $stream = ssh2_exec($connection,'echo "<html>
	 // <head>
	 // </head>
	 // <body>
	 // <center>
	 // <a href="http://site11.com/" ><font size="5" > Click Here!   </font></a><br><br><center><a href="http://site11.com"></a></center><center> </a></center><br/><br/><center>  </center></body></html>" | mail -s "$(echo -e "This is the subject\nMIME-Version: 1.0\nContent-Type: text/html; charset="ISO-8859-1"")" elamrani.asmae@gmail.com');
	
// ok n fois => 
	 // $stream = ssh2_exec($connection,'echo "<html>
// <head>

// </head>
// <body>
// <center>
// <a href="http://site11.com/42TVdoHOszUgKP6uu#3RKLN4vuPzwAU4z@8kmDIj28mTxIPVsNYSKfuv@I#ED$DN$aA6mu8Pl#f*1izx1585061486TVdoHOszUgKP6uu#3RKLN4vuPzwAU4z@8kmDIj28mTxIPVsNYSKfuv@I#ED$DN$aA6mu8Pl#f*1izx654143310TVdoHOszUgKP6uu#3RKLN4vuPzwAU4z@8kmDIj28mTxIPVsNYSKfuv@I#ED$DN$aA6mu8Pl#f*1izx1735444994TVdoHOszUgKP6uu#3RKLN4vuPzwAU4z@8kmDIj28mTxIPVsNYSKfuv@I#ED$DN$aA6mu8Pl#f*1izx71TVdoHOszUgKP6uu#3RKLN4vuPzwAU4z@8kmDIj28mTxIPVsNYSKfuv@I#ED$DN$aA6mu8Pl#f*1izx44yzo" style="text-decoration: none">
// <font size="5" color="#8A0829">
 // Click Here!   </font></a>
// <br>
// <br>
// <center>
// <a href="http://site11.com/42TVdoHOszUgKP6uu#3RKLN4vuPzwAU4z@8kmDIj28mTxIPVsNYSKfuv@I#ED$DN$aA6mu8Pl#f*1izx1585061486TVdoHOszUgKP6uu#3RKLN4vuPzwAU4z@8kmDIj28mTxIPVsNYSKfuv@I#ED$DN$aA6mu8Pl#f*1izx654143310TVdoHOszUgKP6uu#3RKLN4vuPzwAU4z@8kmDIj28mTxIPVsNYSKfuv@I#ED$DN$aA6mu8Pl#f*1izx1735444994TVdoHOszUgKP6uu#3RKLN4vuPzwAU4z@8kmDIj28mTxIPVsNYSKfuv@I#ED$DN$aA6mu8Pl#f*1izx71TVdoHOszUgKP6uu#3RKLN4vuPzwAU4z@8kmDIj28mTxIPVsNYSKfuv@I#ED$DN$aA6mu8Pl#f*1izx44yzo">
// <img src="http://site11.com/images/offres/offre2.jpg"/> Click Here2!
// </a>
// </center>
// <center>   
// <a href="http://site11.com/42TVdoHOszUgKP6uu#3RKLN4vuPzwAU4z@8kmDIj28mTxIPVsNYSKfuv@I#ED$DN$aA6mu8Pl#f*1izx1585061486TVdoHOszUgKP6uu#3RKLN4vuPzwAU4z@8kmDIj28mTxIPVsNYSKfuv@I#ED$DN$aA6mu8Pl#f*1izx654143310TVdoHOszUgKP6uu#3RKLN4vuPzwAU4z@8kmDIj28mTxIPVsNYSKfuv@I#ED$DN$aA6mu8Pl#f*1izx1735444994TVdoHOszUgKP6uu#3RKLN4vuPzwAU4z@8kmDIj28mTxIPVsNYSKfuv@I#ED$DN$aA6mu8Pl#f*1izx71TVdoHOszUgKP6uu#3RKLN4vuPzwAU4z@8kmDIj28mTxIPVsNYSKfuv@I#ED$DN$aA6mu8Pl#f*1izx44yzu">
// <img src="http://site11.com/google.com"/> Click Here3!
// </a>
// </center>
// <br/><br/>
// <center>   
// <a href="http://site11.com/42TVdoHOszUgKP6uu#3RKLN4vuPzwAU4z@8kmDIj28mTxIPVsNYSKfuv@I#ED$DN$aA6mu8Pl#f*1izx1585061486TVdoHOszUgKP6uu#3RKLN4vuPzwAU4z@8kmDIj28mTxIPVsNYSKfuv@I#ED$DN$aA6mu8Pl#f*1izx654143310TVdoHOszUgKP6uu#3RKLN4vuPzwAU4z@8kmDIj28mTxIPVsNYSKfuv@I#ED$DN$aA6mu8Pl#f*1izx1735444994TVdoHOszUgKP6uu#3RKLN4vuPzwAU4z@8kmDIj28mTxIPVsNYSKfuv@I#ED$DN$aA6mu8Pl#f*1izx71TVdoHOszUgKP6uu#3RKLN4vuPzwAU4z@8kmDIj28mTxIPVsNYSKfuv@I#ED$DN$aA6mu8Pl#f*1izx44yoo">
// <img src="http://site11.com/OurUnsub1.png"/> Click Here4!
// </a>
// </center>
// <br/><br/>
// <center>   
	// <img style="width:0px height:0px display:none" src="http://site11.com/42[RandomC/2]1585061486[RandomC/2]654143310[RandomC/2]1735444994[RandomC/2]44=[sender]"/>
// </center>
// </body>
// </html>
// " | mail -s "$(echo -e "This is the subject\nMIME-Version: 1.0\nContent-Type: text/html; charset="ISO-8859-1"")" '.$to);

	// ok (mais headr s affiche une seule fois) $stream = ssh2_exec($connection,'echo "'.$header.'" | mail -s "$(echo -e "This is the subjectAAAA2\nMIME-Version: 1.0\nContent-Type: text/html; charset="ISO-8859-1"")" '.$to);
		
	  
            }
	    }	   
	     else
		    {
            die('Echec de l\'identification...');
            }
    }
}
