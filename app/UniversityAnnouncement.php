<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UniversityAnnouncement extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'title',
        'description',
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
    public function universityInformation()
    {
        return $this->belongsTo(UniversityInformation::class, 'universityid', 'id');
    }
}
