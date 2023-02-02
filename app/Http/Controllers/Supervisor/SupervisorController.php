<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\GroupCustomer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupervisorController extends Controller
{
    public function index(){

        $activities = DB::table('activities')->orderBy('id', 'asc')->get();

        $group_customers_waiting = DB::table('group_customers')
            ->select('group_customers.id as group_customer_id','groups.id as group_id',
                'groups.title as group_title','group_customers.quantity as quantity','group_customers.date_time as date_time','group_customers.sale_type as sale',
                'group_customers.status as status','tickets.id as ticket_id','reservations.id as reservation_id')
            ->leftJoin('groups','group_customers.group_id','=','groups.id')
            ->leftJoin('tickets','group_customers.ticket_id','=','tickets.id')
            ->leftJoin('reservations','group_customers.rev_id', '=','reservations.id')
            ->where('group_customers.status','=','waiting')
            ->whereDate('group_customers.created_at','=',Carbon::now()->format('Y-m-d'))
            ->get();

        $group_customers_in = DB::table('group_customers')
            ->select('group_customers.id as group_customer_id','groups.id as group_id',
                'groups.title as group_title','group_customers.quantity as quantity','group_customers.date_time as date_time','group_customers.sale_type as sale',
                'group_customers.status as status','tickets.id as ticket_id','reservations.id as reservation_id')
            ->leftJoin('groups','group_customers.group_id','=','groups.id')
            ->leftJoin('tickets','group_customers.ticket_id','=','tickets.id')
            ->leftJoin('reservations','group_customers.rev_id', '=','reservations.id')
            ->where('group_customers.status','=','in')
            ->whereDate('group_customers.created_at','=',Carbon::now()->format('Y-m-d'))
            ->get();


        return view('platform.activities.index',['activities' => $activities,'group_customers_waiting' => $group_customers_waiting,'group_customers_in' => $group_customers_in]);
    }
}
