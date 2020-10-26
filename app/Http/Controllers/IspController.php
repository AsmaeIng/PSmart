<?php

namespace App\Http\Controllers;
use DB;
use App\Isps;
use App\Logoisps;
use Illuminate\Http\Request;

class IspController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	  function __construct()
    {
		 $this->middleware('permission:isps-list|isps-create|isps-edit|isps-show|isps-delete', ['only' => ['index','show']]);
         $this->middleware('permission:isps-create', ['only' => ['create','store']]);
         $this->middleware('permission:isps-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:isps-delete', ['only' => ['delete']]);
		 $this->middleware('permission:isps-show', ['only' => ['show']]);
	}  
   public function index()
    {
		
		$logoisps = Logoisps::all();
		$data = DB::table('isps')
		->select('isps.*')
		->get();
		
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];	
        return view('pages.isps.index', ['pageConfigs' => $pageConfigs],compact('data','logoisps'))
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
		return view('pages.isps.create', ['pageConfigs' => $pageConfigs]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
 
	
	  public function store(Request $request) {
		$isps = new Isps();
		$isps->name = $request['name'];
		$isps->type = $request['type'];
		$isps->url = $request['url'];
		$isps->emailTeste = $request['emailTeste'];
		$isps->save();
		$id = $isps->id;
		$request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

		$image = new Logoisps;			
		$file = $request->file('image');
        $name = time().'.'.$request->image->extension(); 
		$path = $file->storeAs('images/logoIsp', $name, 'public');
				$file->move(public_path($path), $name);
				$image->name = $name;
				$image->path = $path;
				$image->isps_id = $id;
				$image->save();
		
		
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('isps.index', ['pageConfigs' => $pageConfigs]);

    }
	
	
	
    /**
     * Display the specified resource.
     *
     * @param  \App\Isps  $isps
     * @return \Illuminate\Http\Response
     */
    public function show(Isps $isps)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Isps  $isps
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		
		$images = DB::table('logoisps')
			   ->select('logoisps.*')
			   ->where('logoisps.isps_id', '=' , $id)
			   ->get();
		$isps = Isps::findOrFail($id);
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
		return view('pages.isps.edit', ['pageConfigs' => $pageConfigs] ,compact('isps','images'));  

		}


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Isps  $isps
     * @return \Illuminate\Http\Response
     */			
						
	  public function update(Request $request, $id) {

        $isps = Isps::where('id', '=', $id)->first();
		$isps->name = $request['name'];
		$isps->type = $request['type'];
		$isps->url = $request['url'];
		$isps->emailTeste = $request['emailTeste'];
        $isps ->update($request->all());
		$image = Logoisps::where('isps_id', '=', $id )->first();
			if ($image !=''){
				$request->validate([
					'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
				]);
					
				$file = $request->file('logo');
				$image = Logoisps::where('isps_id', '=', $id )->first();
				$image->fill($request->all());	
				$name = time().'.'.$request->logo->extension(); 				
				$path = $file->storeAs('images/logoIsp', $name, 'public');
				$file->move(public_path($path), $name);
				$image->name = $name;
				$image->path = $path;
				$image->isps_id = $id;
				$image->save();
			}
			else{
				$request->validate([
					'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
				]);
				$file = $request->file('logo');
				$image = new Logoisps;			
				$name = time().'.'.$request->logo->extension(); 
				$path = $file->storeAs('images/logoIsp', $name, 'public');
				// $file= Storage::disk('images/networks')->put($name, file_get_contents($file));
				$file->move(public_path($path), $name);
				$image->name = $name;
				$image->path = $path;
				$image->isps_id = $id;
				$image->save();
				
				
			}
        $pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('isps.index', ['pageConfigs' => $pageConfigs])
                        ->with('success','ISP updated successfully'); 
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Isps  $isps
     * @return \Illuminate\Http\Response
     */

	  public function delete($id) {

        $isps = Isps::findOrFail($id);
        $isps->delete();
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('isps.index', ['pageConfigs' => $pageConfigs]);

    }
}
