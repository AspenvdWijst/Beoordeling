<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = ['subject_id', 'assignment_name', 'assignment_info'];

    public function students()
    {
        return $this->belongsToMany(User::class, 'assignment_student');
    }

    public function grades()
    {
        return $this->hasMany(Grade::class, 'assignment_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function teachers()
    {
        return $this->belongsToMany(User::class, 'assignment_teacher', 'assignment_id', 'teacher_id');
    }
}
