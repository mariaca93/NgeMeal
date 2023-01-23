<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('faq')->insert([
            [
                'title' => '7. How to cancel my ongoing order(s)?',
                'description' => 'Step 1 : Click ongoing order menu.
                Step 2 : Click on the trashcan icon on the left-hand side of your ongoing order.'
            ],
            [
                'title' => '6. How to check my ongoing order(s)?',
                'description' => 'Step 1 : Click ongoing order menu.
                Step 2 : Check your ongoing order from the given list.'
            ],
            [
                'title' => '5. How to search meal(s) by ingredient(s)?',
                'description' => 'Step 1 : Click search icon on the top-right corner of NgeMeal website.
                Step 2 : Click the "Ingredient"-labelled button.
                Step 3 : Type the meal\'s ingredient(s).
                Step 4 : Submit the meal\'s ingredient(s) by clicking enter on your keyboard or click the search icon on the left hand side of the search bar.'
            ],
            [
                'title' => '4. How to search meal(s) by name?',
                'description' => 'Step 1 : Click the search icon on the top-right corner of NgeMeal website.
                Step 2 : Click the "Name"-labelled button.
                Step 3 : Type any meal\'s name.
                Step 4 : Submit the meal\'s name by clicking enter on your keyboard or click the search icon on the left hand side of the search bar.'
            ],
            [
                'title' => '3. How to update my profile?',
                'description' => 'Step 1 : Click profile bbutton on the top-right corner of NgeMeal website.
                Step 2 : Update your information (photo or full name).
                Step 3 : Click Submit to save your changes.'
            ],
            [
                'title' => '2. How to make an account in NgeMeal?',
                'description' => 'Step 1 : Click button login on top of home page.
                Step 2 : Click button signup.
                Step 3 : Fill in required field (full name, email, mobile, password, and confirm password).
                Step 4 : Check the checkbox to accept terms & conditions.
                Step 5 : Click button signup.'
            ],
            [
                'title' => '1. How to login to NgeMeal?',
                'description' => 'Step 1 : Click button login on top of home page.
                Step 2 : Fill in required field (email and password).
                Step 3 : Click button login.'
            ]
            ]);
    }
}
