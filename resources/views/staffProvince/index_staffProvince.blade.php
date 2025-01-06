<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Staff | Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('layout.cdn')
    <script>
        const USER_ID = @json(auth()->id());
    </script>
    @include('layout.tailwindconfig')
</head>

<body class="bg-gray-100 dark:bg-gray-900 min-h-screen">
    @include('layout.alert')
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
            <div class="p-6 sm:p-10">
                <h1 class="text-3xl font-bold mb-8 text-gray-800 dark:text-white text-center">Dashboard Staff Province
                </h1>
                <div class="overflow-x-auto">
                    <div class="flex justify-end mb-4">
                        <div class="relative inline-block text-left">
                            <button id="exportButton"
                                class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 transition duration-150 ease-in-out">
                                Export (.xlsx)
                            </button>
                            <div id="exportDropdown"
                                class="dropdown-content absolute hidden right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10">
                                <!-- Dropdown untuk Export Berdasarkan Tanggal -->
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-t-md"
                                    onclick="openDateModal()">Berdasarkan Tanggal</a>

                                <!-- Link untuk Export Seluruh Data -->
                                <a href="{{ route('export-by-province') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-b-md">Seluruh
                                    Data</a>
                            </div>
                        </div>
                    </div>
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3 rounded-tl-lg">Gambar & Pengirim</th>
                                <th scope="col" class="px-6 py-3">Lokasi & Tanggal</th>
                                <th scope="col" class="px-6 py-3">Deskripsi</th>
                                <th scope="col" class="px-6 py-3">
                                    <div class="flex items-center">
                                        Jumlah Vote
                                        <button class="ml-2 text-xs" id="sortVotes">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                            </svg>
                                            @if (isset($order))
                                                <span class="ml-1">{{ $order === 'desc' ? '↑' : '↓' }}</span>
                                            @endif
                                        </button>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3 rounded-tr-lg">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reports as $report)
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 transition duration-150 ease-in-out">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <div class="flex items-center">
                                            <img class="w-10 h-10 rounded-full cursor-pointer object-cover"
                                                src="{{ asset('storage/assets/images/reports/' . $report->image ?? 'default-image.jpg') }}"
                                                alt="User Image"
                                                onclick="openModal('{{ asset('storage/assets/images/reports/' . $report->image ?? 'default-image.jpg') }}')">
                                            <div class="pl-3">
                                                <div class="text-base font-semibold">
                                                    {{ $report->user->email ?? 'Unknown User' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-medium">{{ strtoupper($report->village) }},
                                            {{ strtoupper($report->subdistrict) }}</div>
                                        <div>{{ strtoupper($report->regency) }}, {{ strtoupper($report->province) }}
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ \Carbon\Carbon::parse($report->created_at)->locale('id')->timezone('Asia/Jakarta')->translatedFormat('d F Y H:i') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ \Illuminate\Support\Str::limit($report->description, 50, '...') }}
                                    </td>
                                    <td class="px-6 py-4 text-center font-semibold">
                                        {{ $report->voting ? count(json_decode($report->voting, true)) : 0 }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @php
                                            $response = $report->Response;
                                        @endphp
                                        @if ($response && $response->response_status === 'REJECT')
                                            <span
                                                class="text-red-600 font-semibold bg-red-100 px-4 py-2 rounded-md inline-block">
                                                Ditolak
                                            </span>
                                        @else
                                            <!-- Jika statusnya ON_PROCESS atau lainnya, tampilkan tombol aksi -->
                                            <div class="relative inline-block text-left">
                                                <button id="dropdownButton{{ $report->id }}"
                                                    class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 transition duration-150 ease-in-out"
                                                    onclick="toggleDropdown({{ $report->id }})">
                                                    Aksi
                                                </button>
                                                <div id="dropdownContent{{ $report->id }}"
                                                    class="dropdown-content absolute hidden right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10">
                                                    <a href="#"
                                                        onclick="openTindakModal(event, {{ $report->id }}); document.getElementById('dropdownContent{{ $report->id }}').classList.add('hidden')"
                                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-t-md">
                                                        Tindak Lanjut
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr class="bg-white dark:bg-gray-800">
                                    <td colspan="5"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                        Tidak ada laporan yang tersedia.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk Filter Berdasarkan Tanggal -->
    <div id="dateModal" class="modal fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden z-50"
        onclick="closeDateModal()">
        <div class="modal-content bg-white p-6 rounded-lg shadow-lg w-full max-w-md" onclick="event.stopPropagation()">
            <button class="modal-close absolute top-2 right-2 text-gray-600 text-xl"
                onclick="closeDateModal()">&times;</button>
            <h3 class="text-lg font-semibold mb-4">Export Berdasarkan Tanggal</h3>
            <form action="{{ route('export-by-date') }}" method="GET">
                @csrf
                <div class="mb-4">
                    <label for="date" class="block text-gray-700 mb-2">Pilih Tanggal</label>
                    <input type="date" id="date" name="date"
                        class="w-full px-4 py-2 border rounded-md bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                </div>
                <div class="flex justify-end space-x-4">
                    <button type="button"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 px-4 rounded-md transition duration-150 ease-in-out"
                        onclick="closeDateModal()">Batal</button>
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-md transition duration-150 ease-in-out">Export</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal for Image -->
    <div id="photoModal" class="modal fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden z-50"
        onclick="closeModal()">
        <div class="modal-content bg-white p-1 rounded-lg shadow-lg max-w-3xl max-h-[90vh]"
            onclick="event.stopPropagation()">
            <button
                class="modal-close absolute top-2 right-2 text-white text-xl bg-red-500 rounded-full w-8 h-8 flex items-center justify-center"
                onclick="closeModal()">&times;</button>
            <img id="modalImage" class="max-w-full max-h-[85vh] object-contain rounded-lg" src=""
                alt="Modal Image">
        </div>
    </div>

    <!-- Modal for Tindak Lanjut -->
    <div id="tindakModal"
        class="modal fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden z-50"
        onclick="closeTindakModal()">
        <div class="modal-content bg-white p-6 rounded-lg shadow-lg w-full max-w-md"
            onclick="event.stopPropagation()">
            <button class="modal-close absolute top-2 right-2 text-gray-600 text-xl"
                onclick="closeTindakModal()">&times;</button>
            <h3 class="text-lg font-semibold mb-4">Tindak Lanjut</h3>
            <form action="{{ route('staff_process_action') }}" method="POST"">
                @csrf
                <input type="hidden" id="reportIdInput" name="report_id" value="">
                <div class="mb-4">
                    <label for="action" class="block text-gray-700 mb-2">Pilih Tindakan</label>
                    <select id="action" name="action"
                        class="w-full px-4 py-2 border rounded-md bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="REJECT">Reject</option>
                        <option value="ON_PROCESS">Tindak Lanjut</option>
                    </select>
                </div>
                <div class="flex justify-end space-x-4">
                    <button type="button"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 px-4 rounded-md transition duration-150 ease-in-out"
                        onclick="closeTindakModal()">Batal</button>
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-md transition duration-150 ease-in-out">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>

    @include('layout.button_floating')

    <script>
        function toggleDropdown(reportId) {
            const dropdownContent = document.getElementById('dropdownContent' + reportId);
            dropdownContent.classList.toggle('hidden');
        }

        function openModal(imageSrc) {
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('photoModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('photoModal').classList.add('hidden');
        }

        function openTindakModal(event, reportId) {
            event.preventDefault();

            // Tampilkan modal
            document.getElementById('tindakModal').classList.remove('hidden');

            // Set nilai reportId ke input hidden di dalam modal
            const reportIdInput = document.getElementById('reportIdInput');
            if (reportIdInput) {
                reportIdInput.value = reportId;
            }
        }

        function closeTindakModal() {
            // Sembunyikan modal
            document.getElementById('tindakModal').classList.add('hidden');

            // Reset input hidden untuk reportId jika diperlukan
            const reportIdInput = document.getElementById('reportIdInput');
            if (reportIdInput) {
                reportIdInput.value = '';
            }
        }


        document.addEventListener('DOMContentLoaded', function() {
            const sortButton = document.getElementById('sortVotes');
            sortButton.addEventListener('click', function() {
                const currentUrl = new URL(window.location.href);
                const currentSort = currentUrl.searchParams.get('sort') || 'desc';
                const newSort = currentSort === 'desc' ? 'asc' : 'desc';

                currentUrl.searchParams.set('sort', newSort);
                window.location.href = currentUrl.toString();
            });
        });


        // Open and close the dropdown menu
        document.getElementById('exportButton').addEventListener('click', function() {
            document.getElementById('exportDropdown').classList.toggle('hidden');
        });

        // Open the Date Modal
        function openDateModal() {
            document.getElementById('dateModal').classList.remove('hidden');
            document.getElementById('exportDropdown').classList.add('hidden');
        }

        // Close the Date Modal
        function closeDateModal() {
            document.getElementById('dateModal').classList.add('hidden');
        }
    </script>
</body>

</html>
