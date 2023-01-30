<?php

use Illuminate\Database\Seeder;

class GroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        for ($i=1;$i<=40;$i++){

            \App\Models\Groups::create([

                'title' => 'Group' . $i,
                'color' => '#fff'
            ]);
        }
    }
}
