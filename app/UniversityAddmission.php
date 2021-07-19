<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UniversityAddmission extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'description',
        'cover',
        'userid',
        'programid',
        'deleted',
        'status',
        'created_at',
        'updated_at'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'userid', 'id');
    }
    public function program()
    {
        return $this->belongsTo(Program::class, 'programid', 'id');
    }
    public function appliedAdmission()
    {
        return $this->hasMany(AppliedAdmission::class, 'university_addmissionid', 'id');
    }
}
