<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Candidate;
use App\Models\Job;
use Illuminate\Http\Request;

class HRAuthController extends Controller
{
    //

    public function showLoginForm()
    {
        return view('hrlogin');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        // Hardcoded HR credentials
        if ($request->email === 'hr@gmail.com' && $request->password === '123456789') {
            session(['hr_logged_in' => true]);
            return redirect()->route('hr.dashboard')->with('success', 'Login Successful!');
        }

        return back()->with('error', 'Invalid HR credentials!');
    }

    public function dashboard()
    {
        if (!session()->has('hr_logged_in')) {
            return redirect()->route('hr.login')->with('error', 'You must log in first.');
        }

        $candidateCount = Candidate::count();
        $jobCount = Job::count();
        $applicationCount = Application::count();

        return view('hr.dashboard', compact('candidateCount', 'jobCount', 'applicationCount'));


    }

    public function logout()
    {
        session()->forget('hr_logged_in');
        return redirect()->route('hr.login')->with('success', 'Logged out successfully.');
    }

}
