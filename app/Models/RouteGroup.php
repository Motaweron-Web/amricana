<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RouteGroup extends Model
{
    protected $table = 'routes';
    protected $fillable = ['time_group','group_id','activity_id'];

    public function group(){

        return $this->belongsTo(Groups::class,'group_id','id');
    }


    public function activity(){

        return $this->belongsTo(Activity::class,'activity_id','id');
    }
}
