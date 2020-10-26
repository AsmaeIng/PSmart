<?php

namespace App\Http\Controllers;
use DB;

use Illuminate\Http\Request;

class WarmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index()
    {
        
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];	
        return view('pages.warms.updateWarmListe', ['pageConfigs' => $pageConfigs])
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
		return view('pages.warms.create', ['pageConfigs' => $pageConfigs],compact('isps'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
 
	
	  public function store(Request $request) {

       /* $imap = new warms(); 
		$imap->id_isps = $request['id_isps'];
		$imap->Email = $request['Email'];
		$imap->Password = $request['Password'];
		$imap->Folder = $request['Folder'];
		$imap->save();*/
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('warms.index', ['pageConfigs' => $pageConfigs]);

    }
	
	
	
    /**
     * Display the specified resource.
     *
     * @param  \App\Warms  $warm
     * @return \Illuminate\Http\Response
     */
    public function show(warm $warm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Warms $warm
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		/*$data = DB::table('warms')
			 ->join('isps','isps.id','=','warms.id_isps')
			 ->select('warms.*','isps.name as nameIS','isps.id as idIS')
			 ->get();
		$isps = DB::table('isps')
			   ->select('isps.*')
			   ->get();
		$imap = Warms::findOrFail($id);*/
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return view('pages.warms.edit', ['pageConfigs' => $pageConfigs] );
        }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\warms  $warm
     * @return \Illuminate\Http\Response
     */			
						
	 public function update(Request $request, $id) {

       /* $imap = Warms::findOrFail($id);

        $imap->fill($request->all());
        $imap->save();*/

        $pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('warms.index', ['pageConfigs' => $pageConfigs])
                        ->with('success','imap updated successfully'); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Warms  $warm
     * @return \Illuminate\Http\Response
     */
   
	  public function delete($id) {

       // $imap =Warms::findOrFail($id);
        //$imap->delete();
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('warms.index', ['pageConfigs' => $pageConfigs]);

    }
}
