<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class RoleSuperVisorController extends Controller
{
    public function __construct()
    {
        $this->middleware('adminPermission:Master');
    }



    public function index(request $request)
    {
        if ($request->ajax()) {
            $roles = Role::where('guard_name','admin')->latest()->get();
            return Datatables::of($roles)
                ->addColumn('action', function ($roles) {
                    return '
                            <a href="'.route('roles_supervisors.edit',$roles->id).'" class="btn btn-pill btn-info-light editBtn"><i class="fa fa-edit"></i></a>
                            <button class="btn btn-pill btn-danger-light" data-toggle="modal" data-target="#delete_modal"
                                    data-id="' . $roles->id . '" data-title="' . $roles->name . '">
                                    <i class="fas fa-trash"></i>
                            </button>
                       ';
                })
                ->editColumn('created_at', function ($roles) {
                    return $roles->created_at->diffForHumans();
                })
                ->escapeColumns([])
                ->make(true);
        } else {
            return view('Admin.roles.supervisor.index');
        }
    }



    public function create()
    {
        $permissions = Permission::where('guard_name','admin')->get();
        return view('Admin.roles.supervisor.create',compact('permissions'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name'       => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
        $role = Role::create(['name' => $request->input('name'),'guard_name'=>'admin']);
        $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles_supervisors.index')
            ->with('success','Role created successfully');
    }


//    public function show($id)
//    {
//        $role = Role::find($id);
//        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
//            ->where("role_has_permissions.role_id",$id)
//            ->get();
//        return view('roles.show',compact('role','rolePermissions'));
//    }


    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::where('guard_name','admin')->get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        return view('Admin.roles.supervisor.edit',compact('role','permissions','rolePermissions'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);
        $role = Role::findOrFail($id);
        $role->name = $request->input('name');
        $role->save();
        $role->syncPermissions($request->input('permission'));
        return redirect()->route('roles_supervisors.index')
            ->with('success','Role updated successfully');
    }


    public function delete(Request $request){
        Role::where('id',$request->id)->delete();
        return response(['message' => 'Data Deleted Successfully', 'status' => 200], 200);
    }
}
