<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eligibility extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'degree',
        'marks',
        'description',
        'userid',
        'universityid',
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
    public function universityInformation()
    {
        return $this->belongsTo(UniversityInformation::class, 'universityid', 'id');
    }
    public function program()
    {
        return $this->belongsTo(Program::class, 'programid', 'id');
    }
}
