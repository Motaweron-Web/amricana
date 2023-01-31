<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupColor extends Model{

    protected $table = 'group_colors';

    protected $fillable = [
        'group_id',
        'color',
        'date_time'
    ];


    public function group(){

        return $this->belongsTo(Groups::class,'group_id','id');
    }
}
