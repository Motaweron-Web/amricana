<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\GroupColor;
use App\Models\GroupCustomer;
use App\Models\GroupMovement;
use App\Models\SupervisorActivity;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function groupColor(Request $request)
    {
        if ($request->ajax()) {
            $color = $request->boxColor;
            $group = $request->groupId;

            GroupColor::where('group_id', $group)
                ->whereDate('created_at', '=', Carbon::now()->format('Y-m-d'))
                ->update(['color' => $color]);
            // update group color

        } // end if

    } // end of move

    public function selectTourguide(Request $request)
    {
        if ($request->ajax()) {

            $activity = $request->activity_id;

            $output = '<option>Select Supervisor</option>';

            $tourguides = SupervisorActivity::where('activity_id', $activity)
                ->where('status', 'available')
                ->whereDate('date_time', Carbon::now()->format('Y-m-d'))
                ->get();

            if ($tourguides->count() > 0) {
                foreach ($tourguides as $tourguide)
                    $output .= '<option value="' . $tourguide->supervisor_id . '">' . $tourguide->supervisors->name . '</option>';
            }

            return response($output, 200);

        } // end if

    } // end of selectTourguide

    public function groupMove(Request $request)
    {
        $date_time = Carbon::now()->format('Y-m-d');
        $accept = 'waiting';
        $request->all();


        try {

            $outGroup = GroupMovement::where('group_id', $request->group_id)
                ->whereDate('created_at', '=', $date_time)
                ->update(['status' => 'out']);

            $inGroup = GroupMovement::create([
                'date_time' => $date_time,
                'group_id' => $request->group_id,
                'activity_id' => $request->activity_id,
                'supervisor_accept_id' => $request->supervisor_accept_id,
                'accept' => $accept,
                'status' => 'in',
            ]);

            if (!$inGroup) {
                $outGroup = GroupMovement::where('group_id', $request->group_id)
                    ->whereDate('created_at', '=', $date_time)
                    ->update(['status' => 'in']);
            } else if ($inGroup) {
                return redirect()->back()->with('success', 'Group moved successfully');
            } else {
                return redirect()->back()->with('error', 'please fill data and try again');
            }

        } catch (Exception $e) {

            return redirect()->back()->with('error', 'please fill data and try again');
        }

    } // end group_move

    public function groupMoveCreate(Request $request)
    {
        $date_time = Carbon::now()->format('Y-m-d');
        $accept = 'waiting';
        $request->all();
        $color = $request->color;
        $group = $request->group_id;


//        dd($request->all());
        try {

            $groupMovement = GroupMovement::create([
                'date_time' => $date_time,
                'group_id' => $request->group_id,
                'activity_id' => $request->activity_id,
                'supervisor_accept_id' => $request->supervisor_accept_id,
                'accept' => $accept,
                'status' => 'in',
            ]);

            if ($request->has('color')) {
                GroupColor::where('group_id', $group)
                    ->whereDate('created_at', '=', Carbon::now()->format('Y-m-d'))
                    ->update(['color' => $color]);
            }

            $GroupCustomer = GroupCustomer::where('group_id', $request->group_id)
                ->whereDate('created_at', '=', $date_time)
                ->update([
                    'status' => 'in'
                ]);

            if ($groupMovement && $GroupCustomer) {
                return redirect()->back()->with('success', 'Group moved successfully');
            } else {
                return redirect()->back()->with('error', 'error try again');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'please fill data and try again');
        } // end try & catch

    } // end move create

    public function joinGroup(Request $request)
    {
        try {
            $inputs = $request->all();
            $groupJoin = $request->group_join;

            $group = GroupCustomer::where('group_id', $request->group_id)
                ->whereDate('created_at', '=', Carbon::now()->format('Y-m-d'))
                ->first()->update(['group_id' => $groupJoin]);

            $movement = GroupMovement::where('group_id', $request->group_id)
                ->whereDate('created_at', '=', Carbon::now()->format('Y-m-d'))
                ->first();

            if ($movement !== null) {
                $movement->update(['status' => 'out']);
            }


            if ($group) {
                return redirect()->back()->with('success', 'Group joined successfully');
            } else {
                return redirect()->back()->with('error', 'error try again !');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Please Try again as soon as possible');
        } // end try & catch

    } // end join group

    public function returnWaitingRoom(Request $request)
    {
        $group = $request->group;

        $groupMovement = GroupMovement::where('group_id', $group)
            ->delete();

        if ($groupMovement) {
            $groupColor = GroupColor::where('group_id', $group)
                ->update(['color' => null]);
            return response()->json(['status' => 200]);
        } else {
            return response()->json(['status' => 500]);
        }

    } // end returnGroupWaiting
}
