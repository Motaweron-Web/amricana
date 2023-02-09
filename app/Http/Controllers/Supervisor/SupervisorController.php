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
    public function index()
    {

        $activities = Activity::with(['groups'])->orderBy('id', 'asc')->get();


        $group_customers_waiting = GroupColor::groupNotColored()->get();

//        $group_colors_active = GroupColor::groupColored()->get();

//        return $group_customers_waiting;


        return view('platform.activities.index', compact('group_customers_waiting', 'activities'));
    }

    public function joinActivaties()
    {
        $activities = Activity::get();
        $supervisor_activities = SupervisorActivity::where('supervisor_id',auth()->user()->id)
            ->whereDate('date_time',Carbon::now()->format('Y-m-d'))->get();
        return view('platform.activities.join_activaties', compact('activities','supervisor_activities'));
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
        $groupMovment = GroupMovement::where('accept', '=', 'waiting')->where('supervisor_accept_id', auth('admin')->id())->get();
        return view('platform.Accept_groups.index', compact('groupMovment'));
    }

    public function groupAccept(Request $request)
    {
        try {
            $accept = 'accept';
            $group = GroupMovement::find($request->id)
                ->update([
                    'accept' => $accept
                ]);
            if ($group) {
                return response()->json('success', 200);
            }
        } catch (Exception $e) {
            return response()->json('error');
        }
    }

    public function groupNotAccept(Request $request)
    {
        try {
            $not_accept = 'not_accept';

            $checkOutActivity = GroupMovement::where('status', '=', 'out')
                ->where('group_id', $request->group_id)
                ->whereDate('date_time', Carbon::now()->format('Y-m-d'))
                ->orderBy('date_time', 'desc')->update(['status' => 'in']);

            if (!$checkOutActivity) {
                GroupMovement::find($request->id)
                ->update([
                    'accept' => $not_accept,
                    'status' => 'out'
                ]);

                GroupCustomer::where('group_id' ,$request->group_id)
                    ->update(['status' => 'waiting']);
                GroupColor::where('group_id' ,$request->group_id)
                    ->update(['color' => null]);

            }


                return response()->json('Not Accept Successfully', 200);

        } catch (Exception $e) {
            return response()->json('error');
        }
    }

    public function getLastRequests()
    {
        $groupMovment = GroupMovement::where('accept', '=', 'waiting')->where('supervisor_accept_id', auth('admin')->id())->get();
        if($groupMovment->count() == 0) {
            return response()->json(false);
        }
        return response()->json(true);
    }
}
