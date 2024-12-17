<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible"
        content="ie=edge">
    <title>Detail Pengaduan</title>
    @include('layout.cdn')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Membatasi tinggi kontainer dan menyembunyikan scrollbar */
        .custom-scrollbar {
            max-height: 12rem;
            /* Sesuaikan dengan kebutuhan */
            overflow-y: auto;
        }

        /* Hilangkan scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            display: none;
            /* Untuk browser berbasis Webkit */
        }

        .custom-scrollbar {
            -ms-overflow-style: none;
            /* Internet Explorer */
            scrollbar-width: none;
            /* Firefox */
        }
    </style>

</head>

<body class="bg-gradient-to-r from-blue-100 to-purple-100 min-h-screen p-8">
    <div class="max-w-screen-xl mx-auto p-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            @include('layout.alert')

            <!-- Left Section -->
            <div class="lg:col-span-2">
                <div class="container mx-auto mt-10 px-4 sm:px-6 lg:px-8">
                    <div class="bg-white rounded-lg shadow-xl overflow-hidden">
                        <!-- Header Report -->
                        <!-- Bagian Gambar Pengaduan -->
                        <div class="relative">
                            <img src="{{ asset('storage/assets/images/reports/' . $report->image) }}"
                                alt="Gambar Pengaduan"
                                class="w-full max-h-[200px] object-contain rounded-t-lg shadow-lg">
                            <div class="absolute bottom-4 left-4 bg-black bg-opacity-50 py-2 px-4 rounded-lg">
                                <h1 class="text-1xl font-bold text-white">Detail Pengaduan</h1>
                            </div>
                        </div>


                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-2xl font-bold text-gray-800">
                                    Pengaduan
                                    {{ \Carbon\Carbon::parse($report->created_at)->locale('id')->translatedFormat('j F Y') }}
                                </h3>
                                <span
                                    class="px-4 py-2 rounded-full text-white text-sm font-semibold
                                    @if ($report->type === 'KEJAHATAN') bg-red-500 
                                    @elseif($report->type === 'PEMBANGUNAN') bg-blue-500 
                                    @elseif($report->type === 'SOSIAL') bg-green-500 
                                    @else bg-gray-400 @endif">
                                    {{ $report->type }}
                                </span>
                            </div>
                            <p class="text-gray-600 mb-4 break-words">{{ $report->description }}</p>

                            <!-- Location Information -->
                            <div class="bg-gray-100 p-4 rounded-lg mb-6">
                                <h4 class="font-semibold text-gray-700 mb-2">Lokasi:</h4>
                                <p class="text-gray-600">{{ $report->village }}, {{ $report->subdistrict }},
                                    {{ $report->regency }}, {{ $report->province }}</p>
                            </div>

                            <div class="mb-6">
                                <h2 class="text-2xl font-semibold text-gray-700 mb-4">Komentar</h2>
                                <div class="max-h-48 overflow-y-auto pr-4 space-y-4 custom-scrollbar">
                                    @forelse ($comments as $comment)
                                        <div class="flex items-start space-x-3 pb-3 border-b border-gray-200">
                                            <div class="flex-grow">
                                                <div class="flex items-center justify-between">
                                                    <p class="font-semibold text-sm text-gray-800">
                                                        {{ $comment->user->email }}</p>
                                                    <p class="text-xs text-gray-500">
                                                        {{ $comment->created_at->diffForHumans() }}</p>
                                                </div>
                                                <p class="text-md text-gray-800 mt-1">{{ $comment->comment }}</p>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-gray-500 italic">Belum ada komentar.</p>
                                    @endforelse
                                </div>
                            </div>



                            <!-- Add Comment Form (Instagram-like) -->
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <form action="{{ route('report_store_comment', $report->id) }}"
                                    method="POST"
                                    class="flex items-center">
                                    @csrf
                                    <input type="text"
                                        id="comment"
                                        name="comment"
                                        class="flex-grow p-2 border border-gray-300 rounded-full focus:ring-2 focus:ring-green-200 focus:border-green-400 transition duration-200"
                                        placeholder="Tambahkan komentar...">
                                    <button type="submit"
                                        class="ml-3 px-4 py-2 bg-green-500 text-white rounded-full hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300 focus:ring-offset-2 transition duration-200">
                                        Kirim
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 text-center">
                        <a href=""
                            class="inline-block px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-200">
                            &larr; Kembali ke Daftar Laporan
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right Section -->
            <div class="lg:sticky lg:top-36 h-fit">
                <div class="bg-white p-6 rounded-lg shadow-xl">
                    <h3 class="text-2xl font-bold text-yellow-600 mb-6">Informasi Pembuatan Pengaduan</h3>
                    <ol class="list-decimal text-gray-700 space-y-4 pl-6">
                        <li class="transition duration-200 hover:text-gray-900">Pengaduan bisa dibuat hanya jika Anda
                            telah membuat akun sebelumnya.</li>
                        <li class="transition duration-200 hover:text-gray-900">Keseluruhan data pada pengaduan bernilai
                            BENAR dan DAPAT DIPERTANGGUNG JAWABKAN.</li>
                        <li class="transition duration-200 hover:text-gray-900">Seluruh bagian data perlu diisi.</li>
                        <li class="transition duration-200 hover:text-gray-900">Periksa tanggapan kami pada Dashboard
                            setelah Anda Login.</li>
                        <li class="transition duration-200 hover:text-gray-900">
                            Pembuatan pengaduan dapat dilakukan pada halaman berikut:
                            <a href="{{ route('guest_create_report') }}"
                                class="text-blue-600 underline hover:text-blue-800 transition duration-200">
                                Ikuti Tautan
                            </a>.
                        </li>
                    </ol>
                </div>
            </div>

            @include('layout.button_floating')
        </div>
    </div>

    <script>
        // Smooth scroll for internal links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Fade in elements on scroll
        function fadeInOnScroll() {
            const elements = document.querySelectorAll('.fade-in');
            elements.forEach(element => {
                const elementTop = element.getBoundingClientRect().top;
                const elementBottom = element.getBoundingClientRect().bottom;
                if (elementTop < window.innerHeight && elementBottom > 0) {
                    element.classList.add('opacity-100');
                }
            });
        }

        window.addEventListener('scroll', fadeInOnScroll);
        window.addEventListener('load', fadeInOnScroll);
    </script>
</body>

</html>
