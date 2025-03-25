@extends('Layouts.main')

@section('title', 'HR Dashboard')

@section('content')
    <div class="flex h-screen bg-gray-100">
        <!-- Sidebar -->
        <div class="w-64 bg-blue-900 text-white flex flex-col p-5">
            <h2 class="text-2xl font-bold mb-6">HR Dashboard</h2>
            <nav class="space-y-4">
                <a href="{{ route('hr.dashboard') }}" class="block px-4 py-2 bg-blue-700 rounded-lg">Dashboard</a>
                <a href="{{ route('hr.candidates') }}" class="block px-4 py-2 hover:bg-blue-700 rounded-lg">All Candidates</a>
                <a href="{{ route('hr.jobs') }}" class="block px-4 py-2 hover:bg-blue-700 rounded-lg">All Jobs</a>
                <a href="{{ route('jobs.create') }}" class="block px-4 py-2 hover:bg-blue-700 rounded-lg">Add Jobs</a>
                <a href="{{ route('interviews.index') }}" class="block px-4 py-2 hover:bg-blue-700 rounded-lg">Interview Scheduling</a>
                <form method="POST" action="{{ route('hr.logout') }}">
                    @csrf
                    <button type="submit" class="w-full bg-red-600 px-4 py-2 rounded-lg hover:bg-red-700 mt-4">Logout</button>
                </form>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <h2 class="text-3xl font-bold mb-6">Welcome to HR Dashboard</h2>

            <!-- Cards Section -->
            <div class="grid grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                    <h3 class="text-xl font-bold">Total Candidates</h3>
                    <p class="text-3xl font-bold text-blue-600">{{ $candidateCount }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                    <h3 class="text-xl font-bold">Total Jobs</h3>
                    <p class="text-3xl font-bold text-green-600">{{ $jobCount }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                    <h3 class="text-xl font-bold">Applications</h3>
                    <p class="text-3xl font-bold text-purple-600">{{ $applicationCount }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
