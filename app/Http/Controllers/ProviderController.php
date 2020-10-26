<?php

namespace App\Http\Controllers;
use DB;
use App\Providers;
use App\Logoproviders;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
	 
	  function __construct()
    {
		 $this->middleware('permission:providers-list|providers-create|providers-edit|providers-show|providers-delete', ['only' => ['index','show']]);
         $this->middleware('permission:providers-create', ['only' => ['create','store']]);
         $this->middleware('permission:providers-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:providers-delete', ['only' => ['delete']]);
		 $this->middleware('permission:providers-show', ['only' => ['show']]);
	}
   public function index()
    {
        $providers = Providers::latest()->paginate(10);
		$logoproviders = Logoproviders::all();
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];	
        return view('pages.providers.index', ['pageConfigs' => $pageConfigs],compact('providers','logoproviders'))
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
		return view('pages.providers.create', ['pageConfigs' => $pageConfigs]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
 
	
	  public function store(Request $request) {

        $provider = new Providers();
		$provider->note = $request['note'];
		$provider->name = $request['name'];
		$provider->webSite = $request['webSite'];
		$provider->save();
		$id = $provider->id;
		$request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

		$image = new Logoproviders;			
		$file = $request->file('image');
        $name = time().'.'.$request->image->extension(); 
		$path = $file->storeAs('images/providers', $name, 'public');
				// $file= Storage::disk('images/networks')->put($name, file_get_contents($file));
				$file->move(public_path($path), $name);
				$image->name = $name;
				$image->path = $path;
				$image->provider_id = $id;
				$image->save();
		
		
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('providers.index', ['pageConfigs' => $pageConfigs]);

    }
	
	
	
    /**
     * Display the specified resource.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function show(Provider $provider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		
		$images = DB::table('logoproviders')
			   ->select('logoproviders.*')
			   ->where('logoproviders.provider_id', '=' , $id)
			   ->get();
		$provider = Providers::findOrFail($id);
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
		return view('pages.providers.edit', ['pageConfigs' => $pageConfigs] ,compact('provider','images'));    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */			
						
	 public function update(Request $request, $id) {

        $provider = Providers::findOrFail($id);

        $provider->fill($request->all());
        $provider->save();
		
			$image = Logoproviders::where('provider_id', '=', $id )->first();
			if ($image !=''){
				$request->validate([
					'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
				]);
					
				$file = $request->file('logo');
				$image = Logoproviders::where('provider_id', '=', $id )->first();
				$image->fill($request->all());	
				$name = time().'.'.$request->logo->extension(); 				
				$path = $file->storeAs('images/providers', $name, 'public');
				$file->move(public_path($path), $name);
				$image->name = $name;
				$image->path = $path;
				$image->provider_id = $id;
				$image->save();
			}
			else{
				$request->validate([
					'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
				]);
				$file = $request->file('logo');
				$image = new Logoproviders;			
				$name = time().'.'.$request->logo->extension(); 
				$path = $file->storeAs('images/providers', $name, 'public');
				// $file= Storage::disk('images/networks')->put($name, file_get_contents($file));
				$file->move(public_path($path), $name);
				$image->name = $name;
				$image->path = $path;
				$image->provider_id = $id;
				$image->save();
				
				
			}
        $pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('providers.index', ['pageConfigs' => $pageConfigs])
                        ->with('success','provider updated successfully'); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    // public function destroy(provider $provider)
    // {
    // $provider->delete();
		// $pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        // return redirect()->route('pages.providers.index', ['pageConfigs' => $pageConfigs])
                        // ->with('success','providers deleted successfully');  
    // }
	  public function delete($id) {

        $provider = Providers::findOrFail($id);
        $provider->delete();
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('providers.index', ['pageConfigs' => $pageConfigs]);

    }
}
