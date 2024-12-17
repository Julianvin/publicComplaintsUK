<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Head staff | Form Pembuatan Akun</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        const USER_ID = @json(auth()->id());
    </script>
    @include('layout.cdn')
    <style>
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .animate-fadeIn {
            animation: fadeIn 0.5s ease-out;
        }
    </style>
</head>

<body class="bg-gradient-to-r from-blue-100 to-purple-100 min-h-screen p-8">
    @include('layout.alert')
    <div class="container mx-auto max-w-6xl">
        <h1 class="text-4xl font-bold text-center mb-10 text-gray-800 animate-fadeIn">Head Staff Dashboard</h1>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Bagian Kiri: Tabel Data Akun -->
            <div class="bg-white p-6 rounded-lg shadow-lg transition-all duration-300 hover:shadow-xl" data-aos="fade-right">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Data Akun Role: STAFF</h2>
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="py-3 px-4 text-left text-gray-600">Email</th>
                                <th class="py-3 px-4 text-left text-gray-600">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($staffUsers as $user)
                                <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors duration-200">
                                    <td class="py-3 px-4">{{ $user->email }}</td>
                                    <td class="py-3 px-4">
                                        <div class="flex items-center gap-2">
                                            <a href="javascript:void(0);" onclick="confirmDelete({{ $user->id }})"
                                                class="flex items-center bg-red-500 text-white px-3 py-2 rounded hover:bg-red-600 transition-colors duration-200">
                                                <i class="fa-solid fa-trash mr-2"></i> Hapus
                                            </a>
                                            <form action="{{ route('reset_password_staff', $user->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="flex items-center bg-yellow-500 text-white px-3 py-2 rounded hover:bg-yellow-600 transition-colors duration-200">
                                                    <i class="fa-solid fa-key mr-2"></i> Reset
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center py-4 text-gray-500">Tidak ada data staff.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Bagian Kanan: Form Pembuatan Akun -->
            <div class="bg-white p-6 rounded-lg shadow-lg transition-all duration-300 hover:shadow-xl" data-aos="fade-left">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Form Pembuatan Akun</h2>
                <form id="accountForm" method="POST" action="{{ route('headstaff_store_acc') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                        <input type="email" id="email" name="email" placeholder="Masukkan email"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors duration-200"
                            required>
                    </div>
                    <div class="relative">
                        <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                        <input type="password" id="password" name="password" placeholder="Masukkan password"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors duration-200"
                            required>
                        <span id="togglePassword" class="absolute right-3 top-10 cursor-pointer">
                            <i class="fa-solid fa-eye-slash text-gray-500" id="eyeIcon"></i>
                        </span>
                    </div>
                    <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors duration-200 transform hover:scale-105">
                        <i class="fa-solid fa-user-plus mr-2"></i> Tambah Akun
                    </button>
                </form>
            </div>
        </div>
    </div>
    @include('layout.button_floating')

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true,
        });

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

        function confirmDelete(userId) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Akun ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect ke route penghapusan
                    window.location.href = `/headstaff/destroy/${userId}`;
                }
            });
        }
    </script>
</body>

</html>