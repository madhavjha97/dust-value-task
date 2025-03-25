@extends('Layouts.main')

@section('title', 'All Candidates')

@section('content')
    <div class="p-8">
        <h2 class="text-3xl font-bold mb-6">All Candidates</h2>
        <table class="w-full border-collapse border border-gray-300">
            <thead>
            <tr class="bg-gray-200">
                <th class="border p-2">ID</th>
                <th class="border p-2">Name</th>
                <th class="border p-2">Email</th>
                <th class="border p-2">Phone</th>
                <th class="border p-2">Experience (Years)</th>
                <th class="border p-2">Skills</th>
                <th class="border p-2">Education</th>
                <th class="border p-2">Resume</th>
            </tr>
            </thead>
            <tbody>
            @foreach($candidates as $candidate)
                <tr>
                    <td class="border p-2">{{ $candidate->id }}</td>
                    <td class="border p-2">{{ $candidate->name }}</td>
                    <td class="border p-2">{{ $candidate->email }}</td>
                    <td class="border p-2">{{ $candidate->phone }}</td>
                    <td class="border p-2">{{ $candidate->experience_years }}</td>
                    <td class="border p-2">{{ $candidate->skills ?? 'N/A' }}</td>
                    <td class="border p-2">{{ $candidate->education ?? 'N/A' }}</td>
                    <td class="border p-2">
                        @if($candidate->resume_path)
                            <a href="{{ asset('storage/' . $candidate->resume_path) }}" target="_blank" class="text-blue-600 hover:underline">View Resume</a>
                        @else
                            No Resume
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
