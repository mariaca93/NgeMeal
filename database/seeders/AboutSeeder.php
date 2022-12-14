<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * 
     */
    public function run()
    {
        DB::table('about')->insert([
            'id' => 1,
            'maintenance_mode' => 2,
            'about_content' => '<p><strong><img alt=\"\" src=\"https://via.placeholder.col/500\" /><br />\r\nLorem is About content</strong><br />\r\n<br />\r\nAbout is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&=> 39;s standard dummy text ever since the 1500s',
            'fb' => 'https://www.facebook.com/Gravity-Infotech-108536971111610',
            'youtube' => 'https://www.youtube.com/channel/UCm3rAUYzqSNcoIUsyjBWN9g',
            'insta' => 'https://www.instagram.com/gravity__infotech/',
            'android' => 'https://play.google.com/store/apps',
            'ios' => 'https://www.apple.com/in/itunes/',
            'app_bottom_image' => 'app_bottom_image-62e129820809a.png',
            'mobile_app_image' => 'mobile_app_image-62e3b6a60bdcd.png',
            'mobile_app_title' => 'Single Restaurant Food Ordering App',
            'mobile_app_description' => 'Experience the revolutionised & user-friendly top online food ordering system to skyrocket Food & Beverages sales.',
            'copyright' => 'Copyright © 2021-2022. Designed & Developed by Gravity Infotech',
            'title' => 'Single Restaurant',
            'short_title' => 'Single Restaurant',
            'og_title' => 'Single restaurant food ordering Website and Mobile App with Admin Panel',
            'og_description' => 'Restaurant Website is a catalyst for the food industry. The website lets you (a restaurateur) connect with the customers who wish to either get food delivered or pick-up food. The website lets you track customers’ order till the food delivery. With this website you can easily manage the entire restaurant food business to achieve maximum growth.',
            'mobile' => '+917016428845',
            'email' => 'infotechgravitygmail.com',
            'address' => 'Green Road, Uttran, Surat, Gujarat, India',
            'currency' => '$',
            'currency_position' => 1,
            'max_order_qty' => 10000000,
            'min_order_amount' => 0,
            'max_order_amount' => 10000000,
            'delivery_charge' => 5,
            'map' => 'Map key',
            'firebase' => 'Firebase Key',
            'referral_amount' => 30,
            'timezone' => 'Asia/Kolkata',
            'lat' => '21.2351933',
            'lang' => '72.85922029999999',
            'image' => 'about-610a3158acf2a.jpg',
            'logo' => 'logo-62b93426e9463.png',
            'footer_title' => 'The Best Restaurants in Your Town.',
            'footer_description' => 'Lorem ipsum dolor sit amet ectetur adipiscing elit. Pharetra a phasellus mattis mi arcu urna Pharetra a phasellu',
            'footer_logo' => 'footer-62b93426e8bb2.png',
            'footer_bg_image' => 'footer_bg_image-63739314e14b4.jpg',
            'favicon' => 'favicon-6375fdb2d5d7c.png',
            'og_image' => 'og_image-62e3b84c9ecd4.png',
            'auth_bg_image' => 'auth_bg_image-6373941ba3c7e.jpg',
            'breadcrumb_bg_image' => 'breadcrumb_bg_image-6373941bb24ff.jpg',
            'booknow_bg_image' => 'booknow_bg_image-637393cd7c886.png',
            'reviews_bg_image' => 'reviews_bg_image-6373938f33b3e.png',
            'mobile_app_bg_image' => 'mobile_app_bg_image-637393b08f1aa.png',
            'verification' => 'mobile',
            'current_version' => '8.0', 
        ]
        );
    }
}
