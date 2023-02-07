<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activities';

    protected $guarded = [];



    public function groups(){

        return $this->belongsToMany(Groups::class,'group_movements','activity_id','group_id', 'id','id')
            ->with('group_movement')->where('group_movements.status','=','in');
    }

    public function group_movements_today(){

        return $this->hasMany(GroupMovement::class,'activity_id','id')
            ->whereDate('date_time', Carbon::now()->format('Y-m-d'))
            ->where('status','=','in');
    }

    public function last_active_group_movement(){

        return $this->hasMany(GroupMovement::class,'activity_id','id')
            ->whereDate('date_time', Carbon::now()->format('Y-m-d'))
            ->where('status','=','in')->orderBy('date_time','desc');
    }

}
