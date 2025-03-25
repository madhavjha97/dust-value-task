@extends('Layouts.main')

@section('title', 'Add Candidate')

@section('content')
    <div class="max-w-5xl mx-auto bg-white p-6 shadow-md rounded-md mt-6">
        <h2 class="text-xl font-bold mb-4">Candidates List</h2>
        <table class="w-full bg-white shadow-md rounded border">
            <thead class="bg-gray-200">
            <tr>
                <th class="p-2">Name</th>
                <th class="p-2">Email</th>
                <th class="p-2">Phone</th>
                <th class="p-2">Experience</th>
                <th class="p-2">Skills</th>
                <th class="p-2">Education</th>
                <th class="p-2">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($candidates as $candidate)
                <tr class="border-b">
                    <td class="p-2">{{ $candidate->name }}</td>
                    <td class="p-2">{{ $candidate->email }}</td>
                    <td class="p-2">{{ $candidate->phone }}</td>
                    <td class="p-2">{{ $candidate->experience_years }} years</td>
                    <td class="p-2">{{ $candidate->skills ?? 'N/A' }}</td>
                    <td class="p-2">{{ $candidate->education ?? 'N/A' }}</td>
                    <td class="p-2 flex space-x-2">
                        <a href="{{ route('candidates.edit', $candidate->id) }}" class="text-green-500">Edit</a>
                        <form action="{{ route('candidates.destroy', $candidate->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500">Delete</button>
                        </form>

                        <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 open-modal"
                                data-candidate-id="{{ $candidate->id }}"
                                data-candidate-name="{{ $candidate->name }}">
                            Schedule an Interview
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>



    <!-- Schedule Interview Modal -->
    <div id="interviewModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
            <h2 class="text-xl font-bold mb-4 text-center">Schedule an Interview</h2>

            <form action="{{ route('interviews.store') }}" method="POST">
                @csrf
                <input type="hidden" id="candidate_id" name="candidate_id">

                <div>
                    <label class="block font-semibold">Candidate:</label>
                    <input type="text" id="candidate_name" class="w-full p-2 border rounded bg-gray-100" readonly>
                </div>

                <div class="mt-4">
                    <label class="block font-semibold">Interview Date:</label>
                    <input type="date" name="interview_date" class="w-full p-2 border rounded focus:ring focus:ring-blue-300" required>
                </div>

                <div class="mt-4">
                    <label class="block font-semibold">Status:</label>
                    <select name="status" class="w-full p-2 border rounded focus:ring focus:ring-blue-300" required>
                        <option value="Scheduled">Scheduled</option>
                        <option value="Completed">Completed</option>
                        <option value="Rejected">Rejected</option>
                        <option value="Hired">Hired</option>
                    </select>
                </div>

                <div class="mt-4 flex justify-between">
                    <button type="button" id="closeModal" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                        Cancel
                    </button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Schedule Interview
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let modal = document.getElementById("interviewModal");
            let candidateInput = document.getElementById("candidate_id");
            let candidateName = document.getElementById("candidate_name");
            let closeModal = document.getElementById("closeModal");

            document.querySelectorAll(".open-modal").forEach(button => {
                button.addEventListener("click", function () {
                    let candidateId = this.getAttribute("data-candidate-id");
                    let candidateNameText = this.getAttribute("data-candidate-name");

                    candidateInput.value = candidateId;
                    candidateName.value = candidateNameText;

                    modal.classList.remove("hidden");
                });
            });

            closeModal.addEventListener("click", function () {
                modal.classList.add("hidden");
            });
        });
    </script>
@endsection
