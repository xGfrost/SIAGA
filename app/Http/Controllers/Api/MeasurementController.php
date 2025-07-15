<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Measurement;
use Illuminate\Http\Request;

class MeasurementController extends Controller
{
    public function index()
    {
        return response()->json(Measurement::orderBy('created_at', 'desc')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'water_level_cm' => 'required|numeric',
            'rainfall_mm' => 'required|numeric',
        ]);

        $measurement = Measurement::create($validated);

        return response()->json([
            'message' => 'Measurement created successfully',
            'data' => $measurement
        ], 201);
    }
}
