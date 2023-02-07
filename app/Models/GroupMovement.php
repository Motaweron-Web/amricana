<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class GroupMovement extends Model
{
    protected $table = 'group_movements';
    protected $fillable = ['supervisor_accept_id','group_id','activity_id','ticket_id','rev_id','date_time','accept','status'];


    public function supervisor(){

        return $this->belongsTo(Supervisor::class,'supervisor_accept_id','id');

    }

    public function group(){

        return $this->belongsTo(Groups::class,'group_id','id');

    }

    public function activity(){

        return $this->belongsTo(Activity::class,'activity_id','id');

    }


    public function ticket(){

        return $this->belongsTo(Ticket::class,'ticket_id','id');
    }

    public function reservation(){

        return $this->belongsTo(Reservations::class,'rev_id','id');
    }

    public function group_color(){

        return  $this->hasOne(GroupColor::class,'group_id','group_id')->with(['group' => function ($group){
            $group->with(['group_customer' => function ($group_customer){
                $group_customer->select('*')
                    ->whereDate('created_at','=',Carbon::now()->format('Y-m-d'));
            }]);
        }])->whereHas('group', function ($group){
            $group->whereHas('group_customer', function ($group_customer){

                $group_customer->select('*')
                    ->whereDate('created_at','=',Carbon::now()->format('Y-m-d'));

            });
        })
            ->where('color','!=',NULL)->whereDate('created_at','=',Carbon::now()->format('Y-m-d'));

    }
}
