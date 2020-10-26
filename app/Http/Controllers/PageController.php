<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Users;
use App\User;
use App\Role;
use App\Permission;
class PageController extends Controller
{
    public function contactPage()
    {
        return view('pages.page-contact');
    }
    public function pageBlogList()
    {
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Pages"], ['name' => "Blog List Page"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];

        return view('pages.page-blog-list', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
    }
    public function searchPage()
    {
        $pageConfigs = ['isFabButton' => true];
        return view('pages.page-search',['pageConfigs' => $pageConfigs]);
    }
    public function knowledgePage()
    {
        $pageConfigs = ['isFabButton' => true];
        return view('pages.page-knowledge',['pageConfigs' => $pageConfigs]);
    }
    public function knowledgeLicensingPage()
    {
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Pages"], ['link' => "page-knowledge", 'name' => "Knowledge"], ['name' => "Knowledge Licensing"]];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];

        return view('pages.page-knowledge-licensing', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
    }
    public function knowledgeLicensingPageDetails()
    {
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Pages"], ['link' => "page-knowledge", 'name' => "Knowledge"], ['link' => "page-knowledge/licensing", 'name' => "Knowledge Licensing"], ['name' => "Knowledge Detail"]];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];

        return view('pages.page-knowledge-licensing-detail', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
    }
    public function timelinePage()
    {
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Pages"], ['name' => "Timeline Page"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];

        return view('pages.page-timeline', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
    }
    public function faqPage()
    {
        $pageConfigs = ['isFabButton' => true];
        return view('pages.page-faq',['pageConfigs' => $pageConfigs]);
    }
    public function faqDetailsPage()
    {
        $pageConfigs = ['isFabButton' => true];
        return view('pages.page-faq-detail',['pageConfigs' => $pageConfigs]);
    }
    public function accountSetting($id)
    {
       $images = DB::table('images')
			   ->select('images.*')
			   ->where('images.user_id', '=' , $id)
			   ->get();
		$user = User::findOrFail($id);
		$data = DB::table('users')
			->join('users_roles','users_roles.user_id','=','users.id')
			->join('images','images.user_id','=','users.id')
			->join('roles','users_roles.role_id','=','roles.id')
			->join('addresses','addresses.id','=','users.adress_id')
			->join('cities','addresses.city_id','=','cities.id')
			->join('states','cities.state_id','=','states.id')
			->join('countrys','states.country_id','=','countrys.id')
			->select('users.*','addresses.id as idAdress','addresses.street','addresses.PostalCode','cities.city','countrys.name as nameCont',
			'roles.slug as slugRole','roles.name as nameRole','roles.id as idRole','images.name as nameImage','images.path')
			->where('users.id', '=' , $id)
			->get();	
			
		$data1 = DB::table('users')
			->join('addresses','addresses.id','=','users.adress_id')
			->join('cities','addresses.city_id','=','cities.id')
			->join('states','cities.state_id','=','states.id')
			->join('countrys','states.country_id','=','countrys.id')
			->select('addresses.id as idAdress','addresses.street','cities.city','cities.id as idCities','countrys.id as idCountry','countrys.name as nameCont')
			->where('users.id', '=' , $id)
			->get();
		$permissions = DB::table('permissions')				
			   ->select('permissions.*')
			   ->get();
		$roles = DB::table('roles')				
			   ->select('roles.*')
			   ->get();
		$group = DB::table('groups')				
			   ->select('groups.*')
			   ->get();
		$countrys = DB::table('countrys')				
			   ->select('countrys.*')
			   ->get();
		$cities = DB::table('cities')
			   ->join('states','cities.state_id','=','states.id')
			   ->join('countrys','states.country_id','=','countrys.id')
			   ->select('cities.*')
			   ->where('countrys.id', '=' , '148')
			   ->get();	   
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];
        return view('pages.users.page-account-settings', ['pageConfigs' => $pageConfigs],compact('countrys','data','data1','cities','group','permissions','roles','user','images'));
    
    }
    public function blankPage()
    {
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Pages"], ['name' => "Blank Page"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];
        return view('pages.page-blank', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
    }
    public function collapsePage()
    {
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Pages"], ['name' => "Page Collapse"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'bodyCustomClass' => 'menu-collapse', 'isFabButton' => true];

        return view('pages.page-collapse', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
    }
}
