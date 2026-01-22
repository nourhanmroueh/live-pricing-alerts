<?php

namespace App\Http\Controllers;

use App\Models\Price;
use App\Models\Alert;

class DashboardController extends Controller
{
    public function index()
    {
        $latestPrice = Price::where('symbol', 'BTCUSDT')
            ->latest()
            ->first();

        $alerts = Alert::orderBy('created_at', 'desc')->get();

        return view('dashboard', compact('latestPrice', 'alerts'));
    }
}
