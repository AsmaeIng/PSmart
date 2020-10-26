<?php

namespace App\Http\Controllers;
Use DB;
use App\Countrys;
use App\Flags;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	  function __construct()
    {
		$this->middleware('permission:countrys-list|countrys-create|countrys-edit|countrys-show|countrys-delete', ['only' => ['index','show']]);
         $this->middleware('permission:countrys-create', ['only' => ['create','store']]);
         $this->middleware('permission:countrys-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:countrys-delete', ['only' => ['delete']]);
		 $this->middleware('permission:countrys-show', ['only' => ['show']]);
	} 
	
   public function index()
    {

		$countrys = Countrys::all();		
		$flags = Flags::all();
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];	
        return view('pages.countrys.index', ['pageConfigs' => $pageConfigs],compact('countrys','flags'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    } 
	
	public function indexflag()
    {
        //$countrys = Countrys::latest()->paginate(10);
		$countrys = DB::table('countrys')
            ->select('countrys.*')
			  ->where('flag', '<>', '')
            ->get();
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];	
        return view('pages.countrys.indexflag', ['pageConfigs' => $pageConfigs],compact('countrys'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
		return view('pages.countrys.create', ['pageConfigs' => $pageConfigs]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
 
	
	  public function store(Request $request) {

        $country = new Countrys();
		$country->sortname = $request['sortname'];
		$country->name = $request['name'];
		$country->phonecode = $request['phonecode'];
		$country->save();
		$id = $country->id;
		$request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

		$image = new Flags;			
		$file = $request->file('image');
        $name = time().'.'.$request->image->extension(); 
		$path = $file->storeAs('images/flag', $name, 'public');
				// $file= Storage::disk('images/networks')->put($name, file_get_contents($file));
				$file->move(public_path($path), $name);
				$image->name = $name;
				$image->path = $path;
				$image->country_id = $id;
				$image->save();
		
		
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('countrys.index', ['pageConfigs' => $pageConfigs]);

    }
	
	
	
    /**
     * Display the specified resource.
     *
     * @param  \App\Countrys  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Countrys  $country
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$images = DB::table('flags')
			   ->select('flags.*')
			   ->where('flags.country_id', '=' , $id)
			   ->get();
		$country = Countrys::findOrFail($id);
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
		return view('pages.countrys.edit', ['pageConfigs' => $pageConfigs] ,compact('images','country'));    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Countrys  $country
     * @return \Illuminate\Http\Response
     */			
						
	 public function update(Request $request, $id) {

        $country = Countrys::findOrFail($id);		
        $country->fill($request->all());
        $country->save();
		$image = Flags::where('country_id', '=', $id )->first();
			if ($image !=''){
				$request->validate([
					'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
				]);
					
				$file = $request->file('logo');
				$image = Flags::where('country_id', '=', $id )->first();
				$image->fill($request->all());	
				$name = time().'.'.$request->logo->extension(); 				
				$path = $file->storeAs('images/flag', $name, 'public');
				$file->move(public_path($path), $name);
				$image->name = $name;
				$image->path = $path;
				$image->country_id = $id;
				$image->save();
			}
			else{
				$request->validate([
					'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
				]);
				$file = $request->file('logo');
				$image = new Flags;			
				$name = time().'.'.$request->logo->extension(); 
				$path = $file->storeAs('images/Flags', $name, 'public');
				// $file= Storage::disk('images/networks')->put($name, file_get_contents($file));
				$file->move(public_path($path), $name);
				$image->name = $name;
				$image->path = $path;
				$image->country_id = $id;
				$image->save();
				
				
			}
        $pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('countrys.index', ['pageConfigs' => $pageConfigs])
                        ->with('success','country updated successfully'); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    // public function destroy(country $country)
    // {
    // $country->delete();
		// $pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        // return redirect()->route('pages.countrys.index', ['pageConfigs' => $pageConfigs])
                        // ->with('success','countrys deleted successfully');  
    // }
	  public function delete($id) {

        $country = Countrys::findOrFail($id);
        $country->delete();
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('countrys.index', ['pageConfigs' => $pageConfigs]);

    }
}
