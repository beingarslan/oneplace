<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UniversitySocial extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'url',
        'socialid',
        'userid',
        'universityid',
        'deleted',
        'status',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userid', 'id');
    }
    public function social()
    {
        return $this->belongsTo(Social::class, 'socialid', 'id');
    }
    public function universityInformation()
    {
        return $this->belongsTo(UniversityInformation::class, 'universityid', 'id');
    }
}
