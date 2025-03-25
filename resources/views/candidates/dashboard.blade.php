@extends('Layouts.main')

@section('title', 'Candidate Dashboard')

@section('content')

    @php
        $candidate = \App\Models\Candidate::find(session('candidate_id'));
    @endphp

    <div class="flex flex-col items-center min-h-screen bg-gray-100 py-6">
        <div class="w-full max-w-4xl bg-white p-6 rounded-lg shadow-lg">

            <!-- Welcome Message -->
            @if($candidate)
                <h2 class="text-2xl font-bold text-center mb-4">Welcome, {{ $candidate->name }}</h2>
            @else
                <h2 class="text-2xl font-bold text-center mb-4">Welcome, Guest</h2>
            @endif

            <!-- Apply for Job Section -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-2">Available Jobs</h3>
                <table class="w-full border border-gray-300">
                    <thead>
                    <tr class="bg-gray-200">
                        <th class="p-2 border">Title</th>
                        <th class="p-2 border">Company</th>
                        <th class="p-2 border">Location</th>
                        <th class="p-2 border">Type</th>
                        <th class="p-2 border">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($jobs as $job)
                        <tr class="text-center bg-white">
                            <td class="p-2 border">{{ $job->title }}</td>
                            <td class="p-2 border">{{ $job->company }}</td>
                            <td class="p-2 border">{{ $job->location }}</td>
                            <td class="p-2 border">{{ $job->type }}</td>
                            <td class="p-2 border">
                                <form action="{{ route('candidate.apply') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="job_id" value="{{ $job->id }}">
                                    <button type="submit"
                                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                        Apply
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Job Applications -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-2">Your Job Applications</h3>
                @if($applications->isEmpty())
                    <p class="text-gray-600 text-center">No applications found.</p>
                @else
                    <table class="w-full border border-gray-300">
                        <thead>
                        <tr class="bg-gray-200">
                            <th class="p-2 border">Job Title</th>
                            <th class="p-2 border">Company</th>
                            <th class="p-2 border">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($applications as $application)
                            <tr class="text-center bg-white">
                                <td class="p-2 border">{{ $application->job->title }}</td>
                                <td class="p-2 border">{{ $application->job->company }}</td>
                                <td class="p-2 border text-blue-600">Applied</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

            <!-- Interview Status -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-2">Interview Status</h3>
                @if($interviews->isEmpty())
                    <p class="text-gray-600 text-center">No interviews scheduled.</p>
                @else
                    <table class="w-full border border-gray-300">
                        <thead>
                        <tr class="bg-gray-200">
                            <th class="p-2 border">Interview Date</th>
                            <th class="p-2 border">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($interviews as $interview)
                            <tr class="text-center bg-white">
                                <td class="p-2 border">{{ \Illuminate\Support\Carbon::parse($interview->interview_date)->format('d-M-Y h:i A') }}</td>
                                <td class="p-2 border">{{ ucfirst($interview->status) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

            <!-- Logout Button -->
            <div class="text-center mt-4">
                <a href="{{ route('candidate.logout') }}"
                   class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">
                    Logout
                </a>
            </div>
        </div>
    </div>
@endsection
