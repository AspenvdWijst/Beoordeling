<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GradingTable extends Model
{
    protected $fillable = [
        'title',
        'description_1',
        'description_2',
        'deliverable_text',
        'deliverable_checked',
        'max_points',
        'min_points',
        'point_range'
    ];

    public function form() {
        return $this->belongsTo(GradingForm::class);
    }

    public function criteriaRows(): HasMany
    {
        return $this->hasMany(CriteriaRow::class)->orderBy('order');
    }

    public function knockoutCriteria(): HasMany
    {
        return $this->hasMany(KnockoutCriteria::class)->orderBy('order');
    }
}
