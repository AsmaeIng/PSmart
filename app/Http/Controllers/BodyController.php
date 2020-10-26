<?php

namespace App\Http\Controllers;
use DB;
use App\Bodys;
use Illuminate\Http\Request;

class BodyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	  function __construct()
    {
		 // $this->middleware('permission:body-list|body-create|body-edit|body-show|body-delete', ['only' => ['index','show']]);
         // $this->middleware('permission:body-create', ['only' => ['create','store']]);
         // $this->middleware('permission:body-edit', ['only' => ['edit','update']]);
         // $this->middleware('permission:body-delete', ['only' => ['delete']]);
		 // $this->middleware('permission:body-show', ['only' => ['show']]);
    }
   public function index()
    {
        $data = Bodys::all();
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];	
        return view('pages.bodys.index', ['pageConfigs' => $pageConfigs],compact('data'))
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
		return view('pages.bodys.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
 
	
	  public function store(Request $request) {

        $body = new Bodys(); 
		$body->name = $request['name'];
		$body->texte = $request['texte'];
		$body->save();
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('bodys.index', ['pageConfigs' => $pageConfigs]);

    }
	
	
	
    /**
     * Display the specified resource.
     *
     * @param  \App\Bodys  $bodys
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

		$body = Bodys::findOrFail($id);
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
		return view('pages.bodys.show', ['pageConfigs' => $pageConfigs] ,compact('body'));    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bodys  $body
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$body = Bodys::findOrFail($id);
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
		return view('pages.bodys.edit', ['pageConfigs' => $pageConfigs] ,compact('body'));    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bodys  $body
     * @return \Illuminate\Http\Response
     */			
						
	 public function update(Request $request, $id) {

        $body = Bodys::findOrFail($id);

        $body->fill($request->all());
        $body->save();

        $pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('bodys.index', ['pageConfigs' => $pageConfigs])
                        ->with('success','body updated successfully'); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bodys  $body
     * @return \Illuminate\Http\Response
     */

	  public function delete($id) {

        $body = Bodys::findOrFail($id);
        $body->delete();
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('bodys.index', ['pageConfigs' => $pageConfigs]);

    }
}
