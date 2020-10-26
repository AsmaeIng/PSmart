<?php

namespace App\Http\Controllers;
use App\Users;
use App\User;
use App\Users_roles;
use App\Addresses;
use App\Image;
use DB;
class UserProfileController extends Controller
{
    public function userProfile($id)
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
        return view('pages.user-profile-page', ['pageConfigs' => $pageConfigs],compact('countrys','data','data1','cities','group','permissions','roles','user','images'));
    
    }
}
