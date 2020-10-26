<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Users;
use App\User;
//use App\Users_roles;
use App\Addresses;
use App\File;
use App\Cities;
use App\Image;
//use App\Role;
//use App\Permission;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class UserController extends Controller
{	

function __construct()
    {
		 $this->middleware('permission:user-list|user-create|user-edit|user-show|user-delete', ['only' => ['index','show']]);
         $this->middleware('permission:user-create', ['only' => ['create','store']]);
         $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:user-delete', ['only' => ['delete']]);
		 $this->middleware('permission:user-show', ['only' => ['show']]);
		 $this->middleware('permission:user-createAuto', ['only' => ['createAuto']]);
     
	}
    
 public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->paginate(5);
        return view('pages.users.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
	
	
public function allUsers()
    {
        $images = Image::all();
		$users = User::all();
		$roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        return view('pages.sidebar.right-sidebar',compact('users','userRole','images','roles'))->with('i', ($request->input('page', 1) - 1) * 5);
            
    }


  public function create()
    {
        $cities = Cities::all();
		$cities = DB::table('cities')
			   ->join('states','cities.state_id','=','states.id')
			   ->join('countrys','states.country_id','=','countrys.id')
			   ->select('cities.*')
			   ->where('countrys.id', '=' , '148')
			   ->get();
		$roles = Role::pluck('name','name')->all();
        return view('pages.users.create',compact('cities','roles'));
    }
	
	public function store(Request $request)
    { 

        $new = new Addresses(); 
		$new->street = $request['street'];
		$new->city_id = $request['city_id'];
		$new->save();
		$id = $new->id;
		$path = 'images/user/intro-slide-1.png';
        $user = User::create($request->all());   
        $user = User::create([
            'name' => $request['name'], 
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
			'username' => $request['username'],
            'verified' => $request['verified'],
            'tel' => $request['tel'],
            'cin' => $request['cin'],
            'cnss' => $request['cnss'],
            'adress_id' => $id,
            'path' => $path,
            // 'laguage' => implode(',', $request->input('laguage')),
			'roles' => 'required'
        ]);
		  $input = $request->all();
        $user = User::create($input);
		 $iduser = $user->id;
		 $img = new Images(); 
		 $img->name = 'intro-slide-1.png';
		 $img->user_id = $iduser;
		 $img->path = $path;
		 $img->save();
        $user->assignRole($request->input('roles'));
        
        
  

        return redirect()->route('users.index');
    }
    public function usersList(Request $request)
    {
       

		$data = User::all();
		$roles = DB::table('roles')				
			   ->select('roles.*')
			   ->get();
       
	   //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];

		return view('pages.users.page-users-list', ['pageConfigs' => $pageConfigs],compact('data','roles'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
		
    }
	public function usersNewList()
    {      
		$data = DB::table('users')				
			   ->select('users.*')
			   ->get();
		$data2 = DB::table('users_roles')				
			   ->select('users_roles.*')
			   ->get();

		
	   //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];
		return view('pages.users.page-new-users-list', ['pageConfigs' => $pageConfigs],compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
		
    }
    public function usersView($id)
    {
        
		$user = User::findOrFail($id);
		$images = DB::table('images')
			   ->select('images.*')
			   ->where('images.user_id', '=' , $id)
			   ->get();
		$userRole = $user->roles->pluck('name','name')->all();
		$countrys = DB::table('users')
			->join('addresses','addresses.id','=','users.adress_id')
			->join('cities','addresses.city_id','=','cities.id')
			->join('states','cities.state_id','=','states.id')
			->join('countrys','states.country_id','=','countrys.id')
			->select('addresses.id as idAdress','addresses.street','cities.city','cities.id as idCities','countrys.id as idCountry','countrys.name as nameCont')
			->where('users.id', '=' , $id)
			->get();
		$addresses = DB::table('addresses')				
			   ->select('addresses.*')
			   ->get();
		$cities = DB::table('cities')
			   ->join('states','cities.state_id','=','states.id')
			   ->join('countrys','states.country_id','=','countrys.id')
			   ->select('cities.*')
			   ->where('countrys.id', '=' , '148')
			   ->get(); 
		$rol = Role::all();		
		$roles = Role::pluck('name','name')->all();
		$rolePermission = DB::table('role_has_permissions')				
			   ->select('role_has_permissions.*')
			   ->get();
		$permissions = DB::table('permissions')				
			   ->select('permissions.*')
			   ->get();
		
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];

        return view('pages.users.page-users-view', ['pageConfigs' => $pageConfigs],compact('rol','rolePermission','countrys','cities','permissions','roles','user','images','userRole'));
    }
    public function usersEdit($id)
    {
        $images = Image::all();
		$user = User::findOrFail($id);
		$data = DB::table('users')
			->join('images','images.user_id','=','users.id')
			->join('addresses','addresses.id','=','users.adress_id')
			->join('cities','addresses.city_id','=','cities.id')
			->join('states','cities.state_id','=','states.id')
			->join('countrys','states.country_id','=','countrys.id')
			->select('users.*','addresses.id as idAdress','addresses.street','addresses.PostalCode','cities.city','countrys.name as nameCont',
			'images.name as nameImage','images.path')
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
		//$permissions = Permission::all()->pluck('name', 'id');
		// $roles = DB::table('roles')				
			   // ->select('roles.*')
			   // ->get();
		$roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
		$permissions = DB::table('permissions')				
			   ->select('permissions.*')
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
		$users_roles = DB::table('users_roles')	
				->join('users','users_roles.user_id','=','users.id')
				->join('roles','users_roles.role_id','=','roles.id')
			   ->select('roles.*')
			   ->where('users.id', '=' , $id)
			   ->get();
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];
        return view('pages.users.page-users-edit', ['pageConfigs' => $pageConfigs],
		compact('countrys','data','data1','cities','group','permissions','roles','user','images','users_roles','userRole'));
    
	}
	
	public function update(Request $request, $id) {
		DB::table('model_has_roles')->where('model_id',$id)->delete();
		$user = User::where('id', '=', $id)->first();
		$user->username= $request['username'];	
		$user ->update($request->all());	   
	   $this->validate($request, [
            'verified' => 'required',
			'roles' => 'required'
        ]);			
        $user->assignRole($request->input('roles'));	
		
		$image = Image::where('user_id', '=', $id )->first();
		$request->validate([
          'files' => 'required',
        ]);
		if ($request->hasfile('files')!=null && $request->files != '') {			
			if ($image ==''){
				$files = $request->file('files');				
				foreach($files as $file) {
				$name = $file->getClientOriginalName();				
				$path = $file->storeAs('/images/user', $name, 'public');
				$file= Storage::disk('uploads')->put($name, file_get_contents($file));
				Image::create([
					'name' => $name,
					'user_id' => $id,
					'path' => $path,
					]);								
				}
			}		
			else{				
				$files = $request->file('files');
				foreach($files as $file) {
					$image = Image::where('user_id', '=', $id )->first();
					$image->fill($request->all());	
					$name = $file->getClientOriginalName();				
					$path = $file->storeAs('/images/user', $name, 'public');
					$file= Storage::disk('uploads')->put($name, file_get_contents($file));
					$image->name = $name;
					$image->path = $path;
					$image->user_id = $id;
					$image->save();	
				}
			}
		}			
		$user = User::where('id', '=', $id)->first();
		$user->path= $path;	
		$user ->update($request->all());
        $pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('users.page-users-list', ['pageConfigs' => $pageConfigs])
        ->with('success','user updated successfully');  
    }
	
	 public function delete($id) {

        $user = User::findOrFail($id);
        $user ->delete();
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('users.page-users-list', ['pageConfigs' => $pageConfigs])
                        ->with('success','user delete successfully'); 
	 }
	 public function getimage(){

         $id = Auth::user()->id;

        $images = Image::select('images.path','images.name')
        ->where('user_id',$id);
        return $images;

    }
}
