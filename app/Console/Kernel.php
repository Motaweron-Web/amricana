<?php

namespace App\Console;

use App\Console\Commands\ExitChildren;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel{

    protected $commands = [ExitChildren::class];


    protected function schedule(Schedule $schedule){

         $schedule->command('exit:children')->dailyAt('23:50');
    }


    protected function commands(){

        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
