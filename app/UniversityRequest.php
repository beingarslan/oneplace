<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UniversityRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'university_name',
        'university_email',
        'university_address',
        'university_website',
        'description',
        'letter',
        'deleted',
        'status',
        'created_at',
        'updated_at'
    ];
}
