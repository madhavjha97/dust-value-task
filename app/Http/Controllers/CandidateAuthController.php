<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class CandidateAuthController extends Controller
{
    //
    public function showRegister()
    {
        return view('candidates.register');
    }

    public function register(Request $request)
    {
        //
        // Custom error messages
        $messages = [
            'email.unique' => 'This email is already registered. Please use a different email.',
            'phone.unique' => 'This phone number is already in use. Please use a different phone number.',
        ];


        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:candidates,email',
            'phone' => 'required|string|max:20|unique:candidates,phone',
            'password' => 'required|min:6',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'experience_years' => 'required|integer',
            'skills' => 'nullable|string',
            'education' => 'nullable|string',
        ]);


        $resumePath = $request->file('resume')->store('resumes', 'public');

        $candidate = Candidate::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'phone' => $validated['phone'],
            'resume_path' => $resumePath,
            'experience_years' => $validated['experience_years'],
            'skills' => $validated['skills'],
            'education' => $validated['education'],
        ]);

        return redirect()->route('candidate.login')->with('success', 'Registration successful!');

    }


    public function showLogin()
    {
        return view('candidates.login');
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Find candidate by email
        $candidate = Candidate::where('email', $request->email)->first();

        if (!$candidate || $candidate->password !== $request->password) {
            return back()->with('error', 'Invalid email or password.');
        }

        // Manually authenticate candidate
        Session::put('candidate_id', $candidate->id);

        return redirect()->route('candidate.dashboard');
    }

    public function logout()
    {
        Session::forget('candidate_id');
        return redirect()->route('candidate.login');
    }





}
