<?php

namespace App\Models;

use Carbon\Carbon;
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


    public function scopeGroupColored($query){

        $query->with(['group' => function ($group){
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


    public function scopeGroupNotColored($query){

        $query->with(['group' => function ($group){
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
            ->where('color','=',NULL)->whereDate('created_at','=',Carbon::now()->format('Y-m-d'));

    }

}
