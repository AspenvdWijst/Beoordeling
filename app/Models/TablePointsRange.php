<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TablePointsRange extends Model
{
    protected $fillable = [
        'label',
        'min_points',
        'max_points',
    ];

    public function gradingTable():BelongsTo
    {
        return $this->belongsTo(GradingTable::class);
    }
}
