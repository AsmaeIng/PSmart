<?php

namespace App\Http\Controllers\Admin;
use App\Addresses;
use App\Cities;
use App\User;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUsersRequest;
use App\Http\Requests\Admin\UpdateUsersRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersController extends Controller
{ 
      use HasRoles;

	public function index()
    { 
        $users = User::all();
        return view('pages.users.index', compact('users'));
    }
 
    public function create()
    { 
		$roles = Role::pluck('name','name')->all();   
		$cities = Cities::all();
		$cities = DB::table('cities')
			   ->join('states','cities.state_id','=','states.id')
			   ->join('countrys','states.country_id','=','countrys.id')
			   ->select('cities.*')
			   ->where('countrys.id', '=' , '148')
			   ->get();
		
		return view('pages.users.create', compact('cities','roles'));
    }
 
    public function store(StoreUsersRequest $request)
    { 
        $fileName = null;
        $filePath = null;
        $fileExt = null;
        $new = new Addresses(); 
		$new->street = $request['street'];
		$new->city_id = $request['city_id'];
		$new->save();
		$id = $new->id;
		$path = 'images/user/intro-slide-1.png';
        //$user = User::create($request->all());   
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
            'verified' => $request['verified'],
            'laguage' => implode(',', $request->input('laguage')),
			'roles' => 'required'
        ]);
		  $role = Role::create(['name' => 'Admin1']);
		  $user->assignRole($request->input('roles'));
		//$user['laguage'] = implode(',', $request->input('laguage')); 
        if($request->hasFile('image')){
            $file     = $request->image;
            $fileName = $file->getClientOriginalName();
            $filePath = "/uploads/" . date("Y") . '/' . date("m") . "/" . $fileName;
            $fileName = $file->store($filePath, ['disk' => 'public']);
            //$file->storeAs('uploads/'. date("Y") . '/' . date("m") . '/', $fileName, 'uploads');
            $fileExt = $file->getClientOriginalExtension();

            // $user->img = $fileName;
            // $user->path = $filePath;
            // $user->ext = $fileExt;
            $user->save();
        }
        
        
  

        return redirect()->route('users.page-new-users-list');
    }

 
    public function edit($id)
    { 
        $user = User::findOrFail($id); 
        return view('pages.users.edit', compact('user'));
    }
 
    public function update(UpdateUsersRequest $request, $id)
    {    
        $fileName = null;
        $filePath = null;
        $fileExt = null; 

        $user = User::findOrFail($id); 
        if ($user != null) {           

            //$user = User::create($request->all()); 
            if($request->hasFile('image')){
                $file     = $request->image;
                $fileName = $file->getClientOriginalName();
                $filePath = "/uploads/" . date("Y") . '/' . date("m") . "/" . $fileName;
                $fileName = $file->store($filePath, ['disk' => 'public']);
                //$file->storeAs('uploads/'. date("Y") . '/' . date("m") . '/', $fileName, 'uploads');
                $fileExt = $file->getClientOriginalExtension();
                $user->img = $fileName;
                $user->path = $filePath;
                $user->save();
  
            }
        
            $password = trim($request->password, " ");            
            if(empty($password) || $password == null) {
                $password = $user->password; 
            } else {
                $password = $request->has('password') ? Hash::make($password) : null; 
            }

            $user->fill([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
            ])->save();

            //$user->update($request->all());
            return redirect()->route('users.index');
        } 
    }

 
    public function show($id)
    {
         
        $user = User::findOrFail($id);
        return view('pages.users.show', compact('user'));
    }

 
    public function destroy($id)
    { 
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index');
    }
  
}
