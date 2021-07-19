<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'image',
        'full_name',
        'dob',
        'phone',
        'city',
        'address',
        'gender',
        'ssc_degree',
        'ssc_board',
        'ssc_institue',
        'ssc_passing_year',
        'ssc_roll_number',
        'ssc_obt_marks',
        'ssc_total_marks',
        'ssc_document',
        'hssc_degree',
        'hssc_group',
        'hssc_board',
        'hssc_institue',
        'hssc_passing_year',
        'hssc_roll_number',
        'hssc_obt_marks',
        'hssc_total_marks',
        'hssc_document',
        'deleted',
        'status',
        'userid',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userid', 'id');
    }
}
