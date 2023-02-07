<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\GroupColor;
use App\Models\GroupCustomer;
use App\Models\GroupMovement;
use App\Models\RouteGroup;
use App\Models\SupervisorActivity;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupervisorController extends Controller
{
    public function index(){

        $activities = Activity::with(['groups'])->orderBy('id', 'asc')->get();

//
//        $group_customers_waiting = GroupCustomer::with(['group','ticket','reservation'])->where('status','=','waiting')
//            ->whereDate('created_at','=',Carbon::now()->format('Y-m-d'))->get();

        $group_customers_waiting = GroupColor::groupNotColored()->get();
//
//
//
//        $group_colors_active_r = Activity::with('last_active_group_movement')->get();

        $group_colors_active = GroupColor::groupColored()->get();
//        return  $group_customers_waiting;


        return view('platform.activities.index',compact('group_customers_waiting','activities'));
    }

    public function joinActivaties()
    {
        $activities = Activity::get();
        return view('platform.activities.join_activaties', compact('activities'));
    }

    public function addActivity(Request $request)
    {
        SupervisorActivity::create([
            'date_time' => Carbon::now()->format('Y-m-d H:i:s'),
            'status' => 'available',
            'activity_id' => $request->activaty,
            'supervisor_id' => $request->supervisor,
        ]);

        return redirect()->back();
    }

    public function requestsActivity()
    {
        return view('platform.Accept_groups.index');
    }

    public function showRequest()
    {
        $groupMovment = GroupMovement::where('accept','=','waiting')->get();
       return view('platform.Accept_groups.index', compact('groupMovment'));
    }

    public function groupAccept(Request $request)
    {
        $accept = 'accept';
        $group = GroupMovement::where('group_id',$request->group_id)
            ->where('supervisor_accept_id ',$request->supervisor)
            ->update(['accept' => $accept]);
        if ($group) {
            return response()->json('success');
        } else {
            return response()->json('error',405);
        }

    }
}
