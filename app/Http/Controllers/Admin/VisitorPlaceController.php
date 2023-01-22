<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\VisitorPlace;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class VisitorPlaceController extends Controller
{
//    public function __construct(){
//
//        $this->middleware('adminPermission:Master');
//    }
    public function index(Request $request)
    {
        if($request->ajax()) {
            $places = VisitorPlace::latest()->get();
            return Datatables::of( $places)
                ->addColumn('action', function ( $places) {
                    return '
                            <button type="button" data-id="' .  $places->id . '" class="btn btn-pill btn-info-light editBtn"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-pill btn-danger-light" data-toggle="modal" data-target="#delete_modal"
                                    data-id="' .  $places->id . '" data-title="' .  $places->title . '">
                                    <i class="fas fa-trash"></i>
                            </button>
                       ';
                })
                ->editColumn('created_at', function ($places) {
                    return $places->created_at->format('Y-m-d');
                })
                ->escapeColumns([])
                ->make(true);
        }else{
            return view('Admin.places.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(){

        return view('Admin.places.create');
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
            'title'       => 'required',
            'description'   => 'required',

        ]);

        if(VisitorPlace::create($inputs))
            return response()->json(['status'=>200]);
        else
            return response()->json(['status'=>405]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return Application|Factory|View
     */
    public function edit(VisitorPlace $place)
    {
        return view('Admin.places.edit',compact('place'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */


    public function updatePlace(Request $request)
    {
        $inputs = $request->validate([
            'id'       => 'required',
            'title'       => 'required',
            'description'   => 'required',
        ]);

        $visitorPlace = VisitorPlace::findOrFail($request->id);
        if($visitorPlace->update($inputs))
            return response()->json(['status'=>200]);
        else
            return response()->json(['status'=>405]);
    }


    public function delete(Request $request){
        $visitorPlace = VisitorPlace::where('id', $request->id)->first();
        $visitorPlace->delete();
        return response(['message'=>'Data Deleted Successfully','status'=>200],200);
    }
}
