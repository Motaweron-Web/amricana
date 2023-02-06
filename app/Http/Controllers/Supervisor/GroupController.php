<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\GroupColor;
use App\Models\GroupCustomer;
use App\Models\GroupMovement;
use App\Models\SupervisorActivity;
use Carbon\Carbon;
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
                ->get();

            if ($tourguides->count() > 0) {
                foreach ($tourguides as $tourguide)
                    $output .= '<option value="'. $tourguide->supervisor_id .'">'. $tourguide->supervisors->name .'</option>';
            }

            return response($output, 200);

        } // end if

    } // end of selectTourguide

    public function groupMove(Request $request)
    {
        $date_time = Carbon::now()->format('Y-m-d');
        $accept = 'waiting';
        $request->all();


        $outGroup = GroupMovement::where('group_id', $request->group_id)
            ->whereDate('created_at','=',$date_time)
            ->update(['status' => 'out']);

        $supervisor_old = SupervisorActivity::where('supervisor_id',$request->supervisor_old)
        ->where('activity_id', $request->activity_id)
        ->update(['status' => 'available']);


        $inGroup = GroupMovement::create([
            'date_time' => $date_time,
            'group_id' => $request->group_id,
            'activity_id' => $request->activity_id,
            'supervisor_accept_id' => $request->supervisor_accept_id,
            'accept' => $accept,
            'status' => 'in',
        ]);



        $supervisor_new = SupervisorActivity::where('supervisor_id',$request->supervisor_accept_id)
            ->where('activity_id', $request->activity_id)
            ->update(['status' => 'not_available']);

        return redirect()->back()->with('success','Group Move Success');

    }
}
