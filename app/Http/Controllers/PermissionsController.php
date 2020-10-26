<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Permission;
use BD;

class PermissionsController extends Controller
{
    public function index()
    {
     
		$permissions = Permission::all();
         $pageConfigs = ['bodyCustomClass' => 'app-page menu-collapse'];	
         return view('pages.permissions.index', ['pageConfigs' => $pageConfigs],['permissions' => $permissions])
             ->with('i', (request()->input('page', 1) - 1) * 10);
    }
    
    public function list()
    {     
        $permissions = Permission::all();
         
        $edit_gate = \Gate::allows('permission_edit');
        $delete_gate = \Gate::allows('permission_delete');
        
        return DataTables::of($permissions)
          
            ->addColumn('action', function ($permissions) use ($edit_gate, $delete_gate) {
                 $actions  = '';
                    if ($edit_gate){
                        $actions .= '<a href="'.route('permissions.edit', $permissions->id).'" '
                                    . 'id="permission-user-'.$permissions->id.'" '
                                    . 'class="btn">'
                                    . '<i class="fa fa-pencil-alt"></i>'
                                    . '</a>';
                    }
                    if ($delete_gate){
                        $actions .= '<button type="button" '
                                . 'class="btn text-danger" '
                                . 'onclick="destroyDataTableEntry(\'permissions\','.$permissions->id.')">'
                                . '<i class="fa fa-trash"></i></button>';
                    }
              
                return $actions;
            })
           
            ->addColumn('check', '')
            ->setRowId('id')
            ->make(true);
    }

    public function create()
    {     
        return view('pages.permissions.create');
    }

    public function store(Request $request)
    {
       

        $permission = Permission::create($request->all());

        return redirect()->route('permissions.index');
    }

    public function edit(Permission $permission)
    {
        return view('pages.permissions.edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {       
        $permission->update($request->all());           
        return redirect()->route('permissions.index');
    }

    public function show(Permission $permission)
    {     
        return view('pages.permissions.show', compact('permission'));
    }

    public function destroy(Permission $permission)
    {     
        $permission->delete();

        return back();
    }

    public function massDestroy(MassDestroyPermissionRequest $request)
    {
        Permission::whereIn('id', request('ids'))->delete();

        return response(null, 204);
    }
}
