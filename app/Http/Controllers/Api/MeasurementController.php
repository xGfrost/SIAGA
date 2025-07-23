<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Measurement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MeasurementController extends Controller
{
    public function index()
    {
        return response()->json(Measurement::orderBy('created_at', 'desc')->get());
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'water_level_cm' => 'numeric',
        'rainfall_mm' => 'numeric',
    ]);

    $measurement = Measurement::create($validated);

    if ($measurement->water_level_cm >= 10) {
        $response = Http::withHeaders([
            'Authorization' => 'Ym1nx6mH6AXQBLT9yCJ1',
        ])->post('https://api.fonnte.com/send', [
            'target' => '6281233503740',
            'message' => 'Warning! Ketinggian air telah mencapai ' . $measurement->water_level_cm . ' cm di RT 5/RW 6 Kelurahan Bendul Merisi.',
        ]);
    }

    return response()->json([
        'message' => 'Measurement created successfully',
        'data' => $measurement
    ], 201);
}

}
