<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OtpConfigurationTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('otp_configuration')->delete();
        
        \DB::table('otp_configuration')->insert(array (
            0 => 
            array (
                'id' => 1,
                'twilio_sid' => 'Twilio SID',
                'twilio_auth_token' => 'Twilio Auth Token',
                'twilio_mobile_number' => 'Twilio Mobile number',
                'msg_authkey' => NULL,
                'msg_template_id' => NULL,
                'name' => 'twilio',
                'status' => 1,
                'created_at' => '2021-07-25 00:53:44',
                'updated_at' => '2022-11-19 08:31:07',
            ),
            1 => 
            array (
                'id' => 2,
                'twilio_sid' => NULL,
                'twilio_auth_token' => NULL,
                'twilio_mobile_number' => NULL,
                'msg_authkey' => 'msg_authkey',
                'msg_template_id' => 'msg_template_id',
                'name' => 'msg91',
                'status' => 0,
                'created_at' => '2021-07-27 02:26:13',
                'updated_at' => '2022-09-20 21:08:59',
            ),
        ));
        
        
    }
}