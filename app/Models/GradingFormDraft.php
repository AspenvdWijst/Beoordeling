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

//    public function teachers()
//    {
//        return $this->belongsToMany(User::class, 'grading_form_draft_teacher', 'grading_form_draft_id', 'teacher_id');
//    }
}
