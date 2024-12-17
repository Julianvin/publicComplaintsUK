<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Head staff | Form Pembuatan Akun</title>
    @include('layout.cdn')
</head>

<body class="bg-gray-100 p-5">
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Bagian Kiri: Tabel Data Akun -->
        <div class="bg-white p-5 rounded shadow" data-aos="fade-right">
            <h2 class="text-2xl font-bold mb-4">Data Akun Role: STAFF</h2>
            <table class="table-auto w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="py-2 px-4 border-b">Email</th>
                        <th class="py-2 px-4 border-b">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($staffUsers as $user)
                        <tr class="hover:bg-gray-100">
                            <td class="py-2 px-4 border-b">{{ $user->email }}</td>
                            <td class="py-2 px-4 border-b">
                                <button class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600 transition">
                                    <i class="fa-solid fa-trash"></i> Hapus
                                </button>
                                <button class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600 transition">
                                    <i class="fa-solid fa-rotate-right"></i> Reset
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="py-4 px-4 text-center text-gray-500">
                                Tidak ada data staff yang tersedia.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="bg-white p-5 rounded shadow" data-aos="fade-left">
            <h2 class="text-2xl font-bold mb-4">Form Pembuatan Akun</h2>
            <form id="accountForm" method="POST" action="{{ route('headstaff_store_acc') }}">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                    <input type="email" id="email" name="email" placeholder="Masukkan email"
                        class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                </div>
                <div class="mb-4 relative">
                    <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                    <input type="password" id="password" name="password" placeholder="Masukkan password"
                        class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                    <span id="togglePassword" class="absolute right-3 top-10 cursor-pointer">
                        <i class="fa-solid fa-eye-slash text-gray-500" id="eyeIcon"></i>
                    </span>
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                    <i class="fa-solid fa-user-plus"></i> Tambah Akun
                </button>
            </form>
        </div>
    </div>
    @include('layout.button_floating')

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();

        // Toggle Visibility Password
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.type === 'password' ? 'text' : 'password';
            passwordInput.type = type;

            // Ganti icon mata FontAwesome
            if (type === 'text') {
                eyeIcon.classList.replace('fa-eye-slash', 'fa-eye');
            } else {
                eyeIcon.classList.replace('fa-eye', 'fa-eye-slash');
            }
        });
    </script>
</body>

</html>
