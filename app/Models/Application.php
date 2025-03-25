<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
    protected $guarded = [];

    // Define relationship with Job model
    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }

    // Define relationship with Candidate model
    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'candidate_id');
    }
}
