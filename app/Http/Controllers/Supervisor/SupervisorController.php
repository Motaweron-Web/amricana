<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\GroupCustomer;
use App\Models\GroupMovement;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupervisorController extends Controller
{
    public function index(){

        $activities = Activity::with(['group_movements_today'])->orderBy('id', 'asc')->get();

        $group_customers_waiting = GroupCustomer::with(['group','ticket','reservation'])->where('status','=','waiting')->whereDate('created_at','=',Carbon::now()->format('Y-m-d'))->get();
        return view('platform.activities.index',compact('activities','group_customers_waiting'));
    }
}
