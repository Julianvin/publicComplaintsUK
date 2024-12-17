<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Report</title>
    @include('layout.cdn')
</head>
<body class="bg-gradient-to-r from-blue-100 to-purple-100 min-h-screen p-8">
    <div class="flex flex-col items-center justify-center min-h-screen">
        <div class="w-full max-w-4xl bg-white shadow-md rounded-lg p-8">
            <h1 class="text-2xl font-bold text-center text-green-500 mb-6">Keluhan</h1>

            <form action="{{ route('guest_store_report') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label for="provinsi" class="block text-sm font-medium text-gray-700">Provinsi*</label>
                    <select id="provinsi" name="provinsi" class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500">
                        <!-- Add other provinces here -->
                    </select>
                    @error('provinsi')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="kota" class="block text-sm font-medium text-gray-700">Kota/Kabupaten*</label>
                    <select id="kota" name="kota" class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500">
                    </select>
                    @error('kota')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="kecamatan" class="block text-sm font-medium text-gray-700">Kecamatan*</label>
                    <select id="kecamatan" name="kecamatan" class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500">
                    </select>
                    @error('kecamatan')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="kelurahan" class="block text-sm font-medium text-gray-700">Kelurahan*</label>
                    <select id="kelurahan" name="kelurahan" class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500">
                    </select>
                    @error('kelurahan')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700">Type*</label>
                    <select id="type" name="type" class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500">
                        <option value="KEJAHATAN" {{ old('type') == 'KEJAHATAN' ? 'selected' : '' }}>Kejahatan</option>
                        <option value="PEMBANGUNAN" {{ old('type') == 'PEMBANGUNAN' ? 'selected' : '' }}>Pembangunan</option>
                        <option value="SOSIAL" {{ old('type') == 'SOSIAL' ? 'selected' : '' }}>Sosial</option>
                    </select>
                    @error('type')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="detail" class="block text-sm font-medium text-gray-700">Detail Keluhan*</label>
                    <textarea id="detail" name="detail" rows="4" class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500">{{ old('detail') }}</textarea>
                    @error('detail')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="gambar" class="block text-sm font-medium text-gray-700">Gambar Pendukung*</label>
                    <input id="gambar" name="gambar" type="file" class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500">
                    @error('gambar')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex items-center">
                    <input id="konfirmasi" name="konfirmasi" type="checkbox" class="h-4 w-4 text-orange-500 focus:ring-orange-500 border-gray-300 rounded" {{ old('konfirmasi') ? 'checked' : '' }}>
                    <label for="konfirmasi" class="ml-2 block text-sm text-gray-700">Laporan yang disampaikan sesuai dengan kebenaran.</label>
                    @error('konfirmasi')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="text-center">
                    <button type="submit" class="px-6 py-2 bg-green-600 text-white font-semibold rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Kirim
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Floating Buttons -->
    @include('layout.button_floating')

    <script src="{{ asset('assets/js/guest/create_report.js') }}  "></script>
</body>
</html>
