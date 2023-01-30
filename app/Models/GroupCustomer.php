<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupCustomer extends Model
{

    protected $table = 'group_customers';
    protected $fillable = [

        'ticket_id',
        'group_id',
        'rev_id',
        'date_time',
        'quantity',
        'sale_type'
    ];


    public function ticket(){

        return $this->belongsTo(Ticket::class,'ticket_id','id');
    }

    public function reservation(){

        return $this->belongsTo(Reservations::class,'rev_id','id');
    }

    public function group(){

        return $this->belongsTo(Groups::class,'group_id','id');

    }
}
