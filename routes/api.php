<?php
use App\Http\Controllers\Api\MeasurementController;
use Illuminate\Support\Facades\Route;

Route::apiResource('measurements', MeasurementController::class);


