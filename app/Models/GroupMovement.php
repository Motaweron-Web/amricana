<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class GroupMovement extends Model
{
    protected $table = 'group_movements';
    protected $fillable = ['supervisor_accept_id','group_id','activity_id','date_time','accept','status'];


    public function supervisor(){

        return $this->belongsTo(Supervisor::class,'supervisor_accept_id','id');

    }

    public function group(){

        return $this->belongsTo(Groups::class,'group_id','id');

    }

    public function activity(){

        return $this->belongsTo(Activity::class,'activity_id','id');

    }
}
