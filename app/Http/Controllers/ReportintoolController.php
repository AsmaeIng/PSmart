<?php

namespace App\Http\Controllers;
use DB;
use App\Reportintools;
use Illuminate\Http\Request;

class ReportintoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index()
    {
       $data = DB::table('reportintools')
			 ->join('isps','isps.id','=','reportintools.id_isps')
			 ->select('reportintools.*','isps.name as NameIs')
			 ->get();
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];	
        return view('pages.reportings.index', ['pageConfigs' => $pageConfigs],compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
			
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$isps = DB::table('isps')
			   ->select('isps.*')
			   ->get();
	    $pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
		return view('pages.reportings.create', ['pageConfigs' => $pageConfigs],compact('isps'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
 
	
	  public function store(Request $request) { 
		$reportintools = new Reportintools();
		$reportintools->id_isps = $request['id_isps'];
		$reportintools->NumberReportl = $request['NumberReportl'];
		$reportintools->spam = $request['spam'];
		$reportintools->toindex = $request['toindex'];
		$reportintools->move = $request['move'];
		$reportintools->mark = $request['mark'];
		$reportintools->save();
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('reportings.index', ['pageConfigs' => $pageConfigs]);

    }
	
	
	
    /**
     * Display the specified resource.
     *
     * @param  \App\Reportintools  $reportintools
     * @return \Illuminate\Http\Response
     */
    public function show(Reportintools $reportintools)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reportintools  $reportintools
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$data = DB::table('reportintools')
			 ->join('isps','isps.id','=','reportintools.id_isps')
			 ->select('reportintools.*','isps.name as nameIS','isps.id as idIS')
			 ->get();
		$isps = DB::table('isps')
			   ->select('isps.*')
			   ->get();
		$reportintools = Reportintools::findOrFail($id);
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
		return view('pages.reportings.edit', ['pageConfigs' => $pageConfigs] ,compact('reportintools','isps','data'));  

		}


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reportintools  $reportintools
     * @return \Illuminate\Http\Response
     */			
						
	  public function update(Request $request, $id) {

        $reportintools = Reportintools::where('id', '=', $id)->first();
        $reportintools ->update($request->all());
        $pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('reportings.index', ['pageConfigs' => $pageConfigs])
                        ->with('success','Reportintool updated successfully'); 
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reportintools  $reportintools
     * @return \Illuminate\Http\Response
     */

	  public function delete($id) {

        $reportintools = Reportintools::findOrFail($id);
        $reportintools->delete();
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('reportings.index', ['pageConfigs' => $pageConfigs]);

    }
}
