<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PrivacypolicyTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('privacypolicy')->delete();
        
        \DB::table('privacypolicy')->insert(array (
            0 => 
            array (
                'id' => 1,
                'privacypolicy_content' => '<p><strong><img alt="" src="https://gravityinfotech.net/project/single-restaurant/storage/app/public/admin-assets/images/item/item-6253be720bc03.jpg" style="height:440px; width:600px" /><br />
Lorem Ipsum PrivacyPolicies</strong></p>

<p>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,</p>

<p>remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

<p>remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>',
                'created_at' => '2020-10-13 19:37:35',
                'updated_at' => '2022-07-30 17:59:11',
            ),
        ));
        
        
    }
}