<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supervisor;
use App\Models\Product;
use App\Traits\PhotoTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    use PhotoTrait;

    public function __construct()
    {
        $this->middleware('adminPermission:Master');
    }

    public function index(request $request)
    {

        if ($request->ajax()) {
//            DB::connection('mysql');
            $admins = Supervisor::latest()->get();
            return Datatables::of($admins)
                ->addColumn('action', function ($admins) {
                    return '
                            <button type="button" data-id="' . $admins->id . '" class="btn btn-pill btn-info-light editBtn"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-pill btn-danger-light" data-toggle="modal" data-target="#delete_modal"
                                    data-id="' . $admins->id . '" data-title="' . $admins->name . '">
                                    <i class="fas fa-trash"></i>
                            </button>
                       ';
                })
                ->editColumn('created_at', function ($admins) {
                    return $admins->created_at->diffForHumans();
                })
                ->editColumn('photo', function ($admins) {
                    return '
                    <img alt="image" class="avatar avatar-md rounded-circle" src="' . get_user_photo($admins->photo) . '">
                    ';
                })
                ->escapeColumns([])
                ->make(true);
        } else {
            return view('Admin/admin/index');
        }
    }


    public function delete(Request $request)
    {
        $admin = Supervisor::where('id', $request->id)->first();
        if ($admin == auth()->guard('admin')->user()) {
            return response(['message' => "You Can't Delete The Logged Supervisor !", 'status' => 501], 200);
        } else {
            if (file_exists($admin->photo)) {
                unlink($admin->photo);
            }
            $admin->delete();
            return response(['message' => 'Data Deleted Successfully', 'status' => 200], 200);
        }
    }

    public function myProfile()
    {
        $admin = auth()->guard('admin')->user();
        return view('Admin/admin/profile', compact('admin'));
    }//end fun


    public function create()
    {
        $permissions = Role::where('guard_name', 'admin')->get();
        return view('Admin/admin.parts.create', compact('permissions'));
    }

    public function store(request $request): \Illuminate\Http\JsonResponse
    {
        $inputs = $request->validate([
            'email' => 'required|unique:supervisors',
            'name' => 'required',
            'password' => 'required|min:6',
            'photo' => 'nullable|mimes:jpeg,jpg,png,gif',
            'supervisor_type' => 'required',
        ]);

//        dd($request->permissions);

        if ($request->has('photo')) {
            $file_name = $this->saveImage($request->photo, 'assets/uploads/admins');
            $inputs['photo'] = 'assets/uploads/admins/' . $file_name;
        }
        $inputs['password'] = Hash::make($request->password);
        $admin = Supervisor::create($inputs);
//        $admin->givePermissionTo($request->permissions);
        $admin->assignRole($request->permissions);
        if ($admin)
            return response()->json(['status' => 200]);
        else
            return response()->json(['status' => 405]);
    }

    public function edit(Supervisor $admin)
    {

        $adminPermissions = DB::table("model_has_permissions")->where("model_id",$admin->id)
            ->where('model_type', 'App\Models\Supervisor')
            ->pluck('model_has_permissions.permission_id')
            ->all();
        $permissions = Permission::where('guard_name', 'admin')->get();
        return view('Admin/admin.parts.edit', compact('admin','adminPermissions','permissions'));
    }

    public function update(request $request)
    {
        $inputs = $request->validate([
            'id' => 'required|exists:supervisors,id',
            'email' => 'required|unique:supervisors,email,' . $request->id,
            'name' => 'required',
            'photo' => 'nullable',
            'password' => 'nullable|min:6',
            'supervisor_type' => 'required',
        ]);
        if ($request->has('photo')) {
            $file_name = $this->saveImage($request->photo, 'assets/uploads/admins');
            $inputs['photo'] = 'assets/uploads/admins/' . $file_name;
        }
        if ($request->has('password') && $request->password != null)
            $inputs['password'] = Hash::make($request->password);
        else
            unset($inputs['password']);
        $admin = Supervisor::findOrFail($request->id);

        $names = $admin->getPermissionNames();
        foreach ($names as $name)
            $admin->revokePermissionTo($name);

        $admin->givePermissionTo($request->permissions);
        if ($admin->update($inputs))
            return response()->json(['status' => 200]);
        else
            return response()->json(['status' => 405]);
    }
}//end class
