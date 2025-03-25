@extends('Layouts.main')

@section('title', 'Interview Management')



@section('content')
    <div class="max-w-4xl mx-auto bg-white p-6 shadow-md rounded-md">
        <h2 class="text-2xl font-bold mb-4 text-center">Schedule an Interview</h2>

        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-2 rounded mb-4 text-center">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-2 rounded mb-4 text-center">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('interviews.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-semibold">Candidate:</label>
                    <select name="candidate_id" class="w-full p-2 border rounded focus:ring focus:ring-blue-300" required>
                        <option value="">Select Candidate</option>
                        @foreach($candidates as $candidate)
                            <option value="{{ $candidate->id }}">{{ $candidate->name }}</option>
                        @endforeach
                    </select>

                </div>
                <div>
                    <label class="block font-semibold">Interview Date & Time:</label>
                    <input type="text" id="interview_date" name="interview_date" class="w-full p-2 border rounded focus:ring focus:ring-blue-300" required>
                </div>

                <div class="col-span-2">
                    <label class="block font-semibold">Status:</label>
                    <select name="status" class="w-full p-2 border rounded focus:ring focus:ring-blue-300" required>
                        <option value="Scheduled">Scheduled</option>
                        <option value="Completed">Completed</option>
                        <option value="Rejected">Rejected</option>
                        <option value="Hired">Hired</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded w-full mt-4 hover:bg-blue-600">
                Schedule Interview
            </button>
        </form>
    </div>

    <div class="max-w-5xl mx-auto bg-white p-6 shadow-md rounded-md mt-6">
        <h2 class="text-2xl font-bold mb-4">Scheduled Interviews</h2>

        <table class="w-full bg-white shadow-md rounded border">
            <thead class="bg-gray-200">
            <tr>
                <th class="p-2">Candidate</th>
                <th class="p-2">Interview Date</th>
                <th class="p-2">Interview Time</th>
                <th class="p-2">Status</th>
                <th class="p-2">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($interviews as $interview)
                <tr class="border-b">
                    <td class="p-2">{{ $interview->candidate->name }}</td>

                    <td class="p-2">{{ \Illuminate\Support\Carbon::parse($interview->interview_date)->format('d-M-Y') }}
                        <span class="text-gray-500">
        @if (\Illuminate\Support\Carbon::parse($interview->interview_date)->isToday())
                                (Today)
                            @elseif (\Illuminate\Support\Carbon::parse($interview->interview_date)->isTomorrow())
                                (Tomorrow)
                            @else
                                ({{ \Illuminate\Support\Carbon::parse($interview->interview_date)->addDay()->diffForHumans() }})
                            @endif
    </span>
                    </td>
                    <td class="p-2">{{ \Illuminate\Support\Carbon::parse($interview->interview_date)->format('h:i A') }}

                    <td class="p-2">
                            <span class="px-2 py-1 rounded text-white
                                @if($interview->status == 'Scheduled') bg-blue-500
                                @elseif($interview->status == 'Completed') bg-green-500
                                @elseif($interview->status == 'Rejected') bg-red-500
                                @elseif($interview->status == 'Hired') bg-purple-500
                                @endif">
                                {{ $interview->status }}
                            </span>
                    </td>
                    <td class="p-2 flex space-x-2">
                        <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 open-status-modal"
                                data-interview-id="{{ $interview->id }}"
                                data-current-status="{{ $interview->status }}">
                            Update Interview Status
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>


    <!-- Update Interview Status Modal -->
    <div id="statusModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
            <h2 class="text-xl font-bold mb-4 text-center">Update Interview Status</h2>

            <form id="updateStatusForm" action="{{ route('interviews.store') }}" method="POST">
                @csrf

                <input type="hidden" id="interview_id" name="interview_id">

                <!-- Interview Date Field -->
                <div class="mt-4">
                    <label class="block font-semibold">Interview Date:</label>
                    <input type="datetime-local" id="interview_date" name="interview_date" class="w-full p-2 border rounded focus:ring focus:ring-blue-300">
                </div>

                <div class="mt-4">
                    <label class="block font-semibold">Status:</label>
                    <select id="statusSelect" name="status" class="w-full p-2 border rounded focus:ring focus:ring-blue-300">
                        <option value="Scheduled">Scheduled</option>
                        <option value="Completed">Completed</option>
                        <option value="Rejected">Rejected</option>
                        <option value="Hired">Hired</option>
                    </select>
                    <label class="block ">Note:If the status is Hired or Rejected then button is disabled</label>
                </div>

                <div class="mt-4 flex justify-between">
                    <button type="button" id="closeStatusModal" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                        Cancel
                    </button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Update Status
                    </button>
                </div>
            </form>
        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let statusModal = document.getElementById("statusModal");
            let closeStatusModal = document.getElementById("closeStatusModal");
            let statusSelect = document.getElementById("statusSelect");
            let interviewIdInput = document.getElementById("interview_id");
            let updateStatusForm = document.getElementById("updateStatusForm");
            let updateButton = updateStatusForm.querySelector("button[type='submit']");

            document.querySelectorAll(".open-status-modal").forEach(button => {
                button.addEventListener("click", function () {
                    let interviewId = this.getAttribute("data-interview-id");
                    let currentStatus = this.getAttribute("data-current-status");

                    interviewIdInput.value = interviewId;
                    statusSelect.value = currentStatus;

                    // Disable the "Update Status" button if the status is "Hired" or "Rejected"
                    if (currentStatus === "Hired" || currentStatus === "Rejected") {
                        updateButton.disabled = true;
                        updateButton.classList.add("opacity-50", "cursor-not-allowed");
                    } else {
                        updateButton.disabled = false;
                        updateButton.classList.remove("opacity-50", "cursor-not-allowed");
                    }

                    // Update form action dynamically
                    updateStatusForm.action = `/interview-scheduling`;

                    statusModal.classList.remove("hidden");
                });
            });

            closeStatusModal.addEventListener("click", function () {
                statusModal.classList.add("hidden");
            });
        });



        document.addEventListener("DOMContentLoaded", function () {
            flatpickr("#interview_date", {
                enableTime: true,           // Enable time selection
                dateFormat: "Y-m-d H:i",    // Format: 2025-03-24 14:30
                minDate: "today",           // Disable past dates
                defaultHour: 10,            // Default time: 10 AM
                time_24hr: true             // Use 24-hour format
            });
        });

    </script>

@endsection
