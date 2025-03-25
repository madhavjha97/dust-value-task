<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Candidate;
use App\Models\Interview;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Can;

class CandidateDashboardController extends Controller
{
    //

    public function index()
    {
        $candidateId = session('candidate_id');
        $candidate = Candidate::find($candidateId);

        // Fetch all jobs
        $jobs = Job::all();

        // Fetch candidate's applications with job details
        $applications = Application::where('candidate_id', $candidateId)->with('job')->get();

        // Fetch candidate's interview status
        $interviews = Interview::where('candidate_id', $candidateId)->get();

        return view('candidates.dashboard', compact('candidate', 'jobs', 'applications', 'interviews'));
    }

    public function applyForJob(Request $request)
    {
        $request->validate([
            'job_id' => 'required|exists:jobs,id',
        ]);

        $candidateId = session('candidate_id');

        // Check if already applied
        $existingApplication = Application::where('candidate_id', $candidateId)
            ->where('job_id', $request->job_id)
            ->first();

        if ($existingApplication) {
            return redirect()->route('candidate.dashboard')->with('error', 'You have already applied for this job.');
        }

        Application::create([
            'candidate_id' => $candidateId,
            'job_id' => $request->job_id,
        ]);

        return redirect()->route('candidate.dashboard')->with('success', 'Job application submitted successfully.');
    }
}
