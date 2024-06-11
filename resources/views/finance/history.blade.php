<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Finance History') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mt-4 flex justify-between">
                    </div>
                    <button class="btn btn-outline btn-info"
                        onclick="window.location.href='{{ route('finance.index') }}'"><i
                            class="fa-solid fa-backward"></i>Back</button>
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
                                    Status</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Bukti Transfer</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($finances as $key => $finance)
                                <tr>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-200">
                                        {{ $key + 1 }}
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-200">
                                        {{ $finance->purchaseRequest->item_name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">{{ $finance->status }}</span>
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-200">
                                        <div class="relative inline-block text-left">
                                            <button
                                                class="dropdown-toggle px-4 py-2 rounded-full bg-blue-500 text-white">
                                                Options
                                            </button>
                                            <div
                                                class="dropdown-menu hidden absolute right-0 w-48 bg-white shadow-lg rounded mt-1 z-10">
                                                <a href="{{ Storage::url($finance->transfer_proof) }}" target="_blank"
                                                    class="block px-4 py-2 text-gray-800 hover:bg-gray-300">View</a>
                                                <a href="{{ Storage::url($finance->transfer_proof) }}" download
                                                    class="block px-4 py-2 text-gray-800 hover:bg-gray-300">Download</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    .dropdown-menu {
        display: none;
    }

    .dropdown-menu.show {
        display: block;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropdownToggles = document.querySelectorAll('.dropdown-toggle');

        dropdownToggles.forEach(toggle => {
            toggle.addEventListener('click', function(event) {
                event.stopPropagation();
                const dropdownMenu = this.nextElementSibling;
                dropdownMenu.classList.toggle('show');
            });
        });

        window.addEventListener('click', function(event) {
            if (!event.target.matches('.dropdown-toggle')) {
                const dropdownMenus = document.querySelectorAll('.dropdown-menu');
                dropdownMenus.forEach(menu => {
                    if (menu.classList.contains('show')) {
                        menu.classList.remove('show');
                    }
                });
            }
        });
    });
</script>
