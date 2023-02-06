<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activities';

    protected $guarded = [];


    public function groups(){

        return $this->belongsToMany(Groups::class,'group_movements','activity_id','group_id', 'id','id');
    }

    public function group_movements_today(){

        return $this->hasMany(GroupMovement::class,'activity_id','id')
            ->whereDate('date_time', Carbon::now()->format('Y-m-d'))
            ->where('status','=','in');
    }






}
