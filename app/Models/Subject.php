<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['subject_name'];

    public function students()
    {
        return $this->belongsToMany(User::class, 'student_subject', 'subject_id', 'student_id');
    }
    public function teachers()
    {
        return $this->belongsToMany(User::class, 'teacher_subject', 'subject_id', 'teacher_id');
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }
}
