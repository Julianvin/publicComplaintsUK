<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>staff | Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        #imageModal {
            display: none; /* Disembunyikan secara default */
        }
    </style>

    @includeIf('layout.cdn')
    <script>
        const USER_ID = @json(auth()->id());
    </script>
</head>
<body>
    <div class="container mx-auto p-5">
        <h1 class="text-2xl font-bold mb-5">Dashboard Staff Province</h1>
        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2">Gambar & Pengirim</th>
                    <th class="border border-gray-300 px-4 py-2">Lokasi & Tanggal</th>
                    <th class="border border-gray-300 px-4 py-2">Deskripsi</th>
                    <th class="border border-gray-300 px-4 py-2">
                        <div class="flex items-center justify-between">
                            Jumlah Vote
                            <!-- Tombol Order -->
                            <a href="{{ url()->current() }}?order={{ $order === 'asc' ? 'desc' : 'asc' }}"
                                class="text-blue-500 underline ml-2">
                                {{ $order === 'asc' ? '⬇️' : '⬆️' }}
                            </a>
                        </div>
                    </th>
                    <th class="border border-gray-300 px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @include('layout.alert')
                @forelse($reports as $report)
                <tr class="border-t">
                    <!-- Gambar & Pengirim -->
                    <td class="border border-gray-300 px-4 py-2 flex items-center">
                        <img src="{{ asset('storage/assets/images/reports/' . $report->image ?? 'default-image.jpg') }}" alt="User Image" class="h-10 w-10 rounded-full mr-3">
                        <span>{{ $report->user->email ?? 'Unknown User' }}</span>
                    </td>
                    <!-- Lokasi & Tanggal -->
                    <td class="border border-gray-300 px-4 py-2">
                        <span>{{ strtoupper($report->village) }}, {{ strtoupper($report->subdistrict) }}, {{ strtoupper($report->regency) }}, {{ strtoupper($report->province) }}</span><br>
                        <span>{{ \Carbon\Carbon::parse($report->created_at)->format('d F Y') }}</span>
                    </td>
                    <!-- Deskripsi -->
                    <td class="border border-gray-300 px-4 py-2">
                        {{ \Illuminate\Support\Str::limit($report->description, 50, '...') }}
                    </td>
                    <!-- Jumlah Vote -->
                    <td class="border border-gray-300 px-4 py-2 text-center">
                        {{ $report->voting ? count(json_decode($report->voting, true)) : 0 }}
                    </td>
                    <!-- Aksi -->
                    <td class="border border-gray-300 px-4 py-2 text-center">
                        <div class="relative">
                            <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 py-1 px-3 rounded">
                                Aksi
                            </button>
                            <!-- Tambahkan dropdown aksi jika diperlukan -->
                        </div>
                    </td>
                </tr>
                @empty
                <!-- Jika tidak ada data -->
                <tr>
                    <td colspan="5" class="text-center py-4 text-gray-500">
                        Tidak ada laporan yang tersedia.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Modal -->
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="relative">
        <img id="modalImage" src="" alt="Modal Image" class="max-w-full max-h-full rounded-lg">
        <button id="closeModal" class="absolute top-0 right-0 mt-2 mr-2 text-white text-xl">✕</button>
    </div>
</div>


        @include('layout.button_floating')
    </div>

    <script>
        // Ambil elemen modal dan elemen lainnya
        const imageModal = document.getElementById('imageModal');
        const modalImage = document.getElementById('modalImage');
        const closeModal = document.getElementById('closeModal');

        // Event listener untuk gambar
        document.querySelectorAll('img').forEach(img => {
            img.addEventListener('click', function () {
                modalImage.src = this.src; 
                imageModal.style.display = 'flex';
            });
        });
        closeModal.addEventListener('click', function () {
            imageModal.style.display = 'none'; // Sembunyikan modal
        });

        // Tutup modal jika klik di luar gambar
        imageModal.addEventListener('click', function (e) {
            if (e.target === imageModal) {
                imageModal.style.display = 'none'; // Sembunyikan modal
            }
        });
    </script>

</body>
</html>
