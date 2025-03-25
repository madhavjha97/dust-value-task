<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Job;
use Illuminate\Http\Request;

class HrController extends Controller
{
    //

    public function candidates()
    {
        $candidates = Candidate::all();
        return view('hr.candidates', compact('candidates'));
    }

    public function jobs()
    {
        $jobs = Job::all();
        return view('hr.jobs', compact('jobs'));
    }
}
