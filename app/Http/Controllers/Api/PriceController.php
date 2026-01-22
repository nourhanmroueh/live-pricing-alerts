<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Price;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\AlertEvaluator;

class PriceController extends Controller
{
    public function store(Request $request): JsonResponse
{
    $validated = $request->validate([
        'symbol' => 'required|string|max:32',
        'price'  => 'required|numeric|min:0',
        'source' => 'nullable|string|max:64',
    ]);

    $price = Price::create([
        'symbol' => strtoupper($validated['symbol']),
        'price'  => $validated['price'],
        'source' => $validated['source'] ?? 'python',
    ]);

    // 🔔 Evaluate alerts
    app(AlertEvaluator::class)->evaluate($price);

    return response()->json([
        'status' => 'success',
        'data'   => $price,
    ], 201);
}

}
