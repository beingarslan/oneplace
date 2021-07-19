<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'icon',
        'name',
        'tag',
        'deleted',
        'status',
        'created_at',
        'updated_at'
    ];

    public function universitySocial()
    {
        return $this->hasMany(UniversitySocial::class, 'socialid', 'id');
    }
}
