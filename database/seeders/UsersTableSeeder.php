<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'mobile' => NULL,
                'profile_image' => 'unknown.png',
                'password' => '$2y$10$8HViCXNNejWwxrIDeS7XWuZuLm8wShvCBpa.v2VmipB6wjzcwOoUO',
                'login_type' => 'email',
                'google_id' => NULL,
                'facebook_id' => NULL,
                'role_id' => NULL,
                'type' => 1,
                'identity_image' => NULL,
                'identity_type' => NULL,
                'identity_number' => NULL,
                'token' => 'f-LadU5sQKSINz_D7JgVtW:APA91bGpXy0_4bDKavbGoc0xZeFLddyeIYETg33UVxBfBc-JQtNSyxRq8AykHCHIK2hhIPbz6uzA9pTSGJ8UaaKGyOXnCYidXmESus79gIbuwTpcgn-1eNIFFTocaOqXvQUwqOxoTbBK',
                'wallet' => '0',
                'referral_code' => NULL,
                'user_id' => NULL,
                'referral_amount' => 0,
                'is_available' => 1,
                'is_online' => 1,
                'is_notification' => NULL,
                'is_mail' => NULL,
                'otp' => NULL,
                'is_verified' => NULL,
                'remember_token' => '0dEuopnHovMOfHbA82q9ohAvX2zWfXZnZCGYo93JiFpkuyeJ9Os4jtfSosOj',
                'created_at' => '2020-06-05 14:21:20',
                'updated_at' => '2022-11-16 12:19:10',
            ),
            0 => 
            array (
                'id' => 2,
                'name' => 'User',
                'email' => 'user@gmail.com',
                'mobile' => NULL,
                'profile_image' => 'unknown.png',
                'password' => bcrypt('12345'),
                'login_type' => 'email',
                'google_id' => NULL,
                'facebook_id' => NULL,
                'role_id' => NULL,
                'type' => 2,
                'identity_image' => NULL,
                'identity_type' => NULL,
                'identity_number' => NULL,
                'token' => 'f-LadU5sQKSINz_D7JgVtW:APA91bGpXy0_4bDKavbGoc0xZeFLddyeIYETg33UVxBfBc-JQtNSyxRq8AykHCHIK2hhIPbz6uzA9pTSGJ8UaaKGyOXnCYidXmESus79gIbuwTpcgn-1eNIFFTocaOqXvQUwqOxoTbBK',
                'wallet' => '0',
                'referral_code' => NULL,
                'user_id' => NULL,
                'referral_amount' => 0,
                'is_available' => 1,
                'is_online' => 1,
                'is_notification' => NULL,
                'is_mail' => NULL,
                'otp' => "1234567890",
                'is_verified' => 1,
                'otp' => NULL,
                'is_verified' => 2,
                'remember_token' => '0dEuopnHovMOfHbA82q9ohAvX2zWfXZnZCGYo93JiFpkuyeJ9Os4jtfSosOj',
                'created_at' => '2020-06-05 14:21:20',
                'updated_at' => '2022-11-16 12:19:10',
            )
        ));
        
        
    }
}