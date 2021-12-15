<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Burgers
        $burgers = ['Hotdog', 'Cheese Burger', 'Fries'];
        foreach ($burgers as $burger) {
            Product::create([
                'name' =>  $burger,
                'slug' =>  strtolower(str_replace(" ","-",$burger)),
                'description' => 'Yummy '.$burger,
                'price' => rand(50, 100),
                'image' => 'products/'.strtolower(str_replace(" ","-",$burger)).'.jpg',
            ])->categories()->attach(1);
        }

        // Beverages
        $beverages = ['Coke', 'Sprite', 'Tea'];
        foreach ($beverages as $beverage) {
            Product::create([
                'name' =>  $beverage,
                'slug' =>  strtolower(str_replace(" ","-",$beverage)),
                'description' => 'Yummy '.$beverage,
                'price' => 30,
                'image' => 'products/'.strtolower(str_replace(" ","-",$beverage)).'.jpg',
            ])->categories()->attach(2);
        }

        // Combo Meals
        $combo_meals = ['Chicken Combo', 'Pork Combo', 'Fish Combo'];
        foreach ($combo_meals as $combo_meal) {
            Product::create([
                'name' =>  $combo_meal,
                'slug' =>  strtolower(str_replace(" ","-",$combo_meal)),
                'description' => 'Yummy '.$combo_meal,
                'price' => rand(50, 100),
                'image' => 'products/'.strtolower(str_replace(" ","-",$combo_meal)).'.jpg',
            ])->categories()->attach(3);
        }
    }
}
