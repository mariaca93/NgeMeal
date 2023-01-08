<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('item')->insert([
            [
                'cuisine_id' => 4,
                'subcuisine_id' => 4,
                'item_name' => "Indonesian Fried Rice",
                'image' => 'fried-rice-1.jpg',
                'weather_id' => '1',
                'addons_id' => '1,2',
                'slug' => 'ind-fried-rice',
                'item_type' => 1,
                'has_variation' => 2,
                'price' => '12000',
                'item_description' => 'test',
                'preparation_time' => '15',
                'is_featured' => 1
            ],
            [
                'cuisine_id' => 5,
                'subcuisine_id' => 5,
                'item_name' => "Margharita Pizza",
                'image' => 'pizza-1.jpg',
                'weather_id' => '1',
                'addons_id' => '1,4,5',
                'slug' => 'marghariza-pizza',
                'item_type' => 2,
                'has_variation' => 2,
                'price' => '20000',
                'item_description' => 'Margharita Pizza',
                'preparation_time' => '15',
                'is_featured' => 1
            ]
            ]);
    }
}


// chema::create('item', function (Blueprint $table) {
//     $table->comment('');
//     $table->bigIncrements('id');
//     $table->integer('cuisine_id');
//     $table->integer('subcuisine_id')->comment('subcuisine id from subcuisines table');
//     $table->string('item_name');
//     $table->string('slug');
//     $table->string('image')->nullable();
//     $table->integer('item_type')->comment('1=veg,2=nonveg');
//     $table->integer('has_variation')->comment('1=yes,2=no');
//     $table->string('attribute')->nullable();
//     $table->string('price', 11)->nullable()->default('0');
//     $table->string('addons_id')->nullable();
//     $table->longText('item_description')->nullable();
//     $table->string('preparation_time')->default('0')->comment('In minutes');
//     $table->string('tax');
//     $table->integer('item_status')->default(1)->comment('1 = Yes , 2 = No');
//     $table->integer('is_featured')->nullable()->default(2)->comment('1=yes,2=no');
//     $table->integer('is_deleted')->default(2)->comment('1 = Yes , 2 = No');
//     $table->timestamps();