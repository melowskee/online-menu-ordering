<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->toDateTimeString();

        Category::insert([
            ['name' => 'Burgers', 'slug' => 'burgers', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Beverages', 'slug' => 'beverages', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Combo Meals', 'slug' => 'combo-meals', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
