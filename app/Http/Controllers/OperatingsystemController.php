<?php

namespace App\Http\Controllers;
use DB;
use App\Operatingsystems;
use Illuminate\Http\Request;

class OperatingsystemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index()
    {
       $data = DB::table('operatingsystems')
       ->select('operatingsystems.*')
       ->get();
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];	
        return view('pages.operatingsystems.index', ['pageConfigs' => $pageConfigs],compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
			
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
   
	    $operatingsystem = DB::table('operatingsystems')
			   ->select('operatingsystems.*')
			   ->get();
	    $pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
		return view('pages.operatingsystems.create', ['pageConfigs' => $pageConfigs],compact('operatingsystem'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
 
	
	  public function store(Request $request) {		  
		$operatingsystem = new Operatingsystems ();
		$operatingsystem->bit = $request['bit'];
		$operatingsystem->name = $request['name'];
		$operatingsystem->save();
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('operatingsystems.index', ['pageConfigs' => $pageConfigs]);

    }
	
	
	
    /**
     * Display the specified resource.
     *
     * @param  \App\Operatingsystems   $operatingsystems
     * @return \Illuminate\Http\Response
     */
    public function show(Operatingsystems  $operatingsystem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Operatingsystems   $operatingsystems
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
	$operatingsystem = DB::table('operatingsystems')
       ->select('operatingsystems.*')
       ->get();

		$operatingsystem = Operatingsystems ::findOrFail($id);
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
		return view('pages.operatingsystems.edit', ['pageConfigs' => $pageConfigs] ,compact('operatingsystem'));  

		}


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Operatingsystems   $operatingsystems
     * @return \Illuminate\Http\Response
     */			
						
	  public function update(Request $request, $id) {

        $operatingsystem = Operatingsystems::where('id', '=', $id)->first();
        $operatingsystem ->update($request->all());
        $pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('operatingsystems.index', ['pageConfigs' => $pageConfigs])
                        ->with('success','Operating systems updated successfully'); 
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Operatingsystems  $operatingsystem
     * @return \Illuminate\Http\Response
     */

	  public function delete($id) {

        $operatingsystem = Operatingsystems::findOrFail($id);
        $operatingsystem->delete();
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('operatingsystems.index', ['pageConfigs' => $pageConfigs]);

    }
}
