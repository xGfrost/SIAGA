<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MeasurementSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 0; $i < 30; $i++) {
            DB::table('measurements')->insert([
                'water_level_cm' => rand(10, 200),
                'rainfall_mm' => rand(0, 100),
                'created_at' => Carbon::now()
                    ->subDays($i)
                    ->setTime(rand(0, 23), rand(0, 59), rand(0, 59)),
            ]);
        }
    }
}
