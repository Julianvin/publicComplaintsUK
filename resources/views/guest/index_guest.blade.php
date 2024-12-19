<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        const USER_ID = @json(auth()->id());
    </script>
    @include('layout.cdn')
    <style>
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeInUp {
            animation: fadeInUp 0.5s ease-out forwards;
        }
        @keyframes popUp {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
        .animate-popUp {
            animation: popUp 0.3s ease-out;
        }
        .custom-scrollbar {
            scrollbar-width: thin;
            scrollbar-color: rgba(156, 163, 175, 0.5) transparent;
        }
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: rgba(156, 163, 175, 0.5);
            border-radius: 20px;
            border: transparent;
        }
        .vote-animation {
            position: absolute;
            font-size: 1rem;
            font-weight: bold;
            color: #ff5722;
            animation: popUp 1s ease-out forwards;
            pointer-events: none;
        }
    </style>
</head>

<body class="bg-gradient-to-r from-blue-100 to-purple-100 min-h-screen p-4 md:p-8">

    <!-- Main Container -->
    <div class="max-w-screen-xl mx-auto p-4 md:p-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            @include('layout.alert')
            <div class="lg:col-span-2 space-y-6">
                <!-- Search Bar -->
                <form action="" method="GET" class="flex flex-wrap md:flex-nowrap items-center gap-2 animate-fadeInUp">
                    <select name="province" id="province" class="w-full md:w-auto flex-grow p-2 text-sm text-gray-900 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 transition duration-300">
                        <option selected>Pilih Provinsi</option>
                    </select>
                    <a href="{{ route('guest_page') }}" class="w-full md:w-auto flex items-center justify-center px-4 py-2 text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-lg focus:outline-none focus:ring-4 focus:ring-gray-300 transition duration-300">
                        <i class="fas fa-times mr-2"></i>Reset
                    </a>
                    <button type="submit" class="w-full md:w-auto flex items-center justify-center px-4 py-2 text-white bg-green-600 hover:bg-green-700 rounded-lg focus:outline-none focus:ring-4 focus:ring-green-300 transition duration-300">
                        <i class="fas fa-search mr-2"></i>Cari
                    </button>
                </form>

                <!-- Reports Section -->
                <div class="space-y-4 my-6 max-h-[calc(85vh-70px)] overflow-y-auto pr-2 custom-scrollbar">
                    @forelse ($reports as $index => $report)
                        <div class="relative flex bg-white rounded-lg shadow-md p-4 items-center report-card animate-fadeInUp" style="animation-delay: {{ $index * 0.1 }}s;" data-report-id="{{ $report->id }}">
                            <img src="{{ asset('storage/assets/images/reports/' . $report->image) }}" alt="{{ $report->description }}" class="w-36 h-24 rounded object-cover transition duration-300 transform hover:scale-105">
                            <div class="ml-4 flex-grow">
                                <h5 class="font-semibold text-lg text-gray-800 hover:text-green-600 transition duration-300">
                                    <a href="{{ route('report_comment', $report->id) }}" class="hover:underline">
                                        {{ Str::limit($report->description, 50) }}
                                    </a>
                                </h5>
                                <div class="text-sm text-gray-500 space-x-3 mt-2">
                                    <span class="inline-flex items-center"><i class="fas fa-eye mr-1"></i><span class="viewers-count">{{ $report->viewers }}</span></span>
                                    <span class="inline-flex items-center"><i class="fas fa-comments mr-1"></i><span class="comments-count">{{ $report->Comment->count() }}</span></span>
                                    <span class="inline-flex items-center"><i class="fas fa-fire mr-1 fire-icon cursor-pointer text-red-500"></i><span class="voting-count">{{ count(json_decode($report->voting, true)) }}</span></span>
                                    <span class="inline-flex items-center"><i class="fas fa-user mr-1"></i>{{ $report->user->email ?? 'Anonim' }}</span>
                                    <span class="inline-flex items-center"><i class="fas fa-clock mr-1"></i>{{ $report->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            <i class="fas fa-fire absolute top-2 right-2 text-xl fire-icon cursor-pointer text-red-500 hover:text-red-600 transition duration-300 transform hover:scale-110"></i>
                        </div>
                    @empty
                        <div class="text-center p-6 bg-gray-100 rounded-lg shadow-md animate-fadeInUp">
                            <i class="fas fa-exclamation-circle text-4xl text-gray-400 mb-4"></i>
                            <p class="text-gray-600 font-semibold text-lg">Tidak ada laporan yang tersedia.</p>
                            <p class="text-gray-400 mt-2">Cobalah untuk memuat ulang atau tambahkan laporan baru.</p>
                            <button onclick="location.reload()" class="mt-4 px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition duration-300">
                                <i class="fas fa-sync-alt mr-2"></i>Muat Ulang
                            </button>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Right Section -->
            <div class="lg:fixed lg:top-1/4 lg:right-4 lg:transform lg:-translate-y-1/2 w-full max-w-md animate-fadeInUp" style="animation-delay: 0.3s;">
                <div class="bg-white p-6 rounded-lg shadow-lg transition duration-300 hover:shadow-xl">
                    <h3 class="text-yellow-600 text-xl font-bold mb-4">Informasi Pembuatan Pengaduan</h3>
                    <ol class="list-decimal text-gray-700 space-y-2 pl-4">
                        <li class="transition duration-300 hover:text-green-600">Pengaduan bisa dibuat hanya jika Anda telah membuat akun sebelumnya.</li>
                        <li class="transition duration-300 hover:text-green-600">Keseluruhan data pada pengaduan bernilai BENAR dan DAPAT DIPERTANGGUNG JAWABKAN.</li>
                        <li class="transition duration-300 hover:text-green-600">Seluruh bagian data perlu diisi.</li>
                        <li class="transition duration-300 hover:text-green-600">Periksa tanggapan kami pada Dashboard setelah Anda Login.</li>
                        <li class="transition duration-300 hover:text-green-600">Pembuatan pengaduan dapat dilakukan pada halaman berikut:
                            <a href="{{ route('guest_create_report') }}" class="text-blue-600 underline hover:text-blue-800 transition duration-300">Ikuti Tautan</a>.
                        </li>
                    </ol>
                </div>
            </div>

            @include('layout.button_floating')
        </div>
    </div>

    <script src="{{ asset('assets/js/guest/index.js') }}"></script>
</body>

</html>
