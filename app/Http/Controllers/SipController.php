<?php

namespace App\Http\Controllers;
use DB;
use App\Sips;
use App\Servers;
use Illuminate\Http\Request;

class SipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	  function __construct()
    {
		 // $this->middleware('permission:sip-list|sip-create|sip-edit|sip-show|sip-delete', ['only' => ['index','show']]);
         // $this->middleware('permission:sip-create', ['only' => ['create','store']]);
         // $this->middleware('permission:sip-edit', ['only' => ['edit','update']]);
         // $this->middleware('permission:sip-delete', ['only' => ['delete']]);
		 // $this->middleware('permission:sip-show', ['only' => ['show']]);
    }
   public function index()
    {
        $data = Sips::all();
		$domains = DB::table('domains')
			   ->select('domains.*')
			   ->get();	 
		$servers = DB::table('servers')
			   ->select('servers.*')
			   ->get();
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];	
        return view('pages.sips.index', ['pageConfigs' => $pageConfigs],compact('servers','data','domains'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $domains = DB::table('domains')
			   ->select('domains.*')
			   ->get();
		$servers = DB::table('servers')
			   ->select('servers.*')
			   ->get();
	   $pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
		return view('pages.sips.create', ['pageConfigs' => $pageConfigs],compact('servers','domains'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
 
	
	  public function store(Request $request) {

        $sip = new Sips(); 
		$sip->id_domain = $request['id_domain'];
		$sip->server_id = $request['server_id'];
		$sip->IP = $request['IP'];
		$sip->random = $request['random'];
		$sip->save();
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('sips.index', ['pageConfigs' => $pageConfigs]);

    }
	
	
	
    /**
     * Display the specified resource.
     *
     * @param  \App\Sips  $sip
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = DB::table('sips')
			 ->join('domains','domains.id','=','sips.id_domain')
			 ->join('servers','servers.id','=','sips.server_id')
			 ->select('sips.*','servers.ip','servers.id as idSer','domains.name as idDom','domains.name as NameDom')
			 ->get();
		$domains = DB::table('domains')
			   ->select('domains.*')
			   ->get();
		$servers = DB::table('servers')
			   ->select('servers.*')
			   ->get();
		$sip = Sips::findOrFail($id);
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
		return view('pages.sips.show', ['pageConfigs' => $pageConfigs] ,compact('sip','domains','data','servers'));    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sips  $sip
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$data = DB::table('sips')
			 ->join('domains','domains.id','=','sips.id_domain')
			 ->join('servers','servers.id','=','sips.server_id')
			 ->select('sips.*','servers.ip','servers.id as idSer','domains.name as idDom','domains.name as NameDom')
			 ->get();
		$domains = DB::table('domains')
			   ->select('domains.*')
			   ->get();
		$servers = DB::table('servers')
			   ->select('servers.*')
			   ->get();
		$sip = Sips::findOrFail($id);
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
		return view('pages.sips.edit', ['pageConfigs' => $pageConfigs] ,compact('sip','domains','data','servers'));    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sips  $sip
     * @return \Illuminate\Http\Response
     */			
						
	 public function update(Request $request, $id) {

        $sip = Sips::findOrFail($id);
        $sip->fill($request->all());
        $sip->save();

        $pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('sips.index', ['pageConfigs' => $pageConfigs])
                        ->with('success','sip updated successfully'); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sips  $sip
     * @return \Illuminate\Http\Response
     */
    // public function destroy(sip $sip)
    // {
    // $sip->delete();
		// $pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        // return redirect()->route('pages.sips.index', ['pageConfigs' => $pageConfigs])
                        // ->with('success','sips deleted successfully');  
    // }
	  public function delete($id) {

        $sip = Sips::findOrFail($id);
        $sip->delete();
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('sips.index', ['pageConfigs' => $pageConfigs]);

    }
	public function AddDomain($id)
    {
		
		$data = DB::table('sips')
			 ->join('domains','domains.id','=','sips.id_domain')
			 ->join('servers','servers.id','=','sips.server_id')
			 ->select('sips.*','servers.ip','servers.id as idSer','domains.name as idDom','domains.name as NameDom')
			 ->get();
		$domains = DB::table('domains')
			   ->select('domains.*')
			   ->get();
		$servers = DB::table('servers')
			   ->select('servers.*')
			   ->get();
			   
		$sip = Sips::findOrFail($id);
		$ip = $sip['IP'];	   
		$server_id = $sip['server_id'];	   
      		
		$server = Servers::findOrFail($server_id);	
		
		$password = $server['password'];
		$userName = $server['userName'];
		$sshPort = $server['sshPort'];
		$domain_id = $sip['domain_id'];
		
	 
		$connection = ssh2_connect($ip , $sshPort);
	
		if($connection)
		{
							
          
        if (ssh2_auth_password($connection, $userName, $password)) 
	        {
   	
	    
		
		 app('App\Console\Commands\SipCmd')->handle($id);
		 
		  
        $res="ok";
		echo $res;
		
	    
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
		return view('pages.sips.AddDomain', ['pageConfigs' => $pageConfigs] ,compact('sip','domains','data','servers'));    
		
            } 
	    }
		    else{
				//$res="Echec..";
				
				die('Echec de l\'identification...');
				
                }
		
	
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
		return view('pages.sips.show', ['pageConfigs' => $pageConfigs] ,compact('sip','domains','data','servers'));     
		
    }	
}
