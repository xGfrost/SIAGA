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
        'message' => 'Warning! Ketinggian air telah mencappai 10 cm di RT 5/RW 6 Kelurahan Bendul Merisi.',
    ]);

    dd(json_decode($response, true));
});
