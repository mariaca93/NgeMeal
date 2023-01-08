<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MigrationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('migrations')->delete();
        
        \DB::table('migrations')->insert(array (
            0 => 
            array (
                'id' => 1,
                'migration' => '2014_10_12_000000_create_users_table',
                'batch' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'migration' => '2014_10_12_100000_create_password_resets_table',
                'batch' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'migration' => '2019_08_19_000000_create_failed_jobs_table',
                'batch' => 1,
            ),
            3 => 
            array (
                'id' => 6,
                'migration' => '2020_06_05_070854_create_cuisines_table',
                'batch' => 2,
            ),
            4 => 
            array (
                'id' => 7,
                'migration' => '2020_06_05_103122_create_item_table',
                'batch' => 3,
            ),
            5 => 
            array (
                'id' => 9,
                'migration' => '2020_06_05_110205_create_item_images_table',
                'batch' => 4,
            ),
            6 => 
            array (
                'id' => 10,
                'migration' => '2020_06_05_125414_create_ingredients_table',
                'batch' => 5,
            ),
            7 => 
            array (
                'id' => 14,
                'migration' => '2020_06_06_055110_create_cart_table',
                'batch' => 6,
            ),
            8 => 
            array (
                'id' => 16,
                'migration' => '2020_06_07_051607_create_order_table',
                'batch' => 7,
            ),
            9 => 
            array (
                'id' => 18,
                'migration' => '2020_06_07_063234_create_order_details_table',
                'batch' => 8,
            ),
            10 => 
            array (
                'id' => 19,
                'migration' => '2020_06_16_094849_create_ratting_table',
                'batch' => 9,
            ),
            11 => 
            array (
                'id' => 20,
                'migration' => '2022_05_06_115647_create_roles_table',
                'batch' => 10,
            ),
            12 => 
            array (
                'id' => 21,
                'migration' => '2022_05_19_042851_create_subcuisines_table',
                'batch' => 11,
            ),
            13 => 
            array (
                'id' => 22,
                'migration' => '2022_05_25_053255_create_blogs_table',
                'batch' => 12,
            ),
            14 => 
            array (
                'id' => 23,
                'migration' => '2022_05_25_072838_create_teams_table',
                'batch' => 13,
            ),
            15 => 
            array (
                'id' => 24,
                'migration' => '2022_05_25_100726_create_tutorials_table',
                'batch' => 14,
            ),
            16 => 
            array (
                'id' => 25,
                'migration' => '2022_05_25_105457_create_faqs_table',
                'batch' => 15,
            ),
            17 => 
            array (
                'id' => 26,
                'migration' => '2022_05_25_110626_create_galleries_table',
                'batch' => 16,
            ),
            18 => 
            array (
                'id' => 27,
                'migration' => '2022_05_27_084728_create_zones_table',
                'batch' => 17,
            ),
            19 => 
            array (
                'id' => 29,
                'migration' => '2022_06_18_074001_create_bookings_table',
                'batch' => 18,
            ),
        ));
        
        
    }
}