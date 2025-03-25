@extends('Layouts.main')

@section('title', 'Home Page')

@section('content')
    <!-- Hero Section -->
    <div class="relative h-96 bg-cover bg-center flex items-center justify-center" style="background-image: url('https://source.unsplash.com/1600x900/?office,work');">
        <div class="grid grid-cols-2 gap-4 max-w-6xl mx-auto text-center">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-xl font-bold mb-2">Candidate - Job Application Portal</h2>
                <p class="text-gray-600">Manage candidate applications, interviews, and job applications.</p>
                <div class="mt-4 space-x-2">
                    <a href="{{ route('candidate.login') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">Login</a>
                    <a href="{{ route('candidate.register') }}" class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5">Register</a>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-xl font-bold mb-2">HR - Interview Scheduling System</h2>
                <p class="text-gray-600">Schedule interviews with candidates & Track interview status .</p>
                <div class="mt-4">
                    <a href="{{ route('hr.login') }}" class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5">HR Login</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Documentation Section -->
    <div class="max-w-4xl mx-auto mt-10 p-6 bg-white shadow-lg rounded-lg">

        <h2 class="text-2xl font-bold mt-6 mb-4">Database Tables</h2>
        <table class="w-full border-collapse border border-gray-300">
            <thead>
            <tr class="bg-gray-200">
                <th class="border p-2">Table Name</th>
                <th class="border p-2">Description</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="border p-2">candidates</td>
                <td class="border p-2">Stores candidate details</td>
            </tr>
            <tr>
                <td class="border p-2">interviews</td>
                <td class="border p-2">Stores interview schedules and statuses</td>
            </tr>
            <tr>
                <td class="border p-2">jobs</td>
                <td class="border p-2">Stores job listings</td>
            </tr>
            <tr>
                <td class="border p-2">applications</td>
                <td class="border p-2">Tracks job applications</td>
            </tr>
            </tbody>
        </table>

        <h2 class="text-2xl font-bold mt-6 mb-4">API Routes</h2>
        <pre class="bg-gray-100 p-4 rounded-lg">
            RUN CMD php artisan route:list
            View All Routes
        </pre>

        <h2 class="text-2xl font-bold mt-6 mb-4">Using Postman</h2>
        <ul class="list-disc pl-5 space-y-2">
            <li>Open Postman and create a new request.</li>
            <li>For GET requests, select GET and enter the API URL.</li>
            <li>For POST/PUT requests, select the respective method and go to the Body section.</li>
            <li>Choose raw JSON format and enter request data.</li>
            <li>Click Send to execute the request and view the response.</li>
        </ul>
    </div>

@endsection
