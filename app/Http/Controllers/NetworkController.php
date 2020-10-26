<?php

namespace App\Http\Controllers;
use DB;
use App\Networks;
use Illuminate\Http\Request;
use App\Logonetworks;
use App\Plateformsponsor;
use App\File;
use Ixudra\Curl\Facades\Curl;

class NetworkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
   function __construct()
    {
		 $this->middleware('permission:network-list|network-create|network-edit|network-show|network-delete', ['only' => ['index','show']]);
         $this->middleware('permission:network-create', ['only' => ['create','store']]);
         $this->middleware('permission:network-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:network-delete', ['only' => ['delete']]);
		 $this->middleware('permission:network-show', ['only' => ['show']]);
    }
   
   public function index()
    {
       
	   $data = Networks::all();
	   $plateforms = DB::table('plateformsponsor')
			   ->select('plateformsponsor.*')
			   ->get();
		$logonetworks = DB::table('logonetworks')
			   ->select('logonetworks.*')
			   ->get();
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];	
        return view('pages.networks.index', ['pageConfigs' => $pageConfigs],compact('data','logonetworks','plateforms'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  
	    $plateform = DB::table('plateformsponsor')
			   ->select('plateformsponsor.*')
			   ->get();
		
	    $pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
		return view('pages.networks.create', ['pageConfigs' => $pageConfigs],compact('plateform'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
 
	
	  public function store(Request $request) {		  
		$network = new Networks(); 
		$network->login = $request['login'];
		$network->name = $request['name'];
		$network->password = $request['password'];
		$network->URLSignIn = $request['URLSignIn'];
		$network->AffiliateID = $request['AffiliateID'];
		$network->APIAccessKey = $request['APIAccessKey'];
		$network->APIHostURL = $request['APIHostURL'];
		$network->logo = $request['image'];
		$network->plateform_id = $request['plateform_id'];
		$network->type = $request['type'];
		$network->token = $request['token'];
		$network->save();
		
		$id = $network->id;
		$request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

			$image = new Logonetworks;			
			$file = $request->file('image');
          
                $name = time().'.'.$request->image->extension(); 
				
                $path = $file->storeAs('images/networks', $name, 'public');
				// $file= Storage::disk('images/networks')->put($name, file_get_contents($file));
				$file->move(public_path($path), $name);
				$image->name = $name;
				$image->path = $path;
				$image->network_id = $id;
				$image->save();

		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('networks.index', ['pageConfigs' => $pageConfigs]);

    }
	
	
	
    /**
     * Display the specified resource.
     *
     * @param  \App\Network  $network
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $networks = DB::table('networks')
	   ->join('plateformsponsor','plateformsponsor.id','=','networks.plateform_id')
	   ->join('logonetworks','networks.id','=','logonetworks.network_id')
       ->select('networks.*','plateformsponsor.name as namePl','logonetworks.name as namelogo','logonetworks.path')
       ->get();
		$plateforms = DB::table('plateformsponsor')
			   ->select('plateformsponsor.*')
			   ->get();
		$logonetworks = DB::table('logonetworks')
			   ->select('logonetworks.*')
			   ->where('logonetworks.network_id', '=' , $id)
			   ->get();
		$networks = Networks::findOrFail($id);
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
		return view('pages.networks.show', ['pageConfigs' => $pageConfigs] ,compact('plateforms','networks','logonetworks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Network  $network
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
	$data = DB::table('networks')
	   ->join('plateformsponsor','plateformsponsor.id','=','networks.plateform_id')
	   ->join('logonetworks','logonetworks.network_id','=','networks.id')
       ->select('plateformsponsor.name as namePl','plateformsponsor.id as idPl','logonetworks.name as nameLog','logonetworks.id as idLog')
	   ->where('networks.id', '=' , $id)
       ->get();
		$plateforms = DB::table('plateformsponsor')
			   ->select('plateformsponsor.*')
			   ->get();
		$logonetworks = DB::table('logonetworks')
			   ->select('logonetworks.*')
			   ->where('logonetworks.network_id', '=' , $id)
			   ->get();
		$networks = Networks::findOrFail($id);
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
		return view('pages.networks.edit', ['pageConfigs' => $pageConfigs] ,compact('plateforms','data','networks','logonetworks'));  

		}


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Network  $network
     * @return \Illuminate\Http\Response
     */			
						
	  public function update(Request $request, $id) {

        $networks = Networks::where('id', '=', $id)->first();
		$networks->plateform_id = $request['plateform_id'];
        $networks ->update($request->all());
		
		$request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
					
			$file = $request->file('image');
			$image = Logonetworks::where('network_id', '=', $id )->first();
			$image->fill($request->all());	
            $name = time().'.'.$request->image->extension(); 				
            $path = $file->storeAs('images/networks', $name, 'public');
				// $file= Storage::disk('images/networks')->put($name, file_get_contents($file));
			$file->move(public_path($path), $name);
			$image->name = $name;
			$image->path = $path;
			$image->network_id = $id;
			$image->save();
		
        $pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('networks.index', ['pageConfigs' => $pageConfigs])
                        ->with('success','Network updated successfully'); 
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Network  $network
     * @return \Illuminate\Http\Response
     */

	  public function delete($id) {

        $network = Networks::findOrFail($id);
        $network->delete();
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('networks.index', ['pageConfigs' => $pageConfigs]);

    }
	   public function goNetwork($id){
		 $networks = DB::table('networks')
        ->join('plateformsponsor','plateformsponsor.id','=','networks.plateform_id')
        ->select('networks.*','plateformsponsor.name as namePl')
        ->where('networks.id', $id)->first();
        $netName=$networks->name;
        $username=$networks->login;
        $password=$networks->password;
		$api_key=$networks->APIAccessKey;
		$affiliate_id=$networks->AffiliateID;
		$APIHostURL=$networks->APIHostURL;
		$token=$networks->token;
		$timeout = 10;		
        $path_cookie = 'connexion_megaupload_temporaire.txt';
		if (!file_exists(realpath($path_cookie))) touch($path_cookie);  

        $url=$networks->URLSignIn;
		$headers = array();
		$headers[] = 'Accept: application/json, text/javascript, */*; q=0.01'; 
		$headers[] = 'Accept-Language: en-US,en;q=0.5';
		$headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=utf-8';
		$headers[] = 'X-Requested-With: XMLHttpRequest';
		$headers[] = 'cache-control: no-cache';
		$headers[] = 'ccess-control-allow-credentials: true';
		$headers[] = 'x-powered-by: ASP.NET';
		$headers[] = 'x-aspnet-version: 4.0.30319';
		$headers[] = 'pragma: no-cache';
		$headers[] = 'access-control-allow-headers: Origin, X-Requested-With, Content-Type, Accept';
		$headers[] = 'access-control-allow-methods: POST,GET,OPTIONS,PUT,DELETE';
		$headers[] = 'access-control-max-age: 1728000';
		$headers[] = 'cache-control: no-cache';
		$headers[] = 'connection: close';


		if ($networks->token =='Null'){
			//$post = "username=$username&password=$password&api_key=$api_key&affiliate_id=$affiliate_id";
			// $postdata="tp=1";
			$postdata = "&u=$username";
			$postdata .= "&p=$password";
			$postdata .= "&api_key=$api_key";
			$postdata .= "&affiliate_id=$affiliate_id";	
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);                                    
			// curl_setopt($ch, CURLOPT_HTTPGET, 1);
			curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
			curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
			curl_setopt($ch, CURLOPT_COOKIEFILE, realpath($path_cookie)); 
			curl_setopt($ch, CURLOPT_COOKIEJAR, realpath($path_cookie));
			if (preg_match('`^https://`i', $url))
			{
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			}
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$result = curl_exec($ch);
			curl_close ($ch);
			// echo $result;
			die($result);
			// die(header("Location: $APIHostURL"));	
		}
		 
		else{
			$postdata = "&email=$username";
			$postdata .= "&p=$password";
			$postdata .= "&api_key=$api_key";
			$postdata .= "&affiliate_id=$affiliate_id"; 
			$postdata .= "&token=$token"; 
			$postdata .= "&portal=affiliate"; 
					
			$ch = curl_init($url);
			// Set the request type to POST
			curl_setopt($ch, CURLOPT_POST, true);
			// Pass the post parameters as a naked string
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);                                    
			// Option to Return the Result, rather than just true/false
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_COOKIEFILE, realpath($path_cookie)); 
			curl_setopt($ch, CURLOPT_COOKIEJAR, realpath($path_cookie));
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $token ));
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_TIMEOUT, 5);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
			 curl_setopt($ch, CURLOPT_REFERER, $APIHostURL);
			$result = curl_exec($ch);		
			curl_close($ch);
			print_r($result); 

		}
		
    } 
	public function goNetworkOffre($id){
		 $networks = DB::table('networks')
        ->join('plateformsponsor','plateformsponsor.id','=','networks.plateform_id')
        ->select('networks.*','plateformsponsor.name as namePl')
        ->where('networks.id', $id)->first();
		$api_key=$networks->APIAccessKey;
		$affiliate_id=$networks->AffiliateID;
		$urloffre=$networks->urlOffre;
        $path_cookie = 'connexion_megaupload_temporaire.txt';
		if (!file_exists(realpath($path_cookie))) touch($path_cookie);        
		$post = "api_key=$api_key";
		$post .= "&affiliate_id=$affiliate_id";   
		$data = "$urloffre$post";
		
		$headers = array();
		$headers[] = 'Accept: application/json, text/javascript, */*; q=0.01'; 
		$headers[] = 'Accept-Language: en-US,en;q=0.5';
		//$headers[] = 'Content-Length:'.strlen($post);
		$headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=utf-8';
		$headers[] = 'X-Requested-With: XMLHttpRequest';
		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => "$data",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_HTTPHEADER => $headers,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => array(
			"cache-control: no-cache"
		),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		echo $response;			
    }
	public function Offrenetwork($id){
		 $networks = DB::table('networks')
        ->join('plateformsponsor','plateformsponsor.id','=','networks.plateform_id')
        ->select('networks.*','plateformsponsor.name as namePl')
        ->where('networks.id', $id)->first();
        $netName=$networks->name;
        $username=$networks->login;
        $password=$networks->password;
		$api_key=$networks->APIAccessKey;
		$affiliate_id=$networks->AffiliateID;
		$APIHostURL=$networks->APIHostURL;
		$token=$networks->token;	
		$urloffre=$networks->urlOffre;
        $path_cookie = 'connexion_megaupload_temporaire.txt';
		if (!file_exists(realpath($path_cookie))) touch($path_cookie);        
		$post = "api_key=$api_key";
		$post .= "&affiliate_id=$affiliate_id";   
		$data = "$urloffre$post";
		
		$headers = array();
		$headers[] = 'Accept: application/json, text/javascript, */*; q=0.01'; 
		$headers[] = 'Accept-Language: en-US,en;q=0.5';
		//$headers[] = 'Content-Length:'.strlen($post);
		$headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=utf-8';
		$headers[] = 'X-Requested-With: XMLHttpRequest';
		$ch = curl_init($data);                                
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');                                    
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_TIMEOUT, 5);
		curl_setopt($ch, CURLOPT_POST, 1);
		// curl_setopt($ch, CURLOPT_POSTFIELDS, "$u=".$username."&p=".$password."");
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
		curl_setopt($ch,CURLOPT_HEADER,0);
        $result = curl_exec($ch);
        $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);                                    
        curl_close($ch);
        // echo $result;
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
		return view('pages.networks.Offrenetwork', ['pageConfigs' => $pageConfigs] ,compact('networks')); 		
    } 
	public function getCURL()
    {
        $response = Curl::to('https://b2directpartners.com/login.ashx?tp=1&api_key=Oy7vrVykyoIV0x0xWXzxxw&affiliate_id=701080&username=contact@alphaemarketing.com&password=Cokin74$$ZS0')
                            ->get();
        dd($response);
    }
}
