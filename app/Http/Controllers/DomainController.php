<?php

namespace App\Http\Controllers;
use DB;
use App\Domains;
use Illuminate\Http\Request;

class DomainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index()
    {
	   $data = Domains::all();
	   $providers = DB::table('providers')
			   ->select('providers.*')
			   ->get();
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];	
        return view('pages.domains.index', ['pageConfigs' => $pageConfigs],compact('data','providers'))
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
	    $pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
		return view('pages.domains.create', ['pageConfigs' => $pageConfigs],compact('provider'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
 
	
	  public function store(Request $request) {		  
		$domains = new Domains();
		$domains->saleDate = $request['saleDate'];
		$domains->name = $request['name'];
		$domains->expirationDate = $request['expirationDate'];
		$domains->provider_id = $request['provider_id'];
		$domains->save();
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('domains.index', ['pageConfigs' => $pageConfigs]);

    }
	
	
	
    /**
     * Display the specified resource.
     *
     * @param  \App\Domains  $domains
     * @return \Illuminate\Http\Response
     */
    public function show(Domains $domains)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Domains  $domains
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		
	$providers = DB::table('providers')
			->select('providers.*')
			->get();
	$provider = DB::table('domains')
			->join('providers','domains.provider_id','=','providers.id')
			->select('providers.name as nameProv','providers.id as idProv')
			->where('domains.id', '=' , $id)
			->get();

		$domains = Domains::findOrFail($id);
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
		return view('pages.domains.edit', ['pageConfigs' => $pageConfigs] ,compact('providers','provider','domains'));  

		}


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Domains  $domain
     * @return \Illuminate\Http\Response
     */			
						
	  public function update(Request $request, $id) {

        $domain = Domains::where('id', '=', $id)->first();
        $domain ->update($request->all());
        $pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('domains.index', ['pageConfigs' => $pageConfigs])
                        ->with('success','Domain updated successfully'); 
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Domains  $domain
     * @return \Illuminate\Http\Response
     */

	  public function delete($id) {

        $domain = Domains::findOrFail($id);
        $domain->delete();
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('domains.index', ['pageConfigs' => $pageConfigs]);

    }
}
