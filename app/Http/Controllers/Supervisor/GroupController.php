<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\GroupColor;
use App\Models\SupervisorActivity;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function groupMove(Request $request)
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
                ->where('status', 'login')->get();

            if ($tourguides->count() > 0) {
                foreach ($tourguides as $tourguide)
                    $output .= '<option value="'. $tourguide->supervisor_id .'">'. $tourguide->supervisors->name .'</option>';
            }

            return response($output, 200);

        } // end if

    } // end of selectTourguide
}
