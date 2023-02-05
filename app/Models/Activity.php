<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activities';

    protected $guarded = [];


    public function groups(){

        return $this->belongsToMany(Groups::class,'group_movements','activity_id','group_id', 'id','id');
    }



}
