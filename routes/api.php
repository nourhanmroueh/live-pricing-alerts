<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PriceController;
use App\Models\Alert;
use App\Models\Price;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/prices', [PriceController::class, 'store']);
Route::get('/status', function () {
    $prices = \App\Models\Price::select('symbol', 'price')
        ->orderByDesc('id')
        ->get()
        ->groupBy('symbol')
        ->map(fn ($rows) => $rows->first())
        ->values();

    return response()->json([
        'prices' => $prices,
        'alerts' => \App\Models\Alert::orderBy('symbol')->get(),
    ]);
});
