<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitorPlace extends Model{

     protected $table = 'visitor_places';

     protected $fillable = [
         'title',
         'description'
     ];

    //many to many relation for visitor types
    public function visitor_types(){

        return $this->belongsToMany(VisitorTypes::class,'visitor_places_models','visitor_place_id','visitor_type_id','id','id');
    }
}
