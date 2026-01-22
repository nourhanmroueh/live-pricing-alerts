<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AlertLog extends Model
{
    protected $fillable = [
        'alert_id',
        'price_at_trigger',
        'triggered_at',
    ];

    protected $casts = [
        'price_at_trigger' => 'decimal:8',
        'triggered_at' => 'datetime',
    ];

    public function alert(): BelongsTo
    {
        return $this->belongsTo(Alert::class);
    }
}
