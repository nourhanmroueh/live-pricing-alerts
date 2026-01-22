<?php

namespace App\Services;

use App\Models\Alert;
use App\Models\AlertLog;
use App\Models\Price;
use Carbon\Carbon;

class AlertEvaluator
{
    public function evaluate(Price $price): void
    {
        $alerts = Alert::where('symbol', $price->symbol)
            ->where('is_triggered', false)
            ->get();

        foreach ($alerts as $alert) {
            if ($this->shouldTrigger($alert, $price->price)) {
                $this->triggerAlert($alert, $price->price);
            }
        }
    }

    private function shouldTrigger(Alert $alert, float $currentPrice): bool
    {
        return match ($alert->condition) {
            'greater_than' => $currentPrice > $alert->target_price,
            'less_than'    => $currentPrice < $alert->target_price,
            default        => false,
        };
    }

    private function triggerAlert(Alert $alert, float $price): void
    {
        $alert->update([
            'is_triggered' => true,
            'triggered_at' => Carbon::now(),
        ]);

        AlertLog::create([
            'alert_id'        => $alert->id,
            'price_at_trigger'=> $price,
            'triggered_at'    => Carbon::now(),
        ]);
    }
}
