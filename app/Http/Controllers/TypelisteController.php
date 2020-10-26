<?php

namespace App\Http\Controllers;
use DB;
use App\Typelistes;
use Illuminate\Http\Request;

class TypelisteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index()
    {
       $data = DB::table('typelistes')
       ->select('typelistes.*')
       ->get();
	 
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];	
        return view('pages.typelistes.index', ['pageConfigs' => $pageConfigs],compact('data'))
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
		return view('pages.typelistes.create', ['pageConfigs' => $pageConfigs]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
 
	
	  public function store(Request $request) {		  
		$typelistes = new Typelistes();
		$typelistes->name = $request['name'];
		$typelistes->abriviation = $request['abriviation'];
		$typelistes->save();
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('typelistes.index', ['pageConfigs' => $pageConfigs]);

    }
	
	
	
    /**
     * Display the specified resource.
     *
     * @param  \App\typelistes  $typelistes
     * @return \Illuminate\Http\Response
     */
    public function show(Typeliste $typelistes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Typelistes  $typelistes
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
	$typelistes = DB::table('typelistes')
       ->select('typelistes.*')
       ->get();
	
		$typelistes = Typelistes::findOrFail($id);
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
		return view('pages.typelistes.edit', ['pageConfigs' => $pageConfigs] ,compact('typelistes'));  

		}


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Typelistes  $Typelistes
     * @return \Illuminate\Http\Response
     */			
						
	  public function update(Request $request, $id) {

        $typelistes = Typelistes::where('id', '=', $id)->first();
        $typelistes ->update($request->all());
        $pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('typelistes.index', ['pageConfigs' => $pageConfigs])
                        ->with('success','Typeliste updated successfully'); 
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Typelistes  $typelistes
     * @return \Illuminate\Http\Response
     */

	  public function delete($id) {

        $typelistes = Typelistes::findOrFail($id);
        $typelistes->delete();
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('typelistes.index', ['pageConfigs' => $pageConfigs]);

    }
}
