@extends('Layouts.main')

@section('title', 'Register Candidate')

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-6 shadow-md rounded-md">
        @if ($errors->any())
            <div class="bg-red-500 text-white p-2 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <h2 class="text-xl font-bold mb-4 text-center">Register Candidate</h2>
        <form action="{{ route('candidate.register.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block font-semibold">Name:</label>
                <input type="text" name="name" class="w-full p-2 border rounded focus:ring focus:ring-blue-300" required>
            </div>
            <div class="mb-4">
                <label class="block font-semibold">Email:</label>
                <input type="email" name="email" class="w-full p-2 border rounded focus:ring focus:ring-blue-300" required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold">Password:</label>
                <input type="password" name="password" class="w-full p-2 border rounded focus:ring focus:ring-blue-300" required>
            </div>
            <div class="mb-4">
                <label class="block font-semibold">Phone:</label>
                <input type="text" name="phone" class="w-full p-2 border rounded focus:ring focus:ring-blue-300" required>
            </div>
            <div class="mb-4">
                <label class="block font-semibold">Experience (Years):</label>
                <input type="number" name="experience_years" class="w-full p-2 border rounded focus:ring focus:ring-blue-300" required>
            </div>
            <div class="mb-4">
                <label class="block font-semibold">Skills:</label>
                <textarea name="skills" class="w-full p-2 border rounded focus:ring focus:ring-blue-300" rows="2"></textarea>
            </div>
            <div class="mb-4">
                <label class="block font-semibold">Education:</label>
                <input type="text" name="education" class="w-full p-2 border rounded focus:ring focus:ring-blue-300">
            </div>
            <div class="mb-4">
                <label class="block font-semibold">Resume (PDF, DOC, DOCX, Max: 2MB):</label>
                <input type="file" name="resume" class="w-full p-2 border rounded focus:ring focus:ring-blue-300" required>
                @error('resume')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded w-full mt-4 hover:bg-blue-600">
                Register Candidate
            </button>
        </form>
    </div>
@endsection
