<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    @include('layout.cdn')
    <meta name="csrf-token"
        content="{{ csrf_token() }}">
    <script>
        const USER_ID = @json(auth()->id());
    </script>
    <style>
        /* Animasi untuk +1 */
        .vote-animation {
            position: absolute;
            font-size: 1rem;
            font-weight: bold;
            color: #ff5722;
            animation: popUp 1s ease-out forwards;
            pointer-events: none;
        }

        @keyframes popUp {
            0% {
                transform: translateY(0);
                opacity: 1;
            }

            100% {
                transform: translateY(-50px);
                opacity: 0;
            }
        }

        .custom-scrollbar {
            max-height: 12rem;
            overflow-y: auto;
        }

        .custom-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .custom-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>

<body class="bg-gradient-to-r from-blue-100 to-purple-100 min-h-screen p-8">

    @include('layout.alert')


    <!-- Main Container -->
    <div class="max-w-screen-xl mx-auto p-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2">
                <!-- Search Bar -->
                <form action=""
                    method="GET"
                    class="flex items-center space-x-2">
                    <!-- Dropdown Province -->
                    <select name="province"
                        id="province"
                        class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        <option selected>Pilih</option>
                    </select>
                    <a href="{{ route('guest_page') }}"
                        class="flex items-center px-4 py-2 text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-lg focus:outline-none focus:ring-4 focus:ring-gray-300">
                        <i class="fas fa-times"></i> <!-- Ikon FontAwesome -->
                    </a>
                    <button type="submit"
                        class="px-4 py-2 text-white bg-green-800 hover:bg-green-900 rounded-lg focus:outline-none focus:ring-4 focus:ring-gray-300">
                        Cari
                    </button>
                </form>


                <div class="space-y-6 my-6 max-h-[calc(90vh-70px)] overflow-y-auto pr-2 custom-scrollbar">
                    @forelse ($reports as $report)
                        <div class="relative flex bg-white rounded-lg shadow-md p-4 items-center report-card"
                            data-report-id="{{ $report->id }}">
                            <!-- Gambar Pengaduan -->
                            <img src="{{ asset('storage/assets/images/reports/' . $report->image) }}"
                                alt="{{ $report->description }}"
                                class="w-36 h-24 rounded object-cover">

                            <div class="ml-4 flex-grow">
                                <h5 class="font-semibold text-lg text-gray-800">
                                    <a href="{{ route('report_comment', $report->id) }}"
                                        class="hover:underline">
                                        {{ Str::limit($report->description, 50) }}
                                    </a>
                                </h5>
                                <div class="text-sm text-gray-500 space-x-3">
                                    <span><i class="fas fa-eye"></i>
                                        <span class="viewers-count">{{ $report->viewers }}</span>
                                    </span>
                                    <span><i class="fas fa-comments"></i>
                                        <span class="comments-count">{{ $report->Comment->count() }}</span>
                                    </span>
                                    <span><i class="fas fa-fire fire-icon" style="color: #c32222; cursor: pointer;"></i>
                                        <span
                                            class="voting-count">{{ count(json_decode($report->voting, true)) }}</span>
                                    </span>
                                    <span>{{ $report->user->email ?? 'Anonim' }}</span>
                                    <span>{{ $report->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            <i class="fas fa-fire absolute top-2 right-2 text-xl fire-icon"
                                style="color: #c32222; cursor: pointer;"></i>
                        </div>
                    @empty
                        <div class="text-center p-6 bg-gray-100 rounded-lg shadow-md">
                            <p class="text-gray-600 font-semibold text-lg">Tidak ada laporan yang tersedia.</p>
                            <p class="text-gray-400 mt-2">Cobalah untuk memuat ulang atau tambahkan laporan baru.</p>
                        </div>
                    @endforelse

                </div>


            </div>

            <!-- Right Section -->
            <div class="fixed top-1/2 right-4 transform -translate-y-1/2 w-full max-w-md">
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-yellow-600 text-xl font-bold mb-4">Informasi Pembuatan Pengaduan</h3>
                    <ol class="list-decimal text-gray-700 space-y-2 pl-4">
                        <li>Pengaduan bisa dibuat hanya jika Anda telah membuat akun sebelumnya.</li>
                        <li>Keseluruhan data pada pengaduan bernilai BENAR dan DAPAT DIPERTANGGUNG JAWABKAN.</li>
                        <li>Seluruh bagian data perlu diisi.</li>
                        <li>Periksa tanggapan kami pada Dashboard setelah Anda Login.</li>
                        <li>Pembuatan pengaduan dapat dilakukan pada halaman berikut: <a
                                href="{{ route('guest_create_report') }}"
                                class="text-blue-600 underline">Ikuti Tautan</a>.</li>
                    </ol>
                </div>
            </div>

            @include('layout.button_floating')

        </div>
    </div>

    <script src="{{ asset('assets/js/guest/index.js') }}"></script>

</body>

</html>
