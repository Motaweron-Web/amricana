<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
    protected $guarded=[];

    protected $appends = ['group_quantity'];

    protected $hidden = ['pivot'];

    public function activity(){

        return $this->belongsToMany(Activity::class,'group_movements','group_id', 'activity_id','id','id');
    }


    public function group_customer(){

        return $this->hasMany(GroupCustomer::class,'group_id','id');
//        return $this->hasMany(GroupCustomer::class,'group_id','id')->whereDate('created_at','=',Carbon::now()->format('Y-m-d'));
    }

    public function group_color()
    {
        return $this->hasMany(GroupColor::class,'group_id','id');
    }


    public function getGroupQuantityAttribute(){

        return $this->attributes['group_quantity'] = GroupCustomer::select("id","group_id","quantity")->where("group_id","=",$this->attributes['id'])->sum("quantity");

    }

    public function group_movement(){

        return $this->hasOne(GroupMovement::class,'group_id','id')->with('group_color');
    }

}//end class
