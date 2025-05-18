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
        'grading_date'
//        'student_id',
//        'teacher_id',
//        'subject_id',
    ];

    public function tables() {
        return $this->hasMany(GradingTable::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function teacher()
    {
        return $this->belongsToMany(User::class, 'teacher_id');
    }
}
