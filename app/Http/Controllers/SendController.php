<?php

namespace App\Http\Controllers;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use DB;
use App\Sends;
use App\Headers;
use App\Bodys;
use App\Offres;
use App\Sips;//Sips Domains Servers
use App\Domains;
use App\Servers;
use App\Drops;
use App\File;
use Illuminate\Http\Request;

class SendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index()
    {
       $data = DB::table('sends')
       ->select('sends.*')
       ->get();
	 
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];	
        return view('pages.sends.index', ['pageConfigs' => $pageConfigs],compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
            
            
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
   
	    
	    $pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
		return view('pages.sends.create', ['pageConfigs' => $pageConfigs]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	  public function store(Request $request ) {		  
		$sends = new Sends();
		$sends->id_isps =  $request['id_isps'];
        $sends->fraction = $request['fraction'];
        $sends->x_delay = $request['x_delay'];
        $sends->seed = $request['seed'];
        $sends->count = $request['count'];        
		$sends->save();
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('sends.index', ['pageConfigs' => $pageConfigs]);

    }	
    /**
     * Display the specified resource.
     *
     * @param  \App\sends  $sends
     * @return \Illuminate\Http\Response
     */
    public function show(Typeliste $sends)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sends  $sends
     * @return \Illuminate\Http\Response
     */
    public function edit($id)//
    {
        $drop = DB::table('drops')
                ->join('offres','offres.id','=','drops.offre_id')
                ->join('headers','headers.id','=','drops.header_id')
                ->join('bodys','bodys.id','=','drops.body_id')
                ->select('drops.*','headers.texte as header','bodys.texte as body','offres.subjects as subject','offres.froms as from')
                ->where('drops.id', $id)->first();
        $tabSubject=explode(" ",$drop->subject);
        $tabFroms=explode(" ",$drop->from);
        //var_dump($tabFroms);
        $pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
		return view('pages.drops.editSend', ['pageConfigs' => $pageConfigs],compact('drop','tabSubject','tabFroms'));
	}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sends  $Sends
     * @return \Illuminate\Http\Response
     */			
						
	  public function update(Request $request, $id) {
        Drops::find($id)->update(
            ['startFrom'=>$request['name'],
            'returnPath'=>$request['country_id']  
        ]);
        foreach($request['vmta'] as $ip_id){
            DB::insert('insert into ipdrops (ip_id,id_drop) values (?, ?)', [1, $id]);
        }
        $pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('sends.index', ['pageConfigs' => $pageConfigs])
                        ->with('success','Typeliste updated successfully'); 
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sends  $sends
     * @return \Illuminate\Http\Response
     */
	  public function delete($id) {
        $sends = Sends::findOrFail($id);
        $sends->delete();
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('sends.index', ['pageConfigs' => $pageConfigs]);
    }

    public function send($id){
		
		
        $drop_id=$id;
        $offre_id=$this->getOffreId($drop_id);
        $supFile=$this->getSuppFile($offre_id);
        $data=$this->getData($drop_id);
        $unsubLink=$this->getUnsubLink($offre_id);
        $header=$this->getHeader($drop_id);
        $body=$this->getBody($drop_id);
        $returnPath=$this->getReturnPath($drop_id);        
        $fileId=$this->getFileId($drop_id);
		$file=$this->getFile($fileId);
        $offer_link=$this->getOfferLink($offre_id);
       
        $i=0;        
		//($data);
		//echo $offer_link;
        foreach($data as $to){
            $pos = strpos($supFile, md5($to));
            if ($pos === FALSE) {
                $ip=$this->getIp($drop_id);
                $idIP=$this->getIdIP($ip);
                $domain=$this->getDomain($ip);
                $from=$this->getFrom($offre_id);
                $subject=$this->getSubject($offre_id);
                $idEmail=$this->getIdEmail($to);
                $retPath=$this->changeReturnPath($returnPath,$domain);
                $tHeader=$this->changeHead($header,$subject,$from,$to,$retPath);
                $tBody=$this->changeBody($body,$domain,$drop_id,$idEmail,$fileId,$idIP,$ip,$file,$unsubLink); 
				$tHeader.="x-job:$drop_id-0-0-0\nx-virtual-mta: mta-$ip\n$tBody\n.\n";
				echo "</br>";
				echo $to;
				echo "</br>";
				echo $this->telnetSend($ip,$domain,$retPath,$subject,$to,$tBody,$retPath,$from);
				// echo $tBody;
			   /* echo $tHeader;
                echo "</br>";
                echo "--------------------------------------------";
                echo $tBody;
                echo "</br>";*/
            }else $to."supp file";            
        }
      
    }
    public function getUnsubLink($id_offre){
        $offre = Offres::findOrFail($id_offre);
        return $offre->unsub;
        //echo $offre->unsub;
    }   
    public function getOfferLink($id_offre){
        $offre = Offres::findOrFail($id_offre);
        return $offre->olink;
    }
    public function getReturnPath($id_drop){
        $drop = Drops::findOrFail($id_drop);       
        return $drop->returnPath;
    }
    public function getIdEmail($to){
        $data=DB::table('datas')->select('id')
                ->where('email_Email',"=",$to)
                ->first();
        //var_dump($data);
       // echo $data->id_Email;
	   $id=1;
        return $id;
    }
    public function getIdIP($ip){
        $ips=DB::table('sips')->select('id')
                ->where('IP',"=",$ip)
                ->first();
        return $ips->id;
    }
    public function getOffreId($id_drop){
        $drop = Drops::findOrFail($id_drop);
        return $offre_id=$drop->offre_id;
    }
    public function getFrom($offre_id){
        $offres=Offres::findOrFail($offre_id);
        $fName=$offres->froms;
      //  $subject=$offres->subjects;
        $tabName = explode(" ",$fName);
       // $tabSubject=explode(" ",$subject);
       //var_dump($tabName);
       $random_from_keys=array_rand($tabName);
       return $tabName[$random_from_keys];
    }
    public function getSubject($offre_id){
        $offres=Offres::findOrFail($offre_id);
        $subject=$offres->subjects;
        $tabSubject=explode(" ",$subject);
        //var_dump($tabSubject);
        $random_subj_keys=array_rand($tabSubject);
        //echo 
        return $tabSubject[$random_subj_keys];
    }
    public function getHeader($id_drop){
        $drop = Drops::findOrFail($id_drop);
        $header=Headers::findOrFail($drop->header_id);
        return $header->texte;
    }
    public function getBody($id_drop){
        $drop = Drops::findOrFail($id_drop);
        $body=Bodys::findOrFail($drop->body_id);
        // echo $body->texte;
        return $body->texte; 
    }
    public function getRand(){
        //function rand_string( $length ) {  
            $length=rand(10,100);
            $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz@#$&*";  
            $size = strlen( $chars );  
            $str="";
           // echo "Random string =";  
            for( $i = 0; $i < $length; $i++ ) {  
            $str.= $chars[ rand( 0, $size - 1 ) ];  
           // echo $str;  
            }  
           return $str; 
    }
    public function getIp($id_drop){
        $ip  = DB::table('drops_has_sips')
                    ->select('drops_has_sips.sips_id')
                    ->where('drops_has_sips.drops_id',"=",$id_drop)
                    ->get();      
        $ip_ad=array();      
        foreach ($ip as $key => $value) {           
            $ips  = Sips::findOrFail($value->sips_id);
            if($ips->IP!== null && !empty($ips->IP)){
                $ip_ad[] =trim($ips->IP);              
            }       
        }   
        $random_id_keys=array_rand($ip_ad);
        return $ip_ad[$random_id_keys];
    }
    public function getDomain($ip){
        $ip  = DB::table('sips')
            ->select('sips.*')
            ->where('sips.IP',"=",$ip)
            ->first();      
        //$ip_ad=array();
        $random=null;
        //var_dump($ip->id_domain);  
        if($ip->random!==null && !empty($ip->random)){
            $random=$ip->random;
        }else{           
            $dom = Domains::findOrFail($ip->id_domain);
            $random = $dom->name;
        }
        //echo $random;
        return $random;
    }
    public function getData($id_drop){
        $liste_id =DB::table('drops_has_liste')->select('listesends_id')
        ->where('drops_has_liste.drops_id' , $id_drop)
            ->get();
           // echo count($liste_id);
        $arrQuery = array();
        foreach($liste_id as $key => $liste){
            if(!empty($liste->listesends_id) && $liste->listesends_id!== NULL){
                $data=DB::table('datas')->select('email_Email')
                ->where('id_List_Email',"=",$liste->listesends_id)
                ->get();
                foreach($data as $key1 => $email){
                    if(!empty($email->email_Email) && $email->email_Email!== NULL){
                        //echo $email->email_Email;
                        //echo "</br>";
                        $arrQuery[]=trim($email->email_Email);
                    }   
                }
            }
        }
        //var_dump($arrQuery);
        return $arrQuery;
    }
   public function getFile($file_id){
        $file = File::findOrFail($file_id);    
        return $file->path;
    }
    public function getFileId($drop_id){
        $fid = Drops::findOrFail($drop_id); 
        return $fid->file_id;
    }
    public function getSuppFile($offre_id){
        $suppFile= DB::table('suppressions')
                    ->select('suppressions.*')
                    ->where('suppressions.offre_id',"=",$offre_id)
                    ->first();
        $content=null;	
        if(!empty($suppFile->path) && $suppFile->path!==NULL){
            if (file_exists("../public/".$suppFile->path)) 
                $content = file_get_contents("../public/".$suppFile->path);
        }        
        return $content;
    }      
    public function changeReturnPath($returnPath,$domain){
        $returnPath =    preg_replace('#\[domain\]#',$domain,$returnPath);
        return $returnPath;
    }
    public function changeHead($head,$subject,$from,$to,$returnPath){
        $f = explode("@",$returnPath);       
        $date =    date('Y/m/d H:i:s');
        $head =    str_replace('/','',$head);//fromEmail: <[RandomC6]@site11.com>       
        $head =    preg_replace('#subject:--#',"subject:".$subject,$head);
        $head =    preg_replace('#fromName:--#',"fromName:".$from,$head);
        $head =    preg_replace('#\[date\]#',$date,$head);
        $head =    preg_replace('#\[to\]#',$to,$head);
        $head =    preg_replace('#\[domain\]#',$f[1],$head);
        $head =    str_replace('<[RandomC6]','< '.$f[0],$head);//RandomCD45
        $head =    preg_replace('#\[domain\]#',$f[1],$head);
        $head =    preg_replace('#\[RandomCD45\]#',rand(),$head);
        $head =    preg_replace('#"#'," ",$head);

        $split = explode(PHP_EOL,$head);
		$from = '';						   
		$fromName  = '';
		$fromEmail = '';							  
	    foreach($split as $line)
		{
			$params = explode(':',$line);						 
			if(strtolower($params[0]) == 'fromname')
			$fromName = $params[1];							  
			if(strtolower($params[0]) == 'fromemail')
			$fromEmail = $params[1];
		}			   
		$from=$fromName.$fromEmail;						   
		$headerTelNet = '';						   
		foreach($split as $line)
		{
			$params = explode(':',$line,2);							  
			if(strtolower($params[0]) == 'fromname')
				$headerTelNet.="from:$from\n";
			else{
					if(strtolower($params[0]) != 'fromemail'&& !empty($params[1]))
						$headerTelNet.=$params[0].':'.trim($params[1])."\n";
				}							  
		}						   
        return $headerTelNet;
    }
    public function changeBody($body,$domain,$iddrop,$idEmail,$fileId,$idIP,$ip,$file,$creativeUnsub){
        $idEmail=rand();
        $idFrom=rand();
        $idSubject=rand();       
        $param = array($iddrop,$idEmail,$fileId,$idIP);
        $body =     preg_replace('#\[domain\]#',$domain,$body);
		$body =     preg_replace('#\[idSend\]#',$iddrop,$body);
		$body =     preg_replace('#\[idEmail\]#',$idEmail,$body);
		$body =     preg_replace('#\[idFrom\]#',$idFrom,$body);
		$body =     preg_replace('#\[idSubject\]#',$idSubject,$body);
		$body =     preg_replace('#\[idCreative\]#',$fileId,$body);
		$body =     preg_replace('#\[idIP\]#',$idIP,$body);
        $body =     preg_replace('#\[RandomC/3\]#',$this->getRand(),$body); 
        $body =     preg_replace('#\[nameCreative\]#',$file,$body);  
        $body =     preg_replace('#\[nameCreativeUnsub\]#',$creativeUnsub,$body);    
        return $body;
    }
    // public function telnetSend($ip,$domain,$returnPath,$to,$header){     
        // $telnet        = array();
        // $telnet[0]     = "telnet $ip\r\n";
        // $telnet[1]     = "HELO $domain\r\n";
        // $telnet[2]     = "MAIL FROM:<$returnPath>\r\n";
        // $telnet[3]     = "RCPT TO:<$to>\r\n";
        // $telnet[4]     = "DATA\r\n";
        // $telnet[5]     = $header;
        // @$fp           = fsockopen($ip, 25);
        // $count         = 0;
        // if (!$fp)
        // {
            // echo 'connection fail';
            // return false;   
        // }
        // else
        // {
            // foreach ($telnet as $current) 
            // {               
                // fwrite($fp, $current);
                // $smtpOutput=fgets($fp);
                // $g=substr($smtpOutput, 0, 3);
                // if (!(($g == "220") || ($g == "250") || ($g == "354")|| ($g == "500"))) 
                // {
                    // echo 'connection 2 fail';
                    // return false; 
                // }                    
            // }
            // fclose($fp);
        // }
    // }
	 
	 public function telnetSend($ip,$domain,$returnPath,$subject,$to,$header,$retPath,$from){ 
	
	  app('App\Console\Commands\TelnetMAIL')->handle($ip,$domain,$returnPath,$subject,$to,$header,$retPath,$from);
	  // return $ip;
    }
}
