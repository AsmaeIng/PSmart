<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Artisan;
use DB;
use App\Servers;
use App\Sips;
use App\Domains;
use App\Console\Commands;
use Illuminate\Http\Request;

class ServerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
	function __construct()
    {
		 $this->middleware('permission:server-list|server-create|server-edit|server-show|server-delete', ['only' => ['index','show']]);
         $this->middleware('permission:server-create', ['only' => ['create','store']]);
         $this->middleware('permission:server-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:server-delete', ['only' => ['delete']]);
		 $this->middleware('permission:server-show', ['only' => ['show']]);
		 $this->middleware('permission:server-createAuto', ['only' => ['createAuto']]);
    }
   public function index()
    {
        $data = Servers::latest()->paginate(10);
	    $domains = DB::table('domains')
			   ->select('domains.*')
			   ->get();
		$providers = DB::table('providers')
			   ->select('providers.*')
			   ->get();
		$operatingsystems = DB::table('operatingsystems')
			   ->select('operatingsystems.*')
			   ->get();	   	   
	   // $data = DB::table('servers')
			   // ->join('operatingsystems','operatingsystems.id','=','servers.OS_id')
			   // ->join('domains','domains.id','=','servers.domain_id')
			   // ->join('providers','providers.id','=','servers.provider_id') 
			   // ->select('servers.*','providers.name as namePr','domains.name as nameDom','operatingsystems.name as nameOS')
			   // ->get();
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];	
        return view('pages.servers.index', ['pageConfigs' => $pageConfigs],compact('data','operatingsystems','providers','domains'))
            ->with('i', (request()->input('page', 1) - 1) * 10);			
    }  
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
	    $provider = DB::table('providers')
			   ->select('providers.*')
			   ->get();
		$operatingsystems = DB::table('operatingsystems')
			   ->select('operatingsystems.*')
			   ->get();
		$domains = DB::table('domains')
			   ->select('domains.*')
			   ->get();
		$isps = DB::table('isps')
			   ->select('isps.*')
			   ->get();
		$mailers = DB::table('mailers')
			   ->select('mailers.*')
			   ->get();
		
		$lastOne = DB::table('servers')->latest('id')->first();
	    $pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
		return view('pages.servers.create', ['pageConfigs' => $pageConfigs],compact('lastOne','provider','operatingsystems','domains','isps','mailers'));
    }
	
