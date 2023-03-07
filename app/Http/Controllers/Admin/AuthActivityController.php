<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\SupervisorActivity;
use Carbon\Carbon;
use App\Models\Ticket;
use App\Models\Reservations;
use App\Models\TicketRevProducts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthActivityController extends Controller
{
    public function index(){

        if (Auth::guard('admin')->check()){
            return redirect()->route('activity.login');
        }
        $activities = Activity::get();
        return view('platform.auth_activity.login',compact('activities'));
    } // end index

    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validate([
            'email'   =>'required|exists:supervisors',
            'password'=>'required'
        ]);
        if (Auth::guard('admin')->attempt($data) && (Auth::guard('admin')->user()->supervisor_type == 'activity') ){
            return response()->json(200);
        }else{
            return response()->json(500);
        }
    } // end login

    public function logout(){
        Auth::guard('admin')->logout();
        toastr()->info('logged out successfully');
        return redirect()->route('activity.login');
    } // end logout
}
