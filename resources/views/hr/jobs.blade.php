@extends('Layouts.main')

@section('title', 'All Jobs')

@section('content')
    <div class="p-8">
        <h2 class="text-3xl font-bold mb-6">All Jobs</h2>
        <table class="w-full border-collapse border border-gray-300">
            <thead>
            <tr class="bg-gray-200">
                <th class="border p-2">ID</th>
                <th class="border p-2">Job Title</th>
                <th class="border p-2">Description</th>
                <th class="border p-2">Company</th>
                <th class="border p-2">Location</th>
                <th class="border p-2">Salary</th>
                <th class="border p-2">Job Type</th>
                <th class="border p-2">Posted Date</th>
            </tr>
            </thead>
            <tbody>
            @foreach($jobs as $job)
                <tr>
                    <td class="border p-2">{{ $job->id }}</td>
                    <td class="border p-2">{{ $job->title }}</td>
                    <td class="border p-2">{{ Str::limit($job->description, 100) }}</td>
                    <td class="border p-2">{{ $job->company }}</td>
                    <td class="border p-2">{{ $job->location }}</td>
                    <td class="border p-2">
                        {{ $job->salary ? '₹' . number_format($job->salary, 2) : 'Not Disclosed' }}
                    </td>
                    <td class="border p-2">{{ $job->type }}</td>
                    <td class="border p-2">{{ \Illuminate\Support\Carbon::parse($job->created_at)->format('d-M-y') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
