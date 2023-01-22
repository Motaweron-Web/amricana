<?php

namespace App\Console\Commands;

use App\Models\TicketRevModel;
use Illuminate\Console\Command;

class ExitChildren extends Command{

    protected $signature = 'exit:children';

    protected $description = 'ExitChildren every 11:50 pm';


    public function __construct(){

        parent::__construct();
    }


    public function handle(){


        $children_ids = TicketRevModel::where('temp_status','=','in')->pluck('id');

        foreach ($children_ids as $id){

            TicketRevModel::where('id','=',$id)->update([

                'temp_status' => 'out'

            ]);


        }
    }
}
