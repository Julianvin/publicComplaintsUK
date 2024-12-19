<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Report</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    @include('layout.cdn')
    <style>
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeInUp {
            animation: fadeInUp 0.5s ease-out forwards;
        }
    </style>
</head>
<body class="bg-gradient-to-r from-blue-100 to-purple-100 min-h-screen p-4 md:p-8">
    <div class="flex flex-col items-center justify-center min-h-screen">
        <div class="w-full max-w-2xl bg-white shadow-lg rounded-lg p-8 animate-fadeInUp">
            <h1 class="text-3xl font-bold text-center text-green-600 mb-8">Buat Laporan</h1>

            <form action="{{ route('guest_store_report') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div class="animate-fadeInUp" style="animation-delay: 0.1s;">
                            <label for="provinsi" class="block text-sm font-medium text-gray-700">Provinsi*</label>
                            <select id="provinsi" name="provinsi" class="w-full mt-1 px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200">
                                <!-- Add other provinces here -->
                            </select>
                            @error('provinsi')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="animate-fadeInUp" style="animation-delay: 0.2s;">
                            <label for="kota" class="block text-sm font-medium text-gray-700">Kota/Kabupaten*</label>
                            <select id="kota" name="kota" class="w-full mt-1 px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200">
                            </select>
                            @error('kota')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="animate-fadeInUp" style="animation-delay: 0.3s;">
                            <label for="kecamatan" class="block text-sm font-medium text-gray-700">Kecamatan*</label>
                            <select id="kecamatan" name="kecamatan" class="w-full mt-1 px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200">
                            </select>
                            @error('kecamatan')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="animate-fadeInUp" style="animation-delay: 0.4s;">
                            <label for="kelurahan" class="block text-sm font-medium text-gray-700">Kelurahan*</label>
                            <select id="kelurahan" name="kelurahan" class="w-full mt-1 px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200">
                            </select>
                            @error('kelurahan')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="animate-fadeInUp" style="animation-delay: 0.5s;">
                            <label for="type" class="block text-sm font-medium text-gray-700">Tipe Laporan*</label>
                            <select id="type" name="type" class="w-full mt-1 px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200">
                                <option value="KEJAHATAN" {{ old('type') == 'KEJAHATAN' ? 'selected' : '' }}>Kejahatan</option>
                                <option value="PEMBANGUNAN" {{ old('type') == 'PEMBANGUNAN' ? 'selected' : '' }}>Pembangunan</option>
                                <option value="SOSIAL" {{ old('type') == 'SOSIAL' ? 'selected' : '' }}>Sosial</option>
                            </select>
                            @error('type')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="animate-fadeInUp" style="animation-delay: 0.6s;">
                            <label for="detail" class="block text-sm font-medium text-gray-700">Detail Keluhan*</label>
                            <textarea id="detail" name="detail" rows="4" class="w-full mt-1 px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200 resize-none">{{ old('detail') }}</textarea>
                            @error('detail')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="animate-fadeInUp" style="animation-delay: 0.7s;">
                            <label for="gambar" class="block text-sm font-medium text-gray-700">Gambar Pendukung*</label>
                            <input id="gambar" name="gambar" type="file" class="w-full mt-1 px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200">
                            @error('gambar')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="animate-fadeInUp" style="animation-delay: 0.8s;">
                    <div class="flex items-center">
                        <input id="konfirmasi" name="konfirmasi" type="checkbox" class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded transition duration-200" {{ old('konfirmasi') ? 'checked' : '' }}>
                        <label for="konfirmasi" class="ml-2 block text-sm text-gray-700">Laporan yang disampaikan sesuai dengan kebenaran.</label>
                    </div>
                    @error('konfirmasi')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="text-center animate-fadeInUp" style="animation-delay: 0.9s;">
                    <button type="submit" class="px-6 py-3 bg-green-600 text-white font-semibold rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-300 transform hover:scale-105">
                        <i class="fas fa-paper-plane mr-2"></i>Kirim Laporan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Floating Buttons -->
    @include('layout.button_floating')

    <script src="{{ asset('assets/js/guest/create_report.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const submitButton = form.querySelector('button[type="submit"]');

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                submitButton.disabled = true;
                submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Mengirim...';
                
                // Simulate form submission (replace with actual form submission)
                setTimeout(() => {
                    form.submit();
                }, 1500);
            });

            // Add animation to form fields when they come into focus
            const formFields = form.querySelectorAll('input, select, textarea');
            formFields.forEach(field => {
                field.addEventListener('focus', function() {
                    this.classList.add('scale-105');
                    this.style.transition = 'all 0.3s ease';
                });
                field.addEventListener('blur', function() {
                    this.classList.remove('scale-105');
                });
            });
        });
    </script>
</body>
</html>