public function createAuto($id)
    {
			
		$res =null;
		//$server = Servers::all(); 
	    $domains = DB::table('domains')
			   ->select('domains.*')
			   ->get();
		$providers = DB::table('providers')
			   ->select('providers.*')
			   ->get();
		$operatingsystems = DB::table('operatingsystems')
			   ->select('operatingsystems.*')
			   ->get();	
		$isps = DB::table('isps')
			   ->select('isps.*')
			   ->get();
		$sips = Sips::where('server_id', '=', $id)->get();

		$mailers = DB::table('mailers')
			   ->select('mailers.*')
			   ->get();
		$lastOne = DB::table('servers')->latest('id')->first();
		$server = Servers::findOrFail($id);
		
		$ip = $server['ip'];
		$password = $server['password'];
		$userName = $server['userName'];
		$sshPort = $server['sshPort'];
		$domain_id = $server['domain_id'];
		$domain = domains::findOrFail($domain_id);

	
		$connection = ssh2_connect($ip, $sshPort);
		if($connection)
		{
			 				
          
        if (ssh2_auth_password($connection, $userName, $password)) 
	        {
   	
	    
		
		 app('App\Console\Commands\ListCommande')->handle($id);
		 
		  
        $res="ok";
		echo $res;
		 
	    $pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
		
		return view('pages.servers.createAuto', ['pageConfigs' => $pageConfigs] ,compact('lastOne','providers','server','operatingsystems','domains','sips','isps','mailers'));  
            } 
	    }
		    else{
				//$res="Echec..";
				
				die('Echec de l\'identification...');
				
                }
		
		
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
 public function store(Request $request) {		  
		$servers = new Servers();
		$servers->alias = $request['alias'];
		$servers->userName = $request['userName'];
		$servers->password = $request['password'];
		$servers->saleDate = $request['saleDate'];
		$servers->expirationDate = $request['expirationDate'];
		$servers->sshPort = $request['sshPort'];
		$servers->price = $request['price'];
		$servers->active = $request['active'];
		$servers->ip = $request['ip'];
		// $servers->ips = $request['ips'];
		//$servers->domain_id = $request['domain_id'];
		$servers->domain_id = 1;
		$servers->OS_id = $request['OS_id'];
		$servers->provider_id = $request['provider_id'];
		$servers->user_providers = $request['user_providers'];
		$servers->password_providers = $request['password_providers'];
		$servers->NIP = $request['NIP'];
		$servers->panel = $request['panel'];
		$servers->random = $request['random'];
		$servers->typeSpamInbox = $request['typeSpamInbox']; 		
		$isps = $servers['isps'];
		$ips = $servers['ips'];
		$mailers = $servers['mailers'];
		if ($request->isps !='') {
			$servers['isps'] = implode(' , ', $request->isps);
		}
		if ($request->ips !='') {
			$servers['ips'] = implode(' , ', $request->ips);
		}
		if ($request->mailers !='') {
			$servers['mailers'] = implode(' , ', $request->mailers);
		}     
        //Servers::create($servers);		
		$servers->save();
		$id = $servers->id;		
		$new = new Sips(); 			
		//$new->id_domain = $request['domain_id'];
		$new->id_domain = 1;
		$new->IP = $request['ip'];
		$new->server_id = $id;
		$new->save();
		 $request->validate([
          'listeIp' => 'required',
        ]);

            $fichier = $request->file('listeIp');
            $name = $fichier->getClientOriginalName();				
            $path = $fichier->storeAs('ip', $name, 'public');
			$fichier->move(public_path($path), $name);
			$file = fopen("$path/$name", "r") or exit("Unable to open file!");
			while($line = fgets($file))
				{		
						//$text=str_replace(' ','',$line);
						$text=trim($line,"\n");
						$text=trim($text,"\r");
						if(is_string($text) && $text !== ''&& $text !== '/n'&& $text !== ' '){
						$datas = new Sips();
						$datas->id_domain =	1;					
						$datas->IP = $text;
						$datas->server_id = $id;
						$datas->save();
						}

				}
			fclose($file);
		
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('servers.index', ['pageConfigs' => $pageConfigs]);

    }
	
	
	
	
    /**
     * Display the specified resource.
     *
     * @param  \App\Servers  $servers
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        {
			
		$servers = Servers::all();
	    $domains = DB::table('domains')
			   ->select('domains.*')
			   ->get();
		$providers = DB::table('providers')
			   ->select('providers.*')
			   ->get();
		$operatingsystems = DB::table('operatingsystems')
			   ->select('operatingsystems.*')
			   ->get();	
		$isps = DB::table('isps')
			   ->select('isps.*')
			   ->get();
		/*$sips = DB::table('sips')
			   ->select('sips.*')
			   ->get();*/
	    $sips = Sips::where('server_id', '=', $id)->get();
		$mailers = DB::table('mailers')
			   ->select('mailers.*')
			   ->get();
		$servers = Servers::findOrFail($id);
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
		return view('pages.servers.show', ['pageConfigs' => $pageConfigs] ,compact('providers','servers','operatingsystems','domains','sips','isps','mailers'));  

			
    }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Servers  $servers
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$servers = Servers::all();
	    $domains = DB::table('domains')
			   ->select('domains.*')
			   ->get();
		$providers = DB::table('providers')
			   ->select('providers.*')
			   ->get();
		$operatingsystems = DB::table('operatingsystems')
			   ->select('operatingsystems.*')
			   ->get();	
		$isps = DB::table('isps')
			   ->select('isps.*')
			   ->get();
		$sips = Sips::where('server_id', '=', $id)->get();	   
		/*$sips = DB::table('sips')
			   ->select('sips.*')
			   ->get();*/
		$mailers = DB::table('mailers')
			   ->select('mailers.*')
			   ->get();
		$servers = Servers::findOrFail($id);
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
		return view('pages.servers.edit', ['pageConfigs' => $pageConfigs] ,compact('providers','servers','operatingsystems','domains','sips','isps','mailers'));  

		}
	public function random()
    {
		
		return view('pages.servers.random');    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Servers  $Server
     * @return \Illuminate\Http\Response
     */			
						
	  public function update(Request $request, $id) {
		$compte = null;
		$servers = Servers::findOrFail($id);
        $servers->fill($request->all());
		$servers->active = $request['active'];
		$servers->password_providers = $request['password_providers'];
		$servers->user_providers = $request['user_providers'];
		$servers->userName = $request['userName'];
		$servers->password = $request['password'];
		$servers->random = $request['random'];
		$isps = $servers['isps'];
		$ips = $servers['sip'];
		$ip = $servers['ip'];
		$mailers = $servers['mailers'];
		if ($request->isps !='') {
			$servers['isps'] = implode(' , ', $request->isps);
		}
		if ($request->ips !='') {
			$servers['ips'] = implode(' , ', $request->sip);
		}
		if ($request->mailers !='') {
			$servers['mailers'] = implode(' , ', $request->mailers);
		}
        $sips = Sips::all();
		foreach($sips as $sip) {if($sip->server_id == $id) $compte +=1;}
		
		 ////
		foreach($sips as $sip) {
			 if($sip->IP == $ip) 
	       {	
					
			$sip->id_domain = $servers['domain_id'];
			$sip->random = $servers['random'];
			//$new->IP =  $request['ips'];
			$sip->server_id = $id;
			$sip->save();
			
		 }
		}
		$servers->NIP = $compte;
		$servers->save();
	/////Call to  cmd
		app('App\Console\Commands\ListCommande')->handle($id);
		/// 
        $pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('servers.index', ['pageConfigs' => $pageConfigs])
                        ->with('success','Server updated successfully'); 
	}
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Servers  $Server
     * @return \Illuminate\Http\Response
     */

	  public function delete($id) {

        $server = Servers::findOrFail($id);
        $server->delete();
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('servers.index', ['pageConfigs' => $pageConfigs]);

    }
}
