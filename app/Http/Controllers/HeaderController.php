<?php

namespace App\Http\Controllers;
use DB;
use App\Headers;
use Illuminate\Http\Request;

class HeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	  function __construct()
    {
		 // $this->middleware('permission:header-list|header-create|header-edit|header-show|header-delete', ['only' => ['index','show']]);
         // $this->middleware('permission:header-create', ['only' => ['create','store']]);
         // $this->middleware('permission:header-edit', ['only' => ['edit','update']]);
         // $this->middleware('permission:header-delete', ['only' => ['delete']]);
		 // $this->middleware('permission:header-show', ['only' => ['show']]);
    }
   public function index()
    {
        $data = Headers::all();
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];	
        return view('pages.headers.index', ['pageConfigs' => $pageConfigs],compact('data'))
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
		return view('pages.headers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
 
	
	  public function store(Request $request) {

        $header = new Headers(); 
		$header->name = $request['name'];
		$header->texte = $request['texte'];
		$header->save();
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('headers.index', ['pageConfigs' => $pageConfigs]);

    }
	
	
	
    /**
     * Display the specified resource.
     *
     * @param  \App\Headers  $header
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

		$header = Headers::findOrFail($id);
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
		return view('pages.headers.show', ['pageConfigs' => $pageConfigs] ,compact('header'));    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Headers  $header
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$header = Headers::findOrFail($id);
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
		return view('pages.headers.edit', ['pageConfigs' => $pageConfigs] ,compact('header'));    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Headers  $header
     * @return \Illuminate\Http\Response
     */			
						
	 public function update(Request $request, $id) {

        $header = Headers::findOrFail($id);

        $header->fill($request->all());
        $header->save();

        $pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('headers.index', ['pageConfigs' => $pageConfigs])
                        ->with('success','header updated successfully'); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Headers  $header
     * @return \Illuminate\Http\Response
     */

	  public function delete($id) {

        $header = Headers::findOrFail($id);
        $header->delete();
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('headers.index', ['pageConfigs' => $pageConfigs]);

    }
}
