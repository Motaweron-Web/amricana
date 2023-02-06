<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
    protected $guarded=[];


    public function activity(){

        return $this->belongsToMany(Activity::class,'group_movements','group_id', 'activity_id','id','id');
    }


    public function group_coustomer(){

        return $this->hasOne(GroupCustomer::class,'group_id','id')->whereDate('created_at','=',Carbon::now()->format('Y-m-d'));
    }

    public function group_color()
    {
        return $this->hasOne(GroupColor::class,'group_id','id')->whereDate('created_at', Carbon::now()->format('Y-m-d'));
    }
}//end class
