<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GradingResultDraft extends Model
{
    protected $fillable = [
        'grading_form_id',
        'student_id',
        'teacher_id',
        'draft_data',
    ];

    protected $casts = [
        'draft_data' => 'array',
    ];

    public function gradingForm()
    {
        return $this->belongsTo(GradingForm::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id')->where('role_id', 1);
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id')->where('role_id', 2);
    }
}
