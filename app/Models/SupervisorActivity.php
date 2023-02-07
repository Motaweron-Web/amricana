<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupervisorActivity extends Model
{
    protected $table = 'supervisor_activities';

    protected $guarded = '';

    public function supervisors()
    {
        return $this->belongsTo(Supervisor::class,'supervisor_id','id');
    }
}
