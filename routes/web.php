<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('send-wa', function(){
    $response = Http::withHeaders([
        'Authorization' => 'Ym1nx6mH6AXQBLT9yCJ1',
    ])->post('https://api.fonnte.com/send', [
        'target' => '6281233503740',
        'message' => 'Waspada banjir',
    ]);

    dd(json_decode($response, true));
});
