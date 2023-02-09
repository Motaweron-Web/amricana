<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class GroupCustomer extends Model
{

    protected $table = 'group_customers';
    protected $fillable = ['ticket_id','group_id','rev_id','date_time','quantity', 'sale_type'];


    public function ticket(){

        return $this->belongsTo(Ticket::class,'ticket_id','id');
    }

    public function reservation(){

        return $this->belongsTo(Reservations::class,'rev_id','id');
    }

    public function group(){

        return $this->belongsTo(Groups::class,'group_id','id');

    }

    public function group_movement(){

        return $this->hasMany(GroupMovement::class,'group_customer_id','id');
    }

    public function nextActivity()
    {
        return $this->belongsTo(RouteGroup::class,'group_id','group_id')
            ->whereDate('time_group','>=',Carbon::now()->format('H:i:s'))
            ->orderByDesc('created_at')->take(1);
    }

    public function lastActivity()
    {
        return $this->belongsTo(GroupMovement::class,'group_id','group_id')
            ->whereDate('date_time',Carbon::now()->format('Y-m-d'))
            ->where('status','=','out');
    }

    public function currentActivity()
    {
      return $this->belongsTo(GroupMovement::class,'group_id','group_id')
          ->whereDate('date_time',Carbon::now()->format('Y-m-d'))
          ->where('status','=','in');
    }

}
