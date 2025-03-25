@extends('Layouts.main')

@section('title', 'Create Job')

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-6 shadow-md rounded-md">
        <h2 class="text-xl font-bold mb-4 text-center">Create Job</h2>

        @if(session('success'))
            <div class="bg-green-200 text-green-800 p-3 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('jobs.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block font-semibold">Job Title:</label>
                <input type="text" name="title" class="w-full p-2 border rounded focus:ring focus:ring-blue-300" required>
            </div>
            <div class="mb-4">
                <label class="block font-semibold">Description:</label>
                <textarea name="description" class="w-full p-2 border rounded focus:ring focus:ring-blue-300" rows="3" required></textarea>
            </div>
            <div class="mb-4">
                <label class="block font-semibold">Company:</label>
                <input type="text" name="company" class="w-full p-2 border rounded focus:ring focus:ring-blue-300" required>
            </div>
            <div class="mb-4">
                <label class="block font-semibold">Location:</label>
                <input type="text" name="location" class="w-full p-2 border rounded focus:ring focus:ring-blue-300" required>
            </div>
            <div class="mb-4">
                <label class="block font-semibold">Salary (Optional):</label>
                <input type="number" step="0.01" name="salary" class="w-full p-2 border rounded focus:ring focus:ring-blue-300">
            </div>
            <div class="mb-4">
                <label class="block font-semibold">Job Type:</label>
                <select name="type" class="w-full p-2 border rounded focus:ring focus:ring-blue-300" required>
                    <option value="Full-time">Full-time</option>
                    <option value="Part-time">Part-time</option>
                    <option value="Contract">Contract</option>
                    <option value="Remote">Remote</option>
                </select>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded w-full mt-4 hover:bg-blue-600">
                Save Job
            </button>
        </form>
    </div>
@endsection
