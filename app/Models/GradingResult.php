<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GradingResult extends Model
{
    protected $fillable = [
        'grading_form_id',
        'student_id',
        'form_data',
    ];

    protected $casts = [
        'form_data' => 'array',
    ];
    public function gradingForm()
    {
        return $this->belongsTo(GradingForm::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id')->where('role_id', 1);
    }
}
