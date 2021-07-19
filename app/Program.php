<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'description',
        'more_info',
        'criteria',
        'award_of_degree',
        'userid',	
        'universityid',
        'departmentid',
        'deleted',
        'status',
        'created_at',
        'updated_at'

    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userid', 'id');
    }
    public function universityInformation()
    {
        return $this->belongsTo(UniversityInformation::class, 'universityid', 'id');
    }
    public function department()
    {
        return $this->belongsTo(Department::class, 'departmentid', 'id');
    }
    public function eligibility()
    {
        return $this->hasMany(Eligibility::class, 'programid', 'id');
    }

    public function universityAddmission()
    {
        return $this->hasMany(UniversityAddmission::class, 'programid', 'id');
    }
}
