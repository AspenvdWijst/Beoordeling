<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GradingFormDraft extends Model
{
    protected $fillable = [
        'title',
        'form_data',
    ];

    protected $casts = [
        'form_data' => 'array',
    ];
}
