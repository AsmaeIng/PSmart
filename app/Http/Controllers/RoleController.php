<?php

namespace App\Http\Controllers;
Use DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         // $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
         // $this->middleware('permission:role-create', ['only' => ['create','store']]);
         // $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
         // $this->middleware('permission:role-show', ['only' => ['show']]);
         // $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }
   public function index()
    {
         $roles = Role::all();
         $pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];	
         return view('pages.roles.index', ['pageConfigs' => $pageConfigs],['roles' => $roles])
             ->with('i', (request()->input('page', 1) - 1) * 10);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

	   $permissions = Permission::all()->pluck('name', 'id');
       $pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return view('pages.roles.create', ['pageConfigs' => $pageConfigs],['permissions' => $permissions]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	  public function store(Request $request) {
        $role = Role::create($request->all());
        $role->permissions()->sync($request->input('permissions', []));
        Cache::forget('role'); //cache should update next time
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('roles.index', ['pageConfigs' => $pageConfigs]);
    }		
    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
         $roles = Role::all();
		 $permissions = Permission::all()->pluck('name', 'id');
         $pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];	
         return view('pages.roles.show', ['pageConfigs' => $pageConfigs],['roles' => $roles,'permissions' => $permissions])
             ->with('i', (request()->input('page', 1) - 1) * 10);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		 $roles = Role::findOrFail($id);
		 $pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return view('pages.roles.edit', ['pageConfigs' => $pageConfigs],['roles' => $roles]);    
    }
	
	public function editRolePrermission(Request $request, $id)
    {
         $permissions = Permission::all()->pluck('name', 'id');
         
		 $data = Permission::all()->pluck('name', 'id');			
		 $roles = Role::findOrFail($id);
		 $roles->load('permissions');
		 $role = Role::findOrFail($id);
		 $role->load('permissions');
		 $pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return view('pages.roles.editRolePrermission', ['pageConfigs' => $pageConfigs],['permissions' => $permissions ,'data' => $data,'role' => $role,'roles' => $roles]);    
    }
	
    public function updateRolePrermission(Request $request, $id)
    {
        $roles = Role::findOrFail($id);
        $roles->fill($request->all());
        $roles->save();     
        $roles->permissions()->sync($request->input('permissions', []));        
        Cache::forget('roles'); //cache should update next time

        return redirect()->route('roles.show');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */								
	 public function update(Request $request, $id) {
        $roles = Role::findOrFail($id);
        $roles->fill($request->all());
        $roles->save();     
		Cache::forget('roles'); //cache should update next time	
        $pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('roles.index', ['pageConfigs' => $pageConfigs])
                        ->with('success','role updated successfully');
							
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $roles
     * @return \Illuminate\Http\Response
     */
	  public function delete($id) {
		
			
        DB::table("users_roles")->where("role_id", $id)->delete();
        DB::table("role_has_permissions")->where("role_id", $id)->delete();
		DB::table("roles")->where('id',$id)->delete();		
		$pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];
        return redirect()->route('roles.index', ['pageConfigs' => $pageConfigs]);

    }
}
