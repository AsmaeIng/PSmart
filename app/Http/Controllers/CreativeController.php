<?php

namespace App\Http\Controllers;
Use DB;
use App\Creatives;
use Illuminate\Http\Request;

class CreativeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index()
    {
         $creatives = DB::table('creatives')
            ->join('offres','offres.id','=','creatives.offer_id')   
            ->join('networks','networks.id','=','creatives.network_id')
            ->join('verticals','verticals.id','=','creatives.vertical_id')
            ->select('creatives.*','creatives.id as id','offres.name as nameOff','networks.name as nameNet','verticals.name as nameVert')//,)
            ->get();
         $pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];	
         return view('pages.creatives.index', ['pageConfigs' => $pageConfigs],compact('creatives'))
             ->with('i', (request()->input('page', 1) - 1) * 10);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $network = DB::table('networks')
        ->select('networks.*')
		->where('type', '=','on')
        ->get();
        $offer = DB::table('offres')
                ->select('offres.*')
                ->get();
        $vertical = DB::table('verticals')
                ->select('verticals.*')
                ->get();
        $pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return view('pages.creatives.create', ['pageConfigs' => $pageConfigs],compact('network','offer','vertical'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	  public function store(Request $request) {
        $creative = new Creatives();
        $creative->network_id = $request['network_id'];
        $creative->offer_id = $request['offer_id'];
        $creative->vertical_id = $request['vertical_id'];
		$creative->creative = $request['creative'];
		$creative->save();
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('creatives.index', ['pageConfigs' => $pageConfigs]);
    }		
    /**
     * Display the specified resource.
     *
     * @param  \App\Creatives  $creative
     * @return \Illuminate\Http\Response
     */
    public function show(creative $creative)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Creatives  $creative
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $network = DB::table('networks')
                ->select('networks.*')
                ->get();
        $offer = DB::table('offres')
                ->select('offres.*')
                ->get();
        $vertical = DB::table('verticals')
                ->select('verticals.*')
                ->get();
		$creatives = Creatives::findOrFail($id);
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return view('pages.creatives.edit', ['pageConfigs' => $pageConfigs] ,compact('creatives','network','offer','vertical'));    
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Creatives  $creative
     * @return \Illuminate\Http\Response
     */								
	 public function update(Request $request, $id) {
        $creative = Creatives::findOrFail($id);
        $creative->fill($request->all());
        $creative->save();
        $pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('creatives.index', ['pageConfigs' => $pageConfigs])
                        ->with('success','creative updated successfully'); 
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Creatives  $creative
     * @return \Illuminate\Http\Response
     */
	  public function delete($id) {
        $creative = Creatives::findOrFail($id);
        $creative->delete(); 
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('creatives.index', ['pageConfigs' => $pageConfigs]);

    }
}
