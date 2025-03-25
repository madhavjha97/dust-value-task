@extends('Layouts.main')

@section('title', 'HR Login')

@section('content')
    <div class="flex justify-center items-center h-screen bg-gray-100">
        <div class="bg-white p-8 rounded-lg shadow-lg w-96">
            <h2 class="text-2xl font-bold mb-6 text-center">HR Login</h2>
            @if(session('error'))
                <div class="text-red-500 mb-4">{{ session('error') }}</div>
            @endif
            <form method="POST" action="{{ route('hr.login.submit') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Email</label>
                    <input type="email" name="email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Password</label>
                    <input type="password" name="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    Login
                </button>
            </form>
        </div>
    </div>
@endsection
