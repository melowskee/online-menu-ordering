<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Coupon;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->toDateTimeString();

        Coupon::insert([
            ['code' => 'GO2018', 'type' => 'sale', 'percent_off' => '10', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
