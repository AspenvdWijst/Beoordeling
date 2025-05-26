<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GradingResultDraft extends Model
{
    protected $fillable = [
        'grading_form_id',
        'student_id',
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

    public function teachers()
    {
        return $this->belongsToMany(User::class, 'grading_result_draft_teachers', 'grading_result_draft_id', 'teacher_id')
            ->where('role_id', 2);
    }

    public function hasTeacher($teacherId)
    {
        return $this->teachers()->where('teacher_id', $teacherId)->exists();
    }

    public function getTeacherIdsAttribute()
    {
        return $this->teachers()->pluck('teacher_id')->toArray();
    }
}
