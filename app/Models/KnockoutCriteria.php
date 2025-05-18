<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KnockoutCriteria extends Model
{
    protected $fillable = [
        'text',
        'checked',
        'order',
    ];

    protected $casts = [
        'checked' => 'boolean',
    ];

    public function criteriaAnalysis(): BelongsTo
    {
        return $this->belongsTo(GradingTable::class);
    }
}
