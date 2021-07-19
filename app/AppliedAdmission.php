<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppliedAdmission extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'deleted',
        'status',
        'university_addmissionid',
        'userid',
        'created_at',
        'updated_at',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'userid', 'id');
    }
    public function universityAddmission()
    {
        return $this->belongsTo(UniversityAddmission::class, 'university_addmissionid', 'id');
    }
}
