<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AboutTableSeeder::class);
        $this->call(FooterFeaturesTableSeeder::class);
        $this->call(ItemSeeder::class);
        $this->call(MigrationsTableSeeder::class);
        $this->call(PaymentTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(SliderSeeder::class);
        $this->call(CuisineSeeder::class);
        $this->call(SubcuisineSeeder::class);
        $this->call(ItemImagesSeeder::class);
        $this->call(AddonSeeder::class);
        $this->call(IngredientSeeder::class);
        $this->call(ItemIngredientSeeder::class);
        $this->call(SubscriptionSeeder::class);
        $this->call(WeatherSeeder::class);
    }
}
