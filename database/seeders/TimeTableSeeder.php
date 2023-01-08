<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TimeTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('time')->delete();
        
        \DB::table('time')->insert(array (
            0 => 
            array (
                'id' => 1,
                'day' => 'monday',
                'open_time' => '12:00am',
                'break_start' => '1:00pm',
                'break_end' => '1:00pm',
                'close_time' => '11:59pm',
                'always_close' => 2,
                'created_at' => '2022-07-30 13:33:12',
                'updated_at' => '2022-07-30 20:33:12',
            ),
            1 => 
            array (
                'id' => 2,
                'day' => 'tuesday',
                'open_time' => '12:00am',
                'break_start' => '1:00pm',
                'break_end' => '1:00pm',
                'close_time' => '11:59pm',
                'always_close' => 2,
                'created_at' => '2022-07-30 13:33:12',
                'updated_at' => '2022-07-30 20:33:12',
            ),
            2 => 
            array (
                'id' => 3,
                'day' => 'wednesday',
                'open_time' => '12:00am',
                'break_start' => '1:00pm',
                'break_end' => '1:00pm',
                'close_time' => '11:59pm',
                'always_close' => 2,
                'created_at' => '2022-07-30 13:33:12',
                'updated_at' => '2022-07-30 20:33:12',
            ),
            3 => 
            array (
                'id' => 4,
                'day' => 'thursday',
                'open_time' => '12:00am',
                'break_start' => '1:00pm',
                'break_end' => '1:00pm',
                'close_time' => '11:59pm',
                'always_close' => 2,
                'created_at' => '2022-07-30 13:33:12',
                'updated_at' => '2022-07-30 20:33:12',
            ),
            4 => 
            array (
                'id' => 5,
                'day' => 'friday',
                'open_time' => '12:00am',
                'break_start' => '1:00pm',
                'break_end' => '1:00pm',
                'close_time' => '11:59pm',
                'always_close' => 2,
                'created_at' => '2022-07-30 13:33:12',
                'updated_at' => '2022-07-30 20:33:12',
            ),
            5 => 
            array (
                'id' => 6,
                'day' => 'saturday',
                'open_time' => '12:00am',
                'break_start' => '1:00pm',
                'break_end' => '1:00pm',
                'close_time' => '11:59pm',
                'always_close' => 2,
                'created_at' => '2022-07-30 13:33:12',
                'updated_at' => '2022-07-30 20:33:12',
            ),
            6 => 
            array (
                'id' => 7,
                'day' => 'sunday',
                'open_time' => '12:00am',
                'break_start' => '1:00pm',
                'break_end' => '1:00pm',
                'close_time' => '11:59pm',
                'always_close' => 2,
                'created_at' => '2022-07-30 13:33:12',
                'updated_at' => '2022-07-30 20:33:12',
            ),
        ));
        
        
    }
}