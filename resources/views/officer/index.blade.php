<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data Officer') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mt-4 flex justify-between">
                        <!-- Tombol Tambah Data -->
                        <button id="tambah-data" class="btn btn-outline btn-info"><i
                                class="fa-solid fa-square-plus"></i>Tambah
                            Data</button>
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
                            @foreach ($purchase as $key => $purchaseRequest)
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
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                @if ($purchaseRequest->status == 'approved') bg-green-100 text-green-800
                                                @elseif ($purchaseRequest->status == 'pending')
                                                    bg-yellow-100 text-yellow-800
                                                @elseif ($purchaseRequest->status == 'rejected')
                                                    bg-red-100 text-red-800 @endif">
                                            {{ $purchaseRequest->status }}
                                        </span>
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-200">
                                        <button class="btn btn-outline btn-warning edit-button"
                                            data-id="{{ $purchaseRequest->id }}"
                                            data-item-name="{{ $purchaseRequest->item_name }}"
                                            data-quantity="{{ $purchaseRequest->quantity }}"
                                            data-price="{{ $purchaseRequest->price }}"
                                            data-description="{{ $purchaseRequest->description }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-outline btn-error delete-button"
                                            data-id="{{ $purchaseRequest->id }}">
                                            <i class="fas fa-trash-alt"></i>
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

    <div id="delete-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="flex items-start justify-center mt-20 h-full">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-1/3 p-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-200 mb-4">Konfirmasi Hapus Data</h3>
                <p>Anda yakin ingin menghapus data ini?</p>
                <div class="flex justify-end mt-6">
                    <button id="cancel-delete" type="button" class="btn btn-secondary mr-2">Batal</button>
                    <form id="delete-form" action="#" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-error">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="toast toast-top toast-center">
            <div class="alert alert-success">
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

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


    <!-- Modal -->
    <div id="modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="flex items-start justify-center mt-20 h-full">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-1/3 p-6">
                <h3 id="modal-title" class="text-lg font-medium text-gray-900 dark:text-gray-200 mb-4">Tambah Data </h3>
                <form id="modal-form" action="{{ route('officer.store') }}" method="POST" id="modal-form"
                    data-action-add="{{ route('officer.store') }}"
                    data-action-edit="{{ route('officer.update', ['id' => ':id']) }}">
                    @csrf
                    <input type="hidden" name="_method" id="modal-form-method" value="POST">
                    <input type="hidden" name="id" id="form-id">
                    <div class="space-y-4">
                        <div>
                            <label for="item_name"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-200">Nama</label>
                            <input type="text" name="item_name" id="form-item_name" autocomplete="off"
                                class="input input-bordered w-full dark:bg-gray-700 dark:text-gray-200">
                        </div>
                        <div>
                            <label for="quantity"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-200">Quantity</label>
                            <input type="number" name="quantity" id="form-quantity" autocomplete="off"
                                class="input input-bordered w-full dark:bg-gray-700 dark:text-gray-200">
                        </div>
                        <div>
                            <label for="price"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-200">Price</label>
                            <input type="number" name="price" id="form-price" autocomplete="off"
                                class="input input-bordered w-full dark:bg-gray-700 dark:text-gray-200">
                        </div>
                        <div>
                            <label for="description"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-200">Description</label>
                            <input type="text" name="description" id="form-description" autocomplete="off"
                                class="input input-bordered w-full dark:bg-gray-700 dark:text-gray-200">
                        </div>
                    </div>
                    <div class="flex justify-end mt-6">
                        <button id="close-modal" type="button" class="btn btn-secondary mr-2">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>

<!-- Tambahkan skrip JavaScript -->
<script>
    document.getElementById('tambah-data').addEventListener('click', function() {
        document.getElementById('modal-form').action = document.getElementById('modal-form').getAttribute(
            'data-action-add');
        document.getElementById('modal-form-method').value = 'POST';
        document.getElementById('modal-title').innerText = "Tambah Data";
        document.getElementById('form-id').value = '';
        document.getElementById('modal').classList.remove('hidden');
    });

    document.querySelectorAll('.edit-button').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const editAction = document.getElementById('modal-form').getAttribute('data-action-edit')
                .replace(':id', id);
            document.getElementById('modal-form').action = editAction;
            document.getElementById('modal-form-method').value = 'PUT';
            document.getElementById('modal-title').innerText = "Edit Data";
            document.getElementById('form-id').value = id;
            document.getElementById('form-item_name').value = this.getAttribute('data-item-name');
            document.getElementById('form-quantity').value = this.getAttribute('data-quantity');
            document.getElementById('form-price').value = this.getAttribute('data-price');
            document.getElementById('form-description').value = this.getAttribute('data-description');
            document.getElementById('modal').classList.remove('hidden');
        });
    });

    document.getElementById('close-modal').addEventListener('click', function() {
        document.getElementById('modal').classList.add('hidden');
    });
</script>

<script>
    document.querySelectorAll('.delete-button').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const deleteForm = document.getElementById('delete-form');
            deleteForm.action = '{{ route('officer.destroy', ':id') }}'.replace(':id', id);
            document.getElementById('delete-modal').classList.remove('hidden');
        });
    });

    document.getElementById('cancel-delete').addEventListener('click', function() {
        document.getElementById('delete-modal').classList.add('hidden');
    });
</script>

<script>
    setTimeout(function() {
        var toast = document.querySelector('.toast');
        toast.style.display = 'none';
    }, 3000);
</script>
