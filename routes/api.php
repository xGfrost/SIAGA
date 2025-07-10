<?php
use App\Http\Controllers\Api\MeasurementController;
use Illuminate\Support\Facades\Route;

Route::prefix('measurements')->group(function () {
    Route::post('/', [MeasurementController::class, 'store']);       // Tambah data
});


