<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Staff | Progress</title>
    @include('layout.cdn')
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto py-8">
        <div class="flex flex-wrap lg:flex-nowrap gap-8 p-6">
            @include('layout.alert')
            <!-- Section Kiri: Report Info -->
            <div class="w-full lg:w-1/3 bg-white shadow-lg rounded-xl p-6 transition duration-300 ease-in-out hover:shadow-xl">
                <h2 class="text-3xl font-bold mb-6 text-gray-800">Report Info</h2>
                <!-- Gambar Laporan -->
                @if (!empty($report->image))
                <img src="{{ asset('storage/assets/images/reports/' . $report->image) }}" alt="Report Image"
                class="w-full h-64 object-cover rounded-lg mb-6 shadow-md transition duration-300 ease-in-out hover:shadow-lg">
                @else
                <div class="w-full h-64 bg-gray-200 flex items-center justify-center rounded-lg mb-6 shadow-md">
                    <p class="text-gray-500">No Image Available</p>
                </div>
                @endif
                <h3 class="bg-green-500 text-white px-4 py-2 rounded-md inline-block">{{$report->Response->response_status}}</h3>

                <!-- Informasi Laporan -->
                <div class="space-y-3">
                    <p class="text-gray-700"><span class="font-semibold">ID Report:</span> {{ $report->id }}</p>
                    <p class="text-gray-700"><span class="font-semibold">Judul:</span> {{ $report->title }}</p>
                    <p class="text-gray-700"><span class="font-semibold">Deskripsi:</span> {{ $report->description }}</p>
                    <p class="text-gray-700"><span class="font-semibold">Tanggal Dibuat:</span> {{ $report->created_at->format('d M Y H:i') }}</p>
                </div>
            </div>

            <!-- Section Kanan: Progress Histories dan Comment -->
            <div class="w-full lg:w-2/3 bg-white shadow-lg rounded-xl p-6 flex flex-col justify-between transition duration-300 ease-in-out hover:shadow-xl">
                <!-- Histories -->
                <div>
                    <h2 class="text-3xl font-bold mb-6 text-gray-800">Progress Histories</h2>

                    @php
                        $histories = [];

                        if (isset($report->response->progres) && $report->response->progres->isNotEmpty()) {
                            $progressItem = $report->response->progres->first();

                            if (isset($progressItem->histories) && is_array($progressItem->histories)) {
                                $histories = $progressItem->histories;
                            }
                        }
                    @endphp

                    @if (count($histories) > 0)
                        <div class="relative">
                            <!-- Garis Vertikal -->
                            <div class="absolute inset-0 left-6 border-l-2 border-blue-300 z-0"></div>
                            <div class="space-y-8">
                                @foreach ($histories as $index => $history)
                                    <div class="flex items-start relative z-10">
                                        <!-- Titik Progress -->
                                        <div
                                            class="absolute top-0 left-0 w-12 h-12 rounded-full bg-blue-500 text-white flex items-center justify-center shadow-md transition duration-300 ease-in-out hover:bg-blue-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                            </svg>
                                        </div>
                                        <form action="{{ route('delete_progress', ['id' => $report->id, 'historyIndex' => $index]) }}" method="post" class="m-0 ml-16 p-0">
                                            @csrf
                                            @method('delete')
                                            <button class="text-red-500 hover:text-red-700 transition duration-300 ease-in-out" type="submit">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                        <!-- Deskripsi Progress -->
                                        <div class="ml-16">
                                            <p class="text-sm text-gray-500 mb-1">
                                                {{ \Carbon\Carbon::parse($history['created_at'])->format('d M Y H:i') }}
                                            </p>
                                            <p class="text-base text-gray-700">{{ $history['description'] }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <p class="text-gray-500">Belum ada progres yang dicatat.</p>
                    @endif
                </div>

                <!-- Button -->
                <div class="mt-8 flex justify-between">
                    <button
                    class="block w-full text-center bg-blue-500 text-white py-3 rounded-lg hover:bg-blue-600 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-lg"
                    onclick="toggleModal(true)">
                    Add Comment
                </button>
                <a href="{{ route('staff_page') }}"
                    class="block w-full text-center bg-green-500 text-white py-3 rounded-lg hover:bg-blue-600 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-lg">
                    Done
                </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="commentModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden transition duration-300 ease-in-out z-30">
        <div class="bg-white rounded-xl shadow-2xl p-8 w-full max-w-md transform transition-all duration-300 ease-in-out">
            <h2 class="text-3xl font-bold mb-6 text-gray-800">Tambah Progress</h2>
            <form action="{{ route('staff_response_progress', $report->id) }}" method="POST">
                @csrf
                <div class="mb-6">
                    <label for="Response_progress" class="block text-sm font-medium text-gray-700 mb-2">Progress</label>
                    <textarea id="Response_progress" name="Response_progress" rows="4"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300 ease-in-out"></textarea>
                </div>
                <div class="flex justify-end gap-4">
                    <button type="button" onclick="toggleModal(false)"
                        class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition duration-300 ease-in-out">
                        Batal
                    </button>
                    <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition duration-300 ease-in-out">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
    @include('layout.button_floating')

    <!-- Script for Modal -->
    <script>
        function toggleModal(show) {
            const modal = document.getElementById('commentModal');
            if (show) {
                modal.classList.remove('hidden');
                modal.classList.add('opacity-0');
                setTimeout(() => {
                    modal.classList.remove('opacity-0');
                }, 20);
            } else {
                modal.classList.add('opacity-0');
                setTimeout(() => {
                    modal.classList.add('hidden');
                }, 300);
            }
        }
    </script>

</body>

</html>
