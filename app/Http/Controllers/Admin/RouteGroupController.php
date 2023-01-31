<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Category;
use App\Models\Product;
use App\Models\RouteGroup;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class RouteGroupController extends Controller
{

    public function __construct(){

        $this->middleware('adminPermission:Master');
    }
    public function index(request $request)
    {
        if($request->ajax()) {
            $routes = RouteGroup::latest()->get();
            return Datatables::of($routes)
                ->addColumn('action', function ($routes) {
                    return '
                            <button type="button" data-id="' . $routes->id . '" class="btn btn-pill btn-info-light editBtn"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-pill btn-danger-light" data-toggle="modal" data-target="#delete_modal"
                                    data-id="' . $routes->id . '" data-title="' . $routes->group->title . '">
                                    <i class="fas fa-trash"></i>
                            </button>
                       ';
                })
                ->editColumn('group_id', function ($routes) {
                    return $routes->group->title;
                })

                ->editColumn('activity_id', function ($routes) {
                    return $routes->activity->title;

                })->escapeColumns([])
                ->make(true);
        }else{
            return view('Admin/route_group/index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $groups = DB::table('groups')->select('id','title')->orderBy('id','ASC')->get();
        $activities = DB::table('activities')->select('id','title')->orderBy('id','ASC')->get();
        return view('Admin/route_group.parts.create',compact('groups','activities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(request $request)
    {
        $inputs = $request->validate([
            'group_id' => 'required',
            'activity_id' => 'required',
            'time_group' => 'required',
        ],[

            'group_id.required' => 'The group field is required',
            'activity_id.required' => 'The activity field is required',
            'time_group.required' => 'The time of group in this activity field is required',
        ]);


        if(RouteGroup::create($inputs))
            return response()->json(['status'=>200]);
        else
            return response()->json(['status'=>405]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return Application|Factory|View
     */
    public function edit(RouteGroup $route)
    {

        $groups = DB::table('groups')->select('id','title')->orderBy('id','ASC')->get();
        $activities = DB::table('activities')->select('id','title')->orderBy('id','ASC')->get();

        return view('Admin/route_group.parts.edit',compact('groups','activities','route'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request)
    {

        $inputs = $request->validate([
            'group_id' => 'required',
            'activity_id' => 'required',
            'time_group' => 'required',
        ],[

            'group_id.required' => 'The group field is required',
            'activity_id.required' => 'The activity field is required',
            'time_group.required' => 'The time of group in this activity field is required',
        ]);

        $routeGroup = RouteGroup::findOrFail($request->id);
        if($routeGroup->update($inputs))
            return response()->json(['status'=>200]);
        else
            return response()->json(['status'=>405]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id){

    }

    public function delete(request $request){
        $routeGroup = RouteGroup::where('id', $request->id)->first();
        $routeGroup->delete();
        return response(['message'=>'Data Deleted Successfully','status'=>200],200);
    }

}
