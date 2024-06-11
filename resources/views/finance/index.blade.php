<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data Finance') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <button class="btn btn-outline btn-info"
                        onclick="window.location.href='{{ route('finance.history') }}'"><i
                            class="fa-solid fa-clock-rotate-left"></i>History</button>
                    <div class="mt-4 flex justify-between">
                    </div>

                    <table class="table w-full mt-4">
                        <thead class="bg-gray-50 dark:bg-gray-800">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    No</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Name</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Quantity</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Price</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Description</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Status</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($purchaseRequests as $key => $purchaseRequest)
                                <tr>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-200">
                                        {{ $key + 1 }}</td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-200">
                                        {{ $purchaseRequest->item_name }}</td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-200">
                                        {{ $purchaseRequest->quantity }}</td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-200">
                                        {{ $purchaseRequest->price }}</td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-200">
                                        {{ $purchaseRequest->description }}</td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-200">
                                        <span
                                            class="inline-block px-4 py-2 rounded-full bg-warning text-white">{{ $purchaseRequest->status }}</span>
                                    </td>
                                    <td>
                                        <button class="btn" onclick="showModal({{ $purchaseRequest->id }})">
                                            <i class="fa-solid fa-exclamation"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @if (session('toast'))
        <div class="toast toast-top toast-center">
            <div class="alert alert-success">
                <span>{{ session('toast')['message'] }}</span>
            </div>
        </div>
        <script>
            setTimeout(function() {
                var toast = document.querySelector('.toast');
                toast.style.display = 'none';
            }, {{ session('toast')['duration'] }});
        </script>
    @endif


    <dialog id="my_modal_2" class="modal">
        <div class="modal-box">
            <h3 class="font-bold text-lg">Approve / Reject</h3>
            <p class="py-4">Silahkan Pilih</p>
            <select id="approvalAction" class="select select-bordered w-full max-w-xs" onchange="handleApproval()">
                <option disabled selected>Silahkan Pilih</option>
                <option value="approve">Approve</option>
                <option value="reject">Reject</option>
            </select>
            <form id="approveForm" method="POST" enctype="multipart/form-data" style="display:none;">
                @csrf
                <input type="file" name="transfer_proof" id="approvalFile" required>
                <button class="btn btn-info"><i class="fa-solid fa-exclamation"></i> Approve</button>
            </form>
            <form id="rejectForm" method="POST" style="display:none;">
                @csrf
                <input type="text" name="reject_reason" id="reject_reason" placeholder="Reject Reason" required>
                <button type="submit" class="btn btn-danger">Reject</button>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

</x-app-layout>

<script>
    function handleApproval() {
        var approvalAction = document.getElementById('approvalAction').value;
        var approveForm = document.getElementById('approveForm');
        var rejectForm = document.getElementById('rejectForm');
        var rejectReasonInput = document.getElementById('rejectReason');

        if (approvalAction === 'approve') {
            approveForm.style.display = 'block';
            rejectForm.style.display = 'none';
            rejectReasonInput.removeAttribute('required');
        } else if (approvalAction === 'reject') {
            approveForm.style.display = 'none';
            rejectForm.style.display = 'block';
            rejectReasonInput.setAttribute('required', 'required');
        }
    }

    function showModal(id) {
        var modal = document.getElementById('my_modal_2');
        var approveForm = document.getElementById('approveForm');
        var rejectForm = document.getElementById('rejectForm');

        // Set action URL for forms based on the selected purchaseRequest ID
        approveForm.action = `/finance/approve/${id}`;
        rejectForm.action = `/finance/reject/${id}`;

        modal.showModal();
    }
</script>
