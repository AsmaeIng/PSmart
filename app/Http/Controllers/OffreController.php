<?php

namespace App\Http\Controllers;
use DB;
use App\Offres;
use Illuminate\Http\Request;
use App\File;
use App\Suppressions;
use Illuminate\Support\Facades\Http;
use ZipArchive;
class OffreController extends Controller
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
			
			$data = Offres::all();
			$countrys = DB::table('countrys')
			   ->select('countrys.*')
			   ->get();
			$networks = DB::table('networks')
			   ->select('networks.*')
			   ->get();
			$verticals = DB::table('verticals')
			   ->select('verticals.*')
			   ->get();
			// $data = DB::table('offres')
				 // ->join('countrys','countrys.id','=','offres.country_id')
				 // ->join('networks','networks.id','=','offres.network_id')
				 // ->join('verticals','verticals.id','=','offres.vertical_id')
				 // ->select('offres.*','networks.name as nameNet','countrys.name as NameCon','verticals.name as vertical')
				 // ->get();
			$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];	
			return view('pages.offres.index', ['pageConfigs' => $pageConfigs],compact('data','countrys','networks','verticals'))
				->with('i', (request()->input('page', 1) - 1) * 10);
		}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
	 
	public function loadContry($offresId) {
        $countrys = Offres::where('country_id', '=', $offresId)->get(['id', 'name']);

        return response()->json($countrys);
    }
    public function create()
    {
		$countrys = DB::table('countrys')
			   ->select('countrys.*')
			   ->get();
		$networks = DB::table('networks')
			   ->select('networks.*')
			   ->where('type', '=','on')
			   ->get();
		$verticals = DB::table('verticals')
			   ->select('verticals.*')
			   ->get();
	   $pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
		return view('pages.offres.create', ['pageConfigs' => $pageConfigs],compact('verticals','networks','countrys'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
 
	
	  public function store(Request $request) {  
		
		
		$offre = new Offres();
		$offre->country_id = $request['country_id'];
		$offre->network_id = $request['network_id'];
		$offre->osid = $request['osid'];
		$offre->name = $request['name'];
		$offre->vertical_id = $request['vertical_id'];
		$offre->froms = $request['froms'];
		$offre->subjects = $request['subjects'];
		$offre->active = $request['active'];
		$offre->sensitiv = $request['sensitiv'];
		$offre->olink = $request['olink'];
		$offre->unsub = $request['unsub'];
		$offre->downloadSuppression = $request['downloadSuppression'];
		$offre->Creative = $request['Creative'];
		$offre->Suppression = $request['Suppression'];
		$offre->DirectLink = $request['DirectLink'];
		$offre->isImage = $request['isImage'];
		$offre->TreatSuppression = $request['TreatSuppression'];
		$offre->TypeSuppression = $request['TypeSuppression'];
		$offre['notWorkingDays'] = implode(',', $request->input('notWorkingDays'));    
		$offre->save();
		$id = $offre->id;
		$request->validate([
          'files' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasfile('files')) {
            $files = $request->file('files');

            foreach($files as $file) {
                $name = time().'.'.$request->image->extension();				
                // $name = $file->getClientOriginalName();				
                $path = $file->storeAs('images/offres', $name, 'public');
				$file->move(public_path($path), $name);
                File::create([
                    'name' => $name,
					'offre_id' => $id,
                    'path' => $path
                  ]);
            }
         }
		 $request->validate([
          'suppressions' => 'required',
        ]);
		 if ($request->hasfile('suppressions')) {
            $suppressions = $request->file('suppressions');

            foreach($suppressions as $suppression) {
                $name = $suppression->getClientOriginalName();				
                $path = $suppression->storeAs('images/suppressions', $name, 'public');
				$suppression->move(public_path($path), $name);
                Suppressions::create([
                    'name' => $name,
					'offre_id' => $id,
                    'path' => $path
                  ]);
            }
         }
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('offres.index', ['pageConfigs' => $pageConfigs]);
		// return redirect()->route('files.indexfile', ['pageConfigs' => $pageConfigs]);

    }
	
	
	
    /**
     * Display the specified resource.
     *
     * @param  \App\Offres  $offre
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = DB::table('offres')
			 ->join('countrys','countrys.id','=','offres.country_id')
			 ->join('networks','networks.id','=','offres.network_id')
			 ->join('verticals','verticals.id','=','offres.vertical_id')
			 ->select('offres.*','networks.name as nameNet','countrys.name as NameCon','verticals.name as vertical','networks.id as idNet','countrys.name as idCon','verticals.id as idVer')
			 ->where('offres.id', '=' , $id)
			 ->get();
		$files = DB::table('files')
			   ->select('files.*')
			   ->where('files.offre_id', '=' , $id)
			   ->get();
		$suppressions = DB::table('suppressions')
			   ->select('suppressions.*')
			   ->where('suppressions.offre_id', '=' , $id)
			   ->get();
		$offre = Offres::findOrFail($id);
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
		return view('pages.offres.show', ['pageConfigs' => $pageConfigs] ,compact('data','files','suppressions'));    
    }  
	
	

	public function createImage()
    {

		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
		return view('pages.offres.createImage', ['pageConfigs' => $pageConfigs]);    
    }
	public function screet(Request $request)
    {

		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
		return view('pages.offres.screet', ['pageConfigs' => $pageConfigs]);    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Offres  $offre
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$data = DB::table('offres')
			 ->join('countrys','countrys.id','=','offres.country_id')
			 ->join('networks','networks.id','=','offres.network_id')
			 ->join('verticals','verticals.id','=','offres.vertical_id')
			 ->select('offres.*','networks.name as nameNet','countrys.name as NameCon','verticals.name as vertical','networks.id as idNet','countrys.name as idCon','verticals.id as idVer')
			 ->where('offres.id', '=' , $id)
			 ->get();
		$files = DB::table('files')
			   ->select('files.*')
			   ->where('files.offre_id', '=' , $id)
			   ->get();
		$countrys = DB::table('countrys')
			   ->select('countrys.*')
			   ->get();
		$networks = DB::table('networks')
			   ->select('networks.*')
			   ->where('type', '=','on')
			   ->get();
		$verticals = DB::table('verticals')
			   ->select('verticals.*')
			   ->get();
		$offre = Offres::findOrFail($id);
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
		return view('pages.offres.edit', ['pageConfigs' => $pageConfigs] ,compact('offre','countrys','data','verticals','networks','files'));    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Offres  $offre
     * @return \Illuminate\Http\Response
     */			
						
	 public function update(Request $request, $id) {
		
        $offre = Offres::findOrFail($id);
        $offre->fill($request->all());
		$offre->downloadSuppression = $request['downloadSuppression'];
		$notWorkingDays = $offre['notWorkingDays'];
		$offre['notWorkingDays'] = implode(',', $notWorkingDays); 
        $offre->save();
		$request->validate([
          'files' => 'required',
        ]);
		$images = DB::table('files')
			   ->select('files.*')
			   ->get();
		 
		 foreach($images as $image) {
		 if ($image->offre_id == $id)
		 {
			 $img = File::where('offre_id', '=', $image->offre_id )->first();
			 $img->fill($request->all());
			
			if ($request->hasfile('files')) {
				$files = $request->file('files');
			
             foreach($files as $file) {
                 $name = $file->getClientOriginalName();				
                 $path = $file->storeAs('images/offres', $name, 'public');				
				 $file->move(public_path($path), $name);			
				 $img->name = $name; 
				 $img->save();
            }
         }
       
         
		}
		else
			{
		 if ($request->hasfile('files')) {
            $files = $request->file('files');
			
            foreach($files as $file) {
                $name = $file->getClientOriginalName();				
                $path = $file->storeAs('images/offres', $name, 'public');
				$file->move(public_path($path), $name);
                File::create([
                    'name' => $name,
					'offre_id' => $id,
                    'path' => $path
                  ]);
            }
         }
         
		  }
		 }
		
        $pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('offres.index', ['pageConfigs' => $pageConfigs])
                        ->with('success','offre updated successfully'); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Offres  $offre
     * @return \Illuminate\Http\Response
     */
    // public function destroy(offre $offre)
    // {
    // $offre->delete();
		// $pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        // return redirect()->route('pages.offres.index', ['pageConfigs' => $pageConfigs])
                        // ->with('success','offres deleted successfully');  
    // }
	  public function delete($id) {

        $offre = Offres::findOrFail($id);
        $offre->delete();
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('offres.index', ['pageConfigs' => $pageConfigs]);

    }
	
	public function indexfile()
    {
	$files = DB::table('files')
			   ->select('files.*')
			   ->get();
	$data = DB::table('offres')
			 ->select('offres.*')
			 ->get();
      return view('pages.offres.files',compact('files','data'));
    }

    public function storefile (Request $request)
    {		
		$request->validate([
          'files' => 'required',
        ]);

        if ($request->hasfile('files')) {
            $files = $request->file('files');

            foreach($files as $file) {
                $name = $file->getClientOriginalName();				
                $path = $file->storeAs('images/offres', $name, 'public');
				$file->move(public_path($path), $name);
                File::create([
                    'name' => $name,
					'offre_id' => $request->offre_id,
                    'path' => $path
                  ]);
            }
         }		 
        return back()->with('success', 'Files uploaded successfully');
    }
public function getOfferByNetwork($id){		
		$offres = DB::table('offres')
			   ->select('offres.id','offres.name')
			   ->where('offres.network_id', '=' , $id)
			   ->get();	
		return json_encode($offres);
	}
	//get images by offer id
	public function getImage($id){
		$files = DB::table('files')
			   ->select('files.id','files.name','files.path')
			   ->where('files.offre_id', '=' , $id)
			   ->get();	
		return json_encode($files);
	}
	
	// suppression file download
	public function SuppFile($id){
        $offres = DB::table('offres') 
        ->join('networks','networks.id','=','offres.network_id')
        ->join('plateformsponsor','plateformsponsor.id','=','networks.plateform_id')
		->select('offres.*','offres.osid as offer_sid','networks.APIHostURL as api_url',
		'networks.APIAccessKey as api_key','networks.AffiliateID as affiliate_id',
		'plateformsponsor.id as sponsor_id','plateformsponsor.name as plateforme_name',)
        ->where('offres.id', $id)->first();
        $offer_id=$id;
        $sponsor_id=$offres->sponsor_id;
        $osid=(String)$offres->osid;
        $plateform_name=$offres->plateforme_name;
        $api_url=$offres->api_url;
        $api_key=$offres->api_key;
		$affiliate_id=$offres->affiliate_id;
		$API_FUNCTION		=	"getsuppression";
		$filePath=null;
		//	echo $sponsor_id.'--'.$osid.'--'.$plateform_name.'--'.$api_url.'--'.$api_key.'--'.$affiliate_id;
		if(isset($offer_id)){
			$fName=$this->fileName($sponsor_id,$offer_id,$osid);//public\images\suppressions
			//$fileName="../public/images/suppressions/".$fName."/".$fName."-MD5.txt";
			$dir="../public/images/suppressions/".$fName;
			$fileZipName="../public/images/suppressions/".$fName."/".$fName.".zip";			
			if (!file_exists($dir)) {				
				mkdir($dir);				  
			}
			else{
					//echo 'folder exist!!';					
				$a = scandir("../public/images/suppressions/".$fName);			
				for($i=0;$i<count($a);$i++){
					$file="../public/images/suppressions/".$fName."/".$a[$i];
					if(file_exists($file)&&(pathinfo($a[$i], PATHINFO_EXTENSION)==="txt"||pathinfo($a[$i], PATHINFO_EXTENSION)==="zip")){
						unlink($file);							
					}
				}
				DB::delete('delete from suppressions where offre_id=?', [$offer_id]);
			}				
			$zip = new ZipArchive();
			$zip->open($fileZipName, ZipArchive::CREATE);				
			switch($plateform_name){
				case "HitPath": 
					$dowload_url=$this->hithPathGetUrl($api_url,$api_key,$API_FUNCTION,$osid);
						//echo $output[0];
					if(strpos($dowload_url, "http") !== false){						
						$techno=$this->getUnsubLinkTechnology($dowload_url);
						//echo 'the techno'.$techno;							
						switch($techno){
							case "[MADRIVO]":									
								$filePath=$this->madrivoDownload($dowload_url,$fileZipName,$fName);//madrivoDownload($url,$fileZipName)
									//echo $dowload_url;
							break;
							case "[optismo]":
								$compagnAccessKey=$this->getCampaignAccessKeyFromSupressionFileUrl($dowload_url);
								$dowload_link=$this->getLinkSuppFileFromOptismo($compagnAccessKey);
								echo $dowload_link;
								$filePath=$this->madrivoRedirectDownload($dowload_link,$fName);
							break;
						}
				    } else{
						echo $dowload_url;
					}
					break;
				case "W4"://
					set_time_limit(0);
					$download_link=$this->getw4SuppressionUrlFromSponsor($api_key,$osid);//$this->getw4SuppressionUrlFromSponsor("16a3a2d310b20043d62032968097c3e8","25525");//$this->getw4SuppressionUrlFromSponsor($api_key,$osid);
						//$this->downloadFile($download_link,$fileZipName,$fName);
					$filePath=$this->optizmoSmartDownload($download_link,$fName);
						//$this->renamefile($this->fileName($sponsor_id,$offer_id,$osid));
				break;					
				case "Cake":		
					$dowload_url=$this->getCakeSuppressionUrlFromSponsor($api_url,$api_key,$osid,$affiliate_id);
					$techno=$this->getUnsubLinkTechnology($dowload_url);
					switch($techno){							
						case "[optismo]":
							$compagnAccessKey=$this->getCampaignAccessKeyFromSupressionFileUrl($dowload_url);
							$dowload_link=$this->getLinkSuppFileFromOptismo($compagnAccessKey);								
							set_time_limit(0); 
							$filePath=$this->optizmoSmartDownload($dowload_link,$fName);
							//$this->downloadFile($dowload_link,$fileZipName,$dir);
						break;
						case "[optismo-directe-link]":		
							$this->downloadFile($dowload_url,$fileZipName,$fName);
						break;
						case "[google-docs]":
						    echo "</br>";
							echo "this is link";
							$filePath=$this->downloadFromGoogleDocs($dowload_url,$fName);
						break;
					}		
				break;
				}						
			DB::insert('insert into suppressions (offre_id,path,name) values (?,?,?)', [ $offer_id,$filePath,$fName.'-MD5.txt']);
		}
		return json_encode($filePath);
	}

	public function getw4SuppressionUrlFromSponsor($API_KEY,$sid_offer){
		$resp = null;
		$download_link = null;
		$url="https://w4api.com/pub/pubs_campaign_suppression/get/?key_id=".$API_KEY."&campaign_id=".$sid_offer."&md5=true";
		$client = new \GuzzleHttp\Client();
		$response = $client->get($url);
		$json = json_decode($response->getBody(), true);
		$success=(string)$json['success'];
		if($success==='1'){
			$r=json_decode($json['data'], true);
			if (json_last_error() === JSON_ERROR_NONE) {
				$download_link=$r['download_link'];
			}
		}else{
			echo $json['message'];
		}
		return $download_link;	 
	}

	public function downloadFile($url,$fileName,$dir){		
		$ch = curl_init();		
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec ($ch);
		curl_close ($ch);		
		//$file = fopen($fileName, "w+");
		//fputs($file, $data);		
		//fclose($file);
		echo $data;
		//$this->extractt($fileName,$dir);
		//$this->renamefile1($dir);
	}	

	public function extractt($fileName,$dir){
		$zip = new ZipArchive;
		$res = $zip->open($fileName);
		if ($res === TRUE) {
			$zip->extractTo("../public/images/suppressions/".$dir);
			$zip->close();		
			echo $fileName.' Extract success';
		} else {
			echo $fileName.' Extract failure !!';
		}
	}

	public function fileName($id_sponsor,$id_offer,$sid_offer){
		return "sp".$id_sponsor."-".$id_offer."-".$sid_offer."-";
	}
		
	public function getCakeSuppressionUrlFromSponsor($API_URL,$API_KEY,$sid_offer,$affiliate_id){
		$resp = null;
		$download_url = null;
		//$url=$API_URL."/affiliates/api/Offers/SuppressionList/?offer_id=".$sid_offer."&api_key=".$API_KEY."&affiliate_id=".$affiliate_id;
		$url=$API_URL."/affiliates/api/Offers/SuppressionList?offer_id=".$sid_offer."&api_key=".$API_KEY."&affiliate_id=".$affiliate_id;
		$client = new \GuzzleHttp\Client();
		$response = $client->get($url);
		$json = json_decode($response->getBody(), true);
		$success=(string)$json['success'];
		if($success==='1'){			
			if (json_last_error() === JSON_ERROR_NONE) {
				$download_url=$json['download_url'];
			}else echo "url not exist";
		}else{
			echo $json['message'];
		}
		return $download_url;
	}

	public function getCampaignAccessKeyFromSupressionFileUrl($suppFileUrl){
		$result = null;
		$dom[]=null;
		if ($suppFileUrl != null && !empty($suppFileUrl)){
			$dom = explode("/", $suppFileUrl);
			$result=$dom[3];
		} 
		return $result;
	}

	public function getLinkSuppFileFromOptismo($campaignAccessKey){
		$download_link = null;
		$optismoAccessToken=$this->getOptizmoAccessToken();
		if ($optismoAccessToken != null && !empty($optismoAccessToken) && $campaignAccessKey != null && !empty($campaignAccessKey)){
			$url = "https://mailer_api.optizmo.net/accesskey/download/".$campaignAccessKey."?token=".$optismoAccessToken."&format=md5&deltas=0";
			$client = new \GuzzleHttp\Client();
			$response = $client->get($url, ['verify' => false]);
			$json = json_decode($response->getBody(), true);
			$success=(string)$json['result'];
			if($success==='success'){			
				if (json_last_error() === JSON_ERROR_NONE) {
					$download_link=$json['download_link'];
				}else echo 'link not exist';
			}else{
				echo $json['message'];
			}					
		}
		return $download_link;
	}

	public function getOptizmoAccessToken(){
		return "L8yzHyf16MhZqeva5oKx0g7qAe2EmscE";
	}

	public function optizmoSmartDownload($url,$fileName){	
		
		$arrContextOptions=array(
			"ssl"=>array(
				"verify_peer"=>false,
				"verify_peer_name"=>false,
			),
		);  	
		$filePath=null;	
		set_time_limit(0); 
		$response = file_get_contents($url, false, stream_context_create($arrContextOptions));
		$redirect_link=explode(" ", $response);
		echo "</br>";
		$ep=(String)$redirect_link[9];
		$zip = new ZipArchive();
		$fileZipname = "../public/images/suppressions/".$fileName."/--".$fileName."--.zip";
		if ($zip->open($fileZipname, ZipArchive::CREATE)!==TRUE){
			exit("cannot open <$fileZipname>\n");
		}else {
			set_time_limit(0); 
			$response1 = file_get_contents($ep, false, stream_context_create($arrContextOptions));
			file_put_contents($fileZipname, $response1);
			//$this->extractt($fileZipname,"../public/suppression_file/".$fileName);
			$this->extractt($fileZipname,$fileName);
			//$zip->extractTo("../public/suppression_file/".$fileName);
			$filePath=$this->renamefile1($fileName);
		}
		 return $filePath;
	}

	public function getSuppressionUrlFromSponsor(){
		$arrContextOptions=array(
			"ssl"=>array(
				"verify_peer"=>false,
				"verify_peer_name"=>false,
			),
		);  
		set_time_limit(0); 
			$url = "https://docs.google.com/spreadsheets/d/1mCyMCqRlKa4xe0vr_ngMmup7kHJU7xjWB1bvcvS_Zi0/edit?ts=5d8b2184#gid=0";
			$client = new \GuzzleHttp\Client();
			$response = $client->get($url, ['verify' => false]);
			$json = json_decode($response->getBody(), true);
		var_dump($response);
	}

	public function md5Convert($fileName)
	{
			$filePath="images/suppressions/".$fileName."/".$fileName."-MD5.txt";
			$myfile = fopen("../public/".$filePath, "w") or die("Unable to open file!");
			$file = fopen("../public/images/suppressions/".$fileName."/".$fileName.".txt","r");
			while(! feof($file)){
				fwrite($myfile, md5(fgets($file)));	
				fwrite($myfile, "\r\n" );				
			}	
			fclose($myfile);
			fclose($file);			
			$zip = new ZipArchive();
			$filename = "../public/images/suppressions/".$fileName."/".$fileName.".zip";
			if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
				exit("cannot open <$filename>\n");
			}else{
				$zip->addFile("../public/".$filePath,$fileName."-MD5.txt");
				$zip->addFile("../public/images/suppressions/".$fileName."/".$fileName.".txt",$fileName.".txt");
				$zip->close();
			}
			return $filePath;	
	}

	public function getUnsubLinkTechnology($suppFileUrl){
		$result=null;
		$techno=null;
		if ($suppFileUrl != null && !empty($suppFileUrl)){
			$dom = explode("/", $suppFileUrl);
			$result=$dom[2];
		}
		switch($result){
			case "docs.google.com": $techno="[google-docs]"; //echo "google";
			break;
			case "www.affiliateaccesskey.com": $techno="[optismo]"; //echo "optismo";
			break;
			case "mailer-api.optizmo.net": $techno="[optismo-directe-link]";// echo "optismo link";
			break;
			case "api.midenity.com": $techno="[MADRIVO]"; //echo "Madrivo link";
		break;
		}
		return $techno;
	}
	public function getGoogleDocsKey($suppFileUrl){
		$result=null;
		if ($suppFileUrl != null && !empty($suppFileUrl)){
			$dom = explode("/", $suppFileUrl);
			$result=$dom[5];
		}
		return $result;
	}

	public function getGoogleDocsDownloadLink($suppFileUrl){
		$googleDocsKey=$this->getGoogleDocsKey($suppFileUrl);
		$download_link="https://docs.google.com/feeds/download/spreadsheets/Export?key=".$googleDocsKey."&exportFormat=csv&gid=0";
		return $download_link;
	}

	public function downloadFromGoogleDocs($suppFileUrl,$fileName){
		$download_link=$this->getGoogleDocsDownloadLink($suppFileUrl);
		$arrContextOptions=array(
			"ssl"=>array(
				"verify_peer"=>false,
				"verify_peer_name"=>false,
			),
		);  
		set_time_limit(0); 
		$file = file_get_contents($download_link, false, stream_context_create($arrContextOptions));
		file_put_contents("../public/images/suppressions/".$fileName."/".$fileName.'.txt', $file);
		$filePath=$this->md5Convert($fileName);
		return $filePath;
	}

	public function hithPathGetUrl($api_url,$api_key,$API_FUNCTION,$osid){
		$dowload_url=null;
		if (!file_exists('..\public\java-jar\HitPath.jar')) {				
			echo "le fichier jar n'existe pas !!"	;	  
		}
		else {
			//echo 'le fichier exist!!';						
		    $cmd= 'java -jar "..\public\java-jar\HitPath.jar" '.$api_url.' '.$api_key.' '.$API_FUNCTION.' '.$osid;// http://api.midenity.com/pubapi.php f93a25ee15c6b2c8db488fabb03e7044b4e2855e1004e040a60a77b7caaa0b70 getsuppression 4380';
			exec($cmd,$output,$report);	
			$dowload_url=$output[0];
		}
		return $dowload_url;
	}

	public function madrivoDownload($url,$fileZipName,$fileName){	
		$arrContextOptions=array(
			"ssl"=>array(
				"verify_peer"=>false,
				"verify_peer_name"=>false,
			),
		);  
		set_time_limit(0); 
		$file = file_get_contents($url, false, stream_context_create($arrContextOptions));
		//var_dump($file);
		file_put_contents($fileZipName,$file);//"../public/suppression_file/sp5-36-4380-/ll.zip"
		$this->extractt($fileZipName,$fileName);
		$filePath=$this->renamefile1($fileName);
		return $filePath;
	}

	function getFormatContentFile($file)
	{	$sh	=	fopen($file, 'r');
		$search      = "@";
		$file_format = 'md5';
		if ($handle = fopen($file, "r"))
		{ $cpt=0;
			while (!feof($handle)& $cpt!=4) 
			{
				$line = fgets($handle, 4096);			  
					if(strpos($line, $search) !== false)
					{
						$file_format = 'plain';
						$cpt=4;
					}
				$cpt++;
			}	
		}
		fclose($handle);
		return $file_format;
	}
	public function renamefile1($fName){
		$a = scandir("../public/images/suppressions/".$fName);			
		for($i=0;$i<count($a);$i++){				
			if(pathinfo($a[$i], PATHINFO_EXTENSION)==="txt"){				
				if($this->getFormatContentFile("../public/images/suppressions/".$fName.'/'.$a[$i])==='plain')
					rename("../public/images/suppressions/".$fName."/".$a[$i],"../public/images/suppressions/".$fName."/domains_list".$fName.".txt");
				elseif($this->getFormatContentFile("../public/images/suppressions/".$fName.'/'.$a[$i])==='md5')
					rename("../public/images/suppressions/".$fName."/".$a[$i],"../public/images/suppressions/".$fName."/".$fName."-MD5.txt");
			}
		}
		return "images/suppressions/".$fName."/".$fName."-MD5.txt";
	}
	public function madrivoRedirectDownload($url,$fileName){
		$arrContextOptions=array(
			"ssl"=>array(
				"verify_peer"=>false,
				"verify_peer_name"=>false,
			),
		);  
		$filePath=null;		
		set_time_limit(0); 
		$response = file_get_contents($url, false, stream_context_create($arrContextOptions));
		$redirect_link=explode(" ", $response);
		echo "</br>";
		$ep=(String)$redirect_link[9];
		$zip = new ZipArchive();
		$fileZipname = "../public/suppression_file/".$fileName."/".$fileName.".zip";
		if ($zip->open($fileZipname, ZipArchive::CREATE)!==TRUE){
			exit("cannot open <$fileZipname>\n");
		}else {
			set_time_limit(0); 
			$response1 = file_get_contents($ep, false, stream_context_create($arrContextOptions));
			file_put_contents($fileZipname, $response1);
			$this->extractt($fileZipname,$fileName);			
			$filePath=$this->renamefile1($fileName);
		}
		return $filePath;
	}	
}

