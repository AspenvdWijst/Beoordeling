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
        return $this->belongsToMany(User::class);
    }

    public function grades()
    {
        return $this->belongsToMany(Grade::class);
    }
}
