<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Candidate extends Model
{

    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'experience_years',
        'skills',
        'education',
        'resume_path',
    ];

    protected $table = 'candidates'; // Specify the table name
    protected $hidden = [
        'password',
    ];

}
