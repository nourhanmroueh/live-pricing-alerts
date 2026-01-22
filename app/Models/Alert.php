<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Alert extends Model
{
    protected $fillable = [
        'symbol',
        'condition',
        'target_price',
        'is_triggered',
        'triggered_at',
    ];

    protected $casts = [
        'target_price' => 'decimal:8',
        'is_triggered' => 'boolean',
        'triggered_at' => 'datetime',
    ];

    public function logs(): HasMany
    {
        return $this->hasMany(AlertLog::class);
    }
}
