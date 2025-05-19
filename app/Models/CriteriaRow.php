<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CriteriaRow extends Model
{
    protected $fillable = [
        'component',
        'description',
        'insufficient',
        'sufficient',
        'good',
        'points',
        'remarks',
        'order',
    ];

    public function GradingTable(): BelongsTo
    {
        return $this->belongsTo(GradingTable::class);
    }
}
