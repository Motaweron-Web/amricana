<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Supervisor extends Authenticatable
{
    use HasRoles;
//    protected $connection = 'sqlite';
     protected $table = 'supervisors';


    protected $guarded = [];
    protected $hidden = [
        'password',
    ];

    public function supervisors(){

        return $this->hasMany(GroupMovement::class,'supervisor_accept_id ', 'id');
    }


}
