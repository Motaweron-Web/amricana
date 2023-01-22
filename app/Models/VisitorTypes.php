<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class VisitorTypes extends Model
{

    protected $guarded = [];

    public function shifts(){
        return $this->belongsToMany(Shifts::class,'shifts','visitor_type_id','shift_id');
    }

    public function top_up()
    {
        return $this->hasOne(TopUpPrice::class,'type_id');
    }//end fun

    public function event()
    {
        return $this->belongsTo(Event::class,'event_id');
    }//end fun


    //many to many relation for visitor places
    public function visitor_type_places(){

        return $this->belongsToMany(VisitorPlace::class,'visitor_places_models','visitor_type_id','visitor_place_id','id','id');
    }

}//end class
