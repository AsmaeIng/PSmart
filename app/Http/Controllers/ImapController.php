<?php

namespace App\Http\Controllers;
use DB;
use App\Imaps;
use Illuminate\Http\Request;

class ImapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index()
    {
        $imaps = DB::table('imaps')
			 ->join('isps','isps.id','=','imaps.id_isps')
			 ->select('imaps.*','isps.name as NameIs')
			 ->get();
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];	
        return view('pages.imaps.index', ['pageConfigs' => $pageConfigs],compact('imaps'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $isps = DB::table('isps')
			   ->select('isps.*')
			   ->get();
	   $pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
		return view('pages.imaps.create', ['pageConfigs' => $pageConfigs],compact('isps'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
 
	
	  public function store(Request $request) {

        $imap = new Imaps(); 
		$imap->id_isps = $request['id_isps'];
		$imap->Email = $request['Email'];
		$imap->Password = $request['Password'];
		$imap->Folder = $request['Folder'];
		$imap->save();
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('imaps.index', ['pageConfigs' => $pageConfigs]);

    }
	
	
	
    /**
     * Display the specified resource.
     *
     * @param  \App\Imaps  $imap
     * @return \Illuminate\Http\Response
     */
    public function show(imap $imap)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Imaps  $imap
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$data = DB::table('imaps')
			 ->join('isps','isps.id','=','imaps.id_isps')
			 ->select('imaps.*','isps.name as nameIS','isps.id as idIS')
			 ->get();
		$isps = DB::table('isps')
			   ->select('isps.*')
			   ->get();
		$imap = Imaps::findOrFail($id);
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
		return view('pages.imaps.edit', ['pageConfigs' => $pageConfigs] ,compact('imap','isps','data'));    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Imaps  $imap
     * @return \Illuminate\Http\Response
     */			
						
	 public function update(Request $request, $id) {

        $imap = Imaps::findOrFail($id);

        $imap->fill($request->all());
        $imap->save();

        $pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('imaps.index', ['pageConfigs' => $pageConfigs])
                        ->with('success','imap updated successfully'); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Imaps  $imap
     * @return \Illuminate\Http\Response
     */
    // public function destroy(imap $imap)
    // {
    // $imap->delete();
		// $pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        // return redirect()->route('pages.imaps.index', ['pageConfigs' => $pageConfigs])
                        // ->with('success','imaps deleted successfully');  
    // }
	  public function delete($id) {

        $imap = Imaps::findOrFail($id);
        $imap->delete();
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('imaps.index', ['pageConfigs' => $pageConfigs]);

    }

    public function getImapFromMail(){

        $isps = DB::table('isps')
        ->select('isps.*')
        ->get();
        $pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return view('pages.imaps.imapfromemail', ['pageConfigs' => $pageConfigs],compact('isps'));
    }
    public function getImap(Request $request){
        $isps = DB::table('isps')
        ->select('isps.*')
        ->get();
        $isp = $request['id_isps'];
		$username = $request['Email'];
		$password = $request['Password'];
        $folder = $request['Folder'];
        $emails='';
        $f='';
        $from=array();
        $subject=array();
        $fromAdd=$subject=array();
        
        $today=getdate(date("U"));
        $Directoryname=date("Y-m-d") ;
        switch($isp)
        {
            case 'gmail':
                if($folder==="INBOX") $f="INBOX";
                elseif($folder==="SPAM") $f="[Gmail]/Spam";
                $hostname =  '{imap.gmail.com:993/imap/ssl}'.$f;
                $inbox = imap_open($hostname,$username,$password) or die('Cannot connect to Gmail: ' . imap_last_error());

                /* grab emails */
                $emails = imap_search($inbox,'ALL');
    
                /* if emails are returned, cycle through each... */
                if($emails) {               
                                   
                    /* put the newest emails on top */
                    rsort($emails);
                    $d=getdate();
                    $d1=implode($d);
                    /* for every email... */
                     // Le nom du répertoire à créer

                    // Vérifie si le répertoire existe :
                    if (is_dir('../public/NegaImap/'.$Directoryname)) {
                        $file=fopen('../public/NegaImap/'.$Directoryname.'/negaSubject'.$d1.'.txt','w+');
                        $file1=fopen('../public/NegaImap/'.$Directoryname.'/negaEmail'.$d1.'.txt','w+');
                                      }
                    // Création du nouveau répertoire
                    else { 
                          mkdir('../public/NegaImap/'.$Directoryname);
                          $file=fopen('../public/NegaImap/'.$Directoryname.'/negaSubject'.$d1.'.txt','w+');
                          $file1=fopen('../public/NegaImap/'.$Directoryname.'/negaEmail'.$d1.'.txt','w+');      
                          }
                    //$file=fopen('../public/NegaImap/negaSubject'.$d1.'.txt','w+');
                    //$file1=fopen('../public/NegaImap/negaEmail'.$d1.'.txt','w+');
                    foreach($emails as $email_number) {
                        set_time_limit(0);
                        $overview = imap_fetch_overview($inbox,$email_number,0);
                        $headerInfo = imap_headerinfo($inbox,$email_number);
                        /* get information specific to this email */
                        if (isset($overview[0]->subject)){
                        
                        $from[]=isset($headerInfo->from[0]->personal) ? $headerInfo->from[0]->personal : '';
                        $subject[]=$overview[0]->subject;
                        $fromAdd[]=$headerInfo->from[0]->mailbox ."@". $headerInfo->from[0]->host;
                        fwrite($file1,$fromAdd[]=$headerInfo->from[0]->mailbox ."@". $headerInfo->from[0]->host."\r\n");
                        fwrite($file,$overview[0]->subject."\r\n");
                        }
                    }
                    fclose($file);  
                } 
    
                /* close the connection */
                imap_close($inbox);

            break;
            case 'hotmail':
                if($folder==="INBOX") $f="INBOX";
                elseif($folder==="SPAM") $f="Junk";
                $hostname =  '{imap-mail.outlook.com:993/imap/ssl}'.$f;
                $inbox = imap_open($hostname,$username,$password) or die('Cannot connect to Gmail: ' . imap_last_error());

                /* grab emails */
                $emails = imap_search($inbox,'ALL');
    
                /* if emails are returned, cycle through each... */
                if($emails) {
                    rsort($emails);
                    $d=getdate();
                    $d1=implode($d);

                    // Vérifie si le répertoire existe :
                        if (is_dir('../public/NegaImap/'.$Directoryname)) {
                            $file=fopen('../public/NegaImap/'.$Directoryname.'/negaSubject'.$d1.'.txt','w+');
                            $file1=fopen('../public/NegaImap/'.$Directoryname.'/negaEmail'.$d1.'.txt','w+');
                                          }
                        // Création du nouveau répertoire
                        else { 
                              mkdir('../public/NegaImap/'.$Directoryname);
                              $file=fopen('../public/NegaImap/'.$Directoryname.'/negaSubject'.$d1.'.txt','w+');
                              $file1=fopen('../public/NegaImap/'.$Directoryname.'/negaEmail'.$d1.'.txt','w+');      
                              }
                    /* for every email... */
                 
                    foreach($emails as $email_number) {
                        set_time_limit(0);
                        $overview = imap_fetch_overview($inbox,$email_number,0);
                        $headerInfo = imap_headerinfo($inbox,$email_number);
                        /* get information specific to this email */
                        if (isset($overview[0]->subject)){
                       
                       // $message = imap_fetchbody($inbox,$email_number,2);
                        $from[]=isset($headerInfo->from[0]->personal) ? $headerInfo->from[0]->personal : '';
                        $subject[]=$overview[0]->subject;
                        $fromAdd[]=$headerInfo->from[0]->mailbox ."@". $headerInfo->from[0]->host;
                        fwrite($file1,$fromAdd[]=$headerInfo->from[0]->mailbox ."@". $headerInfo->from[0]->host."\r\n");
                        fwrite($file,$overview[0]->subject."\r\n");
                        }
                    }
                    fclose($file);
                    
                } 
                /* close the connection */
                imap_close($inbox);

            break;
        }
        
        $c=count($from);
        
        $pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];

        return view('pages.imaps.getimap', ['pageConfigs' => $pageConfigs] ,
        compact('c','from','subject','fromAdd','isps','isp','username','password','folder'));

        
        
    }
}
