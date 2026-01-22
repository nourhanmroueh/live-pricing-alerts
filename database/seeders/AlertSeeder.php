<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Alert;

class AlertSeeder extends Seeder
{
    public function run(): void
    {
        // FK-safe delete
        Alert::query()->delete();

        Alert::insert([
            // BTCUSDT alerts
            [
                'symbol' => 'BTCUSDT',
                'condition' => 'greater_than',
                'target_price' => 42000,
                'is_triggered' => false,
            ],
            [
                'symbol' => 'BTCUSDT',
                'condition' => 'less_than',
                'target_price' => 41800,
                'is_triggered' => false,
            ],

            // EURUSD alerts
            [
                'symbol' => 'EURUSD',
                'condition' => 'greater_than',
                'target_price' => 1.0900,
                'is_triggered' => false,
            ],
            [
                'symbol' => 'EURUSD',
                'condition' => 'less_than',
                'target_price' => 1.0800,
                'is_triggered' => false,
            ],
        ]);
    }
}
