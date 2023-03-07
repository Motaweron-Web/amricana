<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Ticket;
use App\Models\Reservations;
use App\Models\TicketRevProducts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthPlatformController extends Controller
{
    public function index(){

        if (Auth::guard('admin')->check()){
            return redirect()->route('platform.login');
        }
        return view('platform.auth.login');
    }

    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validate([
            'email'   =>'required|exists:supervisors',
            'password'=>'required'
        ]);
        if (Auth::guard('admin')->attempt($data) && (Auth::guard('admin')->user()->supervisor_type == 'platform')){
            return response()->json(200);
        }else{
            return response()->json(500);
        }
    }

    public function logout(){
        Auth::guard('admin')->logout();
        toastr()->info('logged out successfully');
        return redirect()->route('platform.login');
    }
}
