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
        return $this->belongsToMany(User::class);
    }

    public function teachers()
    {
        return $this->belongsToMany(User::class, 'subject_teacher', 'teacher_id', 'subject_id');
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }
}
