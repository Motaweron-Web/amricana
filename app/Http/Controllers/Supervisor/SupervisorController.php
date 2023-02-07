<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\GroupColor;
use App\Models\GroupCustomer;
use App\Models\GroupMovement;
use App\Models\RouteGroup;
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
}
