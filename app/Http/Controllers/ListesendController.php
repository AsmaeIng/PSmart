<?php

namespace App\Http\Controllers;
use DB;
use App\Listesends;
use App\Datas;
use App\Countrys;
use Illuminate\Http\Request;

class ListesendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index()
    {           
           
        $data = Listesends::all();   
		$country = Countrys::all();

        $isps = DB::table('isps')
			->select('isps.*')
			->get();
		$typeliste = DB::table('typelistes')
        ->select('typelistes.*')
        ->get();
        $pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];	
         return view('pages.listesends.index', ['pageConfigs' => $pageConfigs],compact('data','typeliste','country','isps'))
                 ->with('i', (request()->input('page', 1) - 1) * 10);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $country = DB::table('countrys')
        ->select('countrys.*')
        ->get();
        $typeliste = DB::table('typelistes')
        ->select('typelistes.*')
        ->get();
        $isps = DB::table('isps')
        ->select('isps.*')
        ->get();
 $pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
 return view('pages.listesends.create', ['pageConfigs' => $pageConfigs],compact('country','typeliste','isps'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
 
    public function store(Request $request) {
        
		$listesends = new Listesends();
		$listesends->name = $request['name'];
		$listesends->country_id = $request['country_id'];
		$listesends->typeListe_id = $request['typeListe_id'];
		$listesends->active = $request['active'];
		$listesends->isp_id = $request['isp_id'];
		$listesends->withMessageID = $request['withMessageID'];
        $listesends->optIn = $request['optIn'];//***********
        $listesends->Fields = $request['Fields'];       
        $listesends->delimiter = $request['delimiter'];
		$listesends->firstname = $request['firstname'];
		$listesends->lastname = $request['lastname'];
		$listesends->email = $request['email'];
		
		 $request->validate([
          'listeemail' => 'required',
        ]);
		// if ($request->hasfile('listeemail')) {
            $fichier = $request->file('listeemail');
            $name = $fichier->getClientOriginalName();				
            $path = $fichier->storeAs('email', $name, 'public');
			$listesends->Fields = $name; 
			$listesends->save();
			$id = $listesends->id;
			$fichier->move(public_path($path), $name);
			$file = fopen("$path/$name", "r") or exit("Unable to open file!");
			while($line = fgets($file))
				{
					$email = Datas::where('email_Email', '=', $line)->first();
					if ($email === null) {
						if(is_string($line) && $line !== ''&& $line !== '/n'&& $line !== ' '){
						$datas = new Datas(); 
						$datas->email_Email = $line;
						$datas->id_List_Email = $id;
						$datas->firstName_Email = $request['firstname'];
						$datas->lastName_Email = $request['lastname'];
						// $datas->dob_Email = $request['dob_Email'];
						$datas->state_Email = $request['state_Email'];		
						$datas->messageId = $request['withMessageID'];
						$datas->save();
						}
					}
				}
			fclose($file);
		// }
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('listesends.index', ['pageConfigs' => $pageConfigs]);

    }
		
    /**
     * Display the specified resource.
     *
     * @param  \App\listesends  $listesends
     * @return \Illuminate\Http\Response
     */
    public function show(Typeliste $listesends)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Listesends  $listesends
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
	    $country = DB::table('countrys')
        ->select('countrys.*')
        ->get();
        $typeliste = DB::table('typelistes')
        ->select('typelistes.*')
        ->get();
        $isps = DB::table('isps')
        ->select('isps.*')
        ->get();
		$listesends = Listesends::findOrFail($id);
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
		return view('pages.listesends.edit', ['pageConfigs' => $pageConfigs] ,compact('listesends','country','typeliste','isps')); 

		} 
		public function uploadData($id)
    {
		$country = DB::table('countrys')
        ->select('countrys.*')
        ->get();
        $typeliste = DB::table('typelistes')
        ->select('typelistes.*')
        ->get();
        $isps = DB::table('isps')
        ->select('isps.*')
        ->get();
		$listesends = Listesends::findOrFail($id);
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
		return view('pages.listesends.uploadData', ['pageConfigs' => $pageConfigs] ,compact('listesends','country','typeliste','isps')); 

		}


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Listesends  $Listesends
     * @return \Illuminate\Http\Response
     */			
						
	public function update(Request $request, $id) {
		 
		$cont = 0;
		if ($request->listeemail !='') {
         $request->validate([
          'listeemail' => 'required',
        ]);
		if ($request->hasfile('listeemail')) {
            $fichier = $request->file('listeemail');
            $name = $fichier->getClientOriginalName();
			$fields = $name; 
            $path = $fichier->storeAs('email', $name, 'public');
			$fichier->move(public_path($path), $name);
			$file = fopen("$path/$name", "r") or exit("Unable to open file!");
			while($line = fgets($file))
				{
					$email = Datas::where('email_Email', '=', $line)->first();
					if ($email === null) {
						if(is_string($line) && $line !== ''&& $line !== '/n'&& $line !== ' '){
						$datas = new Datas(); 
						$datas->email_Email = $line;
						$datas->id_List_Email = $id;
						$datas->firstName_Email = $request['firstname'];
						$datas->lastName_Email = $request['lastname'];
						// $datas->dob_Email = $request['dob_Email'];
						$datas->state_Email = $request['state_Email'];		
						$datas->messageId = $request['withMessageID'];
						$datas->save();
						}
						$cont++;
					}
				}
			fclose($file);

		}
		}
		    Listesends::find($id)->update(
            ['name'=>$request['name'],
            'country_id'=>$request['country_id'],
            'Fields'=>$cont,
            'typeListe_id'=>$request['typeListe_id'],
            'active'=>$request['active'],
            'isp_id'=>$request['isp_id'],
            'withMessageID'=>$request['withMessageID'],           
            'optIn'=>$request['optIn'],
            'delimiter'=>$request['delimiter'],
            'firstname'=>$request['firstname'],
            'lastname'=>$request['lastname'],
            'email'=>$request['email']          

        
        ]);
        $pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('listesends.index', ['pageConfigs' => $pageConfigs])
                        ->with('success','email updated successfully $cont'); 
    }
	public function upload(Request $request, $id) {
     
	 $cont = 0;
	 $request->validate([
          'listeemail' => 'required',
        ]);
		if ($request->hasfile('listeemail')) {
            $fichier = $request->file('listeemail');
            $name = $fichier->getClientOriginalName();				
            $path = $fichier->storeAs('email', $name, 'public');
			$fichier->move(public_path($path), $name);
			$file = fopen("$path/$name", "r") or exit("Unable to open file!");
			while($line = fgets($file))
				{
					$email = Datas::where('email_Email', '=', $line)->first();
					if ($email === null) {
						if(is_string($line) && $line !== ''&& $line !== '/n'&& $line !== ' '){
						$datas = new Datas(); 
						$datas->email_Email = $line;
						$datas->id_List_Email = $id;
						$datas->firstName_Email = $request['firstname'];
						$datas->lastName_Email = $request['lastname'];
						// $datas->dob_Email = $request['dob_Email'];
						$datas->state_Email = $request['state_Email'];		
						$datas->messageId = $request['withMessageID'];
						$datas->save();
						}
						$cont++;
					}
				}
			fclose($file);

		}
		Listesends::find($id)->update(
            ['name'=>$request['name'],
            'country_id'=>$request['country_id'],
            'Fields'=>$cont,
            'typeListe_id'=>$request['typeListe_id'],
            'active'=>$request['active'],
            'isp_id'=>$request['isp_id'],
            'withMessageID'=>$request['withMessageID'],           
            'optIn'=>$request['optIn'],
            'delimiter'=>$request['delimiter'],
            'firstname'=>$request['firstname'],
            'lastname'=>$request['lastname'],
            'email'=>$request['email']          

        
        ]);
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('listesends.index', ['pageConfigs' => $pageConfigs]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Listesends  $listesends
     * @return \Illuminate\Http\Response
     */

	  public function delete($id) {

        $listesend = Listesends::findOrFail($id);
        $listesend->delete();
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('listesends.index', ['pageConfigs' => $pageConfigs]);

    }
}
