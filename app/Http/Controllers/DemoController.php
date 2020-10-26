<?php

namespace App\Http\Controllers;
use DB;
use App\Isps;
use Illuminate\Http\Request;

class DemoController extends Controller
{
	/**
     * Show the application myform.
     *
     * @return \Illuminate\Http\Response
     */
    public function myform()
    {
    	$countries = DB::table('countries')->pluck("name","id")->all();
    	return view('myform',compact('countries'));
    }


    /**
     * Show the application selectAjax.
     *
     * @return \Illuminate\Http\Response
     */
    public function selectAjax(Request $request)
    {
    	if($request->ajax()){
    		$states = DB::table('states')->where('id_country',$request->id_country)->pluck("name","id")->all();
    		$data = view('ajax-select',compact('states'))->render();
    		return response()->json(['options'=>$data]);
    	}
    }
}