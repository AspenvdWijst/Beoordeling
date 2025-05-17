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
        return $this->belongsToMany(User::class, 'subject_student', 'subject_id', 'student_id');
    }

    public function teachers()
    {
        return $this->belongsToMany(User::class);
    }
}
