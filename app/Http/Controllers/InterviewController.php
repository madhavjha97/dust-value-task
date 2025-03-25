<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Interview;
use Illuminate\Http\Request;

class InterviewController extends Controller
{
    //
    public function index()
    {
        $candidates = Candidate::all();
        $interviews = Interview::orderBy('created_at', 'desc')->get();
        return view('interviews.index', compact('candidates', 'interviews'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'candidate_id' => 'required|exists:candidates,id',
            'interview_date' => 'required|date',
            'status' => 'required|in:Scheduled,Completed,Rejected,Hired',
        ]);

        // Check if the candidate already has a scheduled interview
        $existingInterview = Interview::where('candidate_id', $request->candidate_id)
            ->whereIn('status', ['Scheduled', 'Hired', 'Completed', 'Rejected'])
            ->exists();

        if ($existingInterview) {
            return redirect()->route('interviews.index')->with('error', 'This candidate already has a scheduled interview Just update the status.');
        }


        Interview::create($request->all());

        return redirect()->route('interviews.index')->with('success', 'Interview scheduled successfully.');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Scheduled,Completed,Rejected,Hired',
        ]);

        $interview = Interview::findOrFail($id);

        // Prevent updating status if it's already Hired or Rejected
        if (in_array($interview->status, ['Hired', 'Rejected'])) {
            return redirect()->route('interviews.index')->with('error', 'Cannot update status. The interview is already finalized.');
        }

        $interview->update(['status' => $request->status]);

        return redirect()->route('interviews.index')->with('success', 'Interview status updated successfully.');
    }



}
