<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Response;
Use \Carbon\Carbon;
use App\Drops;
use App\Offres;
use App\Networks;
use App\Countrys;
use App\Headers;
use App\Bodys;
use App\Isps;
use App\Listesends;
use App\Servers;
use App\Datas;
use App\Sips;
use App\File;
class DropController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
	  public function __construct()
    {
        $this->middleware('auth');
    }
   public function index()
    {
        $data = Drops::all();
	    $networks = Networks::all();
		$headers = Headers::all();
		$bodys = Bodys::all();
		$isps = Isps::all();	
        $country = Countrys::all();
        $offres = Offres::all();
        $listesends = DB::table('drops_has_liste')
			   ->select('drops_has_liste.*')
               ->get();
		$sips = DB::table('drops_has_sips')
			   ->select('drops_has_sips.*')
               ->get();
        $dat="Today";
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];	
        return view('pages.drops.index', ['pageConfigs' => $pageConfigs],compact('data','sips','listesends','dat','offres','isps', 'country','headers','networks','bodys'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function testSlect()
    {   

	    $pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
		return view('pages.drops.testSlect', ['pageConfigs' => $pageConfigs]);
    } 
	public function create()
    {   
		 $networks = Networks::all();
		 $headers = Headers::all();
		 $bodys = Bodys::all();
		// $networks = DB::table('networks')->pluck("name","id");
		$isp = Isps::all();
        $country = Countrys::all();
		$servers = Servers::all();
	    $pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
		return view('pages.drops.create', ['pageConfigs' => $pageConfigs, 
        'isp' => $isp, 'country' => $country,'headers' => $headers,'networks' => $networks,'bodys' => $bodys,'servers' => $servers]);
    }
	public function offres(Request $request){
        $network_id = $request->input('network_id');
        $offres = Offres::where('network_id', '=', $network_id)->get();
        return response()->json($offres);
    }
	
	public function listesends(Request $request){
        $country_id = $request->input('country_id');
        $listesends = Listesends::where('country_id', '=', $country_id)->get();
        return response()->json($listesends);
    }
	public function ips(Request $request){
        $ids = $request->input('server_id');
		$server_id =explode(",", $ids);
		 $ips = DB::table('sips')
                    ->whereIn('server_id', $server_id)
                    ->get();
        // $ips = Sips::where('server_id', '=', $server_id)->get();
		
        return response()->json($ips);
    }
	public function datas(Request $request){
        $id_List_Email = $request->input('id_List_Email');
        $datas = Datas::where('id_List_Email', '=', $id_List_Email)->get();
        return response()->json($datas);
    }

    public function files(Request $request){
        $offres_id = $request->input('offre_id');
        $files = File::where('offre_id', '=', $offres_id)->get();
        return response()->json($files);
    } 
	
	public function headers(Request $request){
        $header_id = $request->input('header_id');
        $headers = Headers::where('id', '=', $header_id)->get();
        return response()->json($headers);
    }
	public function bodys(Request $request){
        $body_id = $request->input('body_id');
        $bodys = Bodys::where('id', '=', $body_id)->get();
        return response()->json($bodys);
    }

    public function test()
    {   
	    $networks = Networks::all();
		 $headers = Headers::all();
		 $bodys = Bodys::all();
		// $networks = DB::table('networks')->pluck("name","id");
		$isp = Isps::all();
        $country = Countrys::all();
		$servers = Servers::all();
       // $datas = Datas::whereIn('id_List_Email', [14, 12])->get(); 
	    $pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
		return view('pages.drops.test', ['pageConfigs' => $pageConfigs, 
        'isp' => $isp, 'country' => $country,'headers' => $headers,'networks' => $networks,'bodys' => $bodys,'servers' => $servers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
 
	
	  public function store(Request $request) {		  
		$drops = new Drops();
		$drops->network_id = $request['network_id'];
		$drops->offre_id = $request['offre_id'];
		$drops->id_isps = $request['id_isps'];
        $drops->country_id = $request['country_id'];
        $drops->data_id = $request['data_id'];
        $drops->body_id = $request['body_id'];
        $drops->header_id = $request['header_id'];
        $drops->file_id = $request['idCreative'];
		$drops->save();
		$id= $drops->id;			
		$drops->listesends()->sync($request->get('listesends_id'));
		$drops->servers()->sync($request->get('server_id'));
		$drops->sips()->sync($request->get('ip_id'));
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('drops.index', ['pageConfigs' => $pageConfigs]);			
    }
	
	
	
    /**
     * Display the specified resource.
     *
     * @param  \App\Drops  $drops
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $dat=$request['created_at'];
       
        if($request['created_at']=="Today"){
        $data = DB::table('drops')
        ->join('offres','offres.id','=','drops.offre_id')   
        ->join('isps','isps.id','=','drops.id_isps')
        ->join('listecontact','listecontact.id','=','drops.liste_id')
        ->select('drops.*','drops.id as id','isps.id as idIsp','offres.name as nameOff','isps.name as nameIsp','listecontact.name as nameList')//,)
        ->whereDate('drops.created_at', Carbon::today())
        //->select('drops.*')
        ->get();
        }elseif($request['created_at']=="Yesterday"){
            $data = DB::table('drops')
            ->join('offres','offres.id','=','drops.offre_id')   
            ->join('isps','isps.id','=','drops.id_isps')
            ->join('listecontact','listecontact.id','=','drops.liste_id')
            ->select('drops.*','drops.id as id','isps.id as idIsp','offres.name as nameOff','isps.name as nameIsp','listecontact.name as nameList')//,)
            ->where( 'drops.created_at', '>=', date('Y-m-d',strtotime("-1 days")))
            //->select('drops.*')
            ->get();

        }elseif($request['created_at']=="Last7Days"){
            $data = DB::table('drops')
            ->join('offres','offres.id','=','drops.offre_id')   
            ->join('isps','isps.id','=','drops.id_isps')
            ->join('listecontact','listecontact.id','=','drops.liste_id')
            ->select('drops.*','drops.id as id','isps.id as idIsp','offres.name as nameOff','isps.name as nameIsp','listecontact.name as nameList')//,)
            ->where( 'drops.created_at', '>=', Carbon::now()->subDays(7))
            //->select('drops.*')
            ->get();

        }elseif($request['created_at']=="Last30Days"){
            $data = DB::table('drops')
            ->join('offres','offres.id','=','drops.offre_id')   
            ->join('isps','isps.id','=','drops.id_isps')
            ->join('listecontact','listecontact.id','=','drops.liste_id')
            ->select('drops.*','drops.id as id','isps.id as idIsp','offres.name as nameOff','isps.name as nameIsp','listecontact.name as nameList')//,)
            ->where( 'drops.created_at', '>=', Carbon::now()->subDays(30))
            //->select('drops.*')
            ->get();

        }elseif($request['created_at']=="LastMonth"){
            $data = DB::table('drops')
            ->join('offres','offres.id','=','drops.offre_id')   
            ->join('isps','isps.id','=','drops.id_isps')
            ->join('listecontact','listecontact.id','=','drops.liste_id')
            ->select('drops.*','drops.id as id','isps.id as idIsp','offres.name as nameOff','isps.name as nameIsp','listecontact.name as nameList')//,)
            ->whereMonth('drops.created_at', '=', Carbon::now()->subMonth()->month)
            //->select('drops.*')
            ->get();

        }
         $pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];	
         return view('pages.drops.index', ['pageConfigs' => $pageConfigs],compact('data','dat'))
             ->with('i', (request()->input('page', 1) - 1) * 10);

           
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Drops  $drops
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {	  			   
		$networks = Networks::all();
		$files = File::all();
		$headers = Headers::all();
		$bodys = Bodys::all();
		$isps = Isps::all();	
        $country = Countrys::all();
        $offres = Offres::all();
		$servers = Servers::all();		
		$sips = DB::table('drops_has_sips')
			   ->select('drops_has_sips.*')
               ->get();
		$drop = Drops::findOrFail($id);;
		//$drop->load('servers');
		
		$drops = Drops::findOrFail($id);
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
		return view('pages.drops.edit', ['pageConfigs' => $pageConfigs] ,compact('files','drops','drop','sips','servers','networks','offres','isps','country','bodys','headers'));  

		}


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request 
     * @param  \App\Drops  $drops
     * @return \Illuminate\Http\Response
     */			
        public function ShowSend(){

            $pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
		return view('pages.drops.ShowSend', ['pageConfigs' => $pageConfigs] );  


        }
     
						
	  public function update(Request $request, $id) {

        $drop = Drops::where('id', '=', $id)->first();
		$drop->file_id = $request['file_id'];
        $drop ->update($request->all());
		$drop->listesends()->sync($request->get('listesends_id'));
		$drop->sips()->sync($request->get('ip_id'));
		$drop->servers()->sync($request->get('server_id'));
        $pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('drops.index', ['pageConfigs' => $pageConfigs])
                        ->with('success','drop updated successfully'); 
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Drops  $drop
     * @return \Illuminate\Http\Response
     */

	  public function delete($id) {

        $drop = Drops::findOrFail($id);
        $drop->delete();
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('pages.drops.index', ['pageConfigs' => $pageConfigs]);

    }

}
