<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UniversityInformation extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'logo',
        'cover',
        'name',
        'username',
        'about',
        'email',
        'address',
        'date_of_established',
        'primary_phone',
        'website',
        'userid',
        'deleted',
        'status',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userid', 'id');
    }

    public function department()
    {
        return $this->hasMany(Department::class, 'universityid', 'id');
    }
    public function eligibility()
    {
        return $this->hasMany(Eligibility::class, 'universityid', 'id');
    }
    public function program()
    {
        return $this->hasMany(Program::class, 'universityid', 'id');
    }
    public function universitySocial()
    {
        return $this->hasMany(UniversitySocial::class, 'universityid', 'id');
    }
    public function universityAnnouncement()
    {
        return $this->hasMany(UniversityAnnouncement::class, 'universityid', 'id');
    }
}
