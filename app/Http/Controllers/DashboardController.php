<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class DashboardController extends Controller
{
    
	 public function __construct()
    {
        $this->middleware('auth');
    }
	public function store(Request $request)
{
    if ($request->user()->can('create-tasks')) {
        //Code goes here
    }
}

public function destroy(Request $request, $id)
{   
    if ($request->user()->can('delete-tasks')) {
      //Code goes here
    }

}
	public function dashboardModern()
    {

        return view('/pages/dashboard-modern');
    }

    public function dashboardEcommerce()
    {

        $pageConfigs = ['navbarLarge' => false];

        return view('/pages/dashboard-ecommerce', ['pageConfigs' => $pageConfigs]);
    }

    public function dashboardAnalytics()
    {
        $pageConfigs = ['navbarLarge' => false];

        return view('/pages/dashboard-analytics', ['pageConfigs' => $pageConfigs]);
    }
}
