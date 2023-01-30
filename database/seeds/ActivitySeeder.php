<?php

use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){

        $activities = [

            "غرفه الملكه حتشبسوت",
            "غرفه الملك رمسيس",
            "غرفه الملكه كيلوباترا",
        ];


        foreach ($activities as $activity){

            \App\Models\Activity::create([
                'title' => $activity,
                'photo'  => 'assets/uploads/activities/hall.jpg',
            ]);
        }

    }
}
