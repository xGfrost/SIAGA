<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $dummyData = [
        [
            'id' => 1,
            'water_level_cm' => 120.5,
            'rainfall_mm' => 15.2,
            'created_at' => now()->subMinutes(3),
        ],
        [
            'id' => 2,
            'water_level_cm' => 121.3,
            'rainfall_mm' => 14.7,
            'created_at' => now()->subMinutes(2),
        ],
        [
            'id' => 3,
            'water_level_cm' => 123.0,
            'rainfall_mm' => 13.1,
            'created_at' => now()->subMinute(),
        ],
    ];
    return view('welcome', ['measurements' => $dummyData]);
});

Route::get('send-wa', function(){
    $response = Http::withHeaders([
        'Authorization' => 'Ym1nx6mH6AXQBLT9yCJ1',
    ])->post('https://api.fonnte.com/send', [
        'target' => '6285755842855',
        'message' => 'Waspada banjir',
    ]);

    dd(json_decode($response, true));
});
