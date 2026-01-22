<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $fillable = [
        'symbol',
        'price',
        'source',
    ];

    protected $casts = [
        'price' => 'decimal:8',
    ];
}
