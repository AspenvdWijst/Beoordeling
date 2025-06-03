<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GradingForm extends Model
{
    protected $fillable = [
        'title',
        'student_name',
        'student_number',
        'company_name',
        'company_place',
        'start_period',
        'end_period',
        'oe_code',
        'title_assignment',
        'retry',
        'grading_date',
        'assignment_id'
    ];

    public function tables() {
        return $this->hasMany(GradingTable::class);
    }

    public function assignment() {
        return $this->belongsTo(Assignment::class);
    }
}
