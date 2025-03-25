@extends('Layouts.main')

@section('title', 'Candidate Login')

@section('content')
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-bold mb-4 text-center">Candidate Login</h2>

            @if(session('success'))
                <div class="bg-green-500 text-white p-2 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-500 text-white p-2 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('candidate.login') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block font-semibold">Email:</label>
                    <input type="email" name="email" class="w-full p-2 border rounded focus:ring focus:ring-blue-300" required>
                </div>

                <div class="mb-4">
                    <label class="block font-semibold">Password:</label>
                    <input type="password" name="password" class="w-full p-2 border rounded focus:ring focus:ring-blue-300" required>
                </div>

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded w-full mt-4 hover:bg-blue-600">
                    Login
                </button>
            </form>
        </div>
    </div>
@endsection
