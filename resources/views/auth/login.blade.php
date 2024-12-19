<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaduan Masyarakat - Login</title>
    <link rel="icon" href="{{ asset('assets/image/wikrama-logo.png') }}" type="image/png">
    @include('layout.cdn')
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeIn {
            animation: fadeIn 0.5s ease-out forwards;
        }
        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .animate-gradient {
            background: linear-gradient(-45deg, #4ade80, #22c55e, #16a34a);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
        }
    </style>
</head>

<body class="min-h-screen bg-gray-100">
    
    <main class="relative min-h-screen overflow-hidden flex">
        @include('layout.alert')
        <!-- Animated background -->
        <div class="absolute inset-0 animate-gradient"></div>

        <!-- Content -->
        <div class="relative z-10 flex min-h-screen w-full">
            <!-- Left content -->
            <div class="w-full md:w-1/2 p-8 md:p-16 flex flex-col justify-center items-center">
                <div class="w-full max-w-md bg-white rounded-lg shadow-xl p-8 animate-fadeIn" style="animation-delay: 0.2s;">
                    <h1 class="text-3xl md:text-4xl font-bold mb-6 text-center text-gray-800">
                        Login
                    </h1>
                    <form action="{{ route('login.auth') }}" method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-envelope text-gray-400"></i>
                                </div>
                                <input type="email" name="email" id="email" 
                                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 sm:text-sm transition duration-150 ease-in-out" 
                                    placeholder="you@example.com" required>
                            </div>
                        </div>
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-400"></i>
                                </div>
                                <input type="password" name="password" id="password" 
                                    class="block w-full pl-10 pr-10 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 sm:text-sm transition duration-150 ease-in-out" 
                                    placeholder="••••••••" required>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <button type="button" id="togglePassword" class="text-gray-400 hover:text-gray-500 focus:outline-none focus:text-gray-500 transition ease-in-out duration-150">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between space-x-4">
                            <button type="submit" name="action" value="login"
                                class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-md transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                                Login
                            </button>
                            <button type="submit" name="action" value="register"
                                class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                Daftar Akun
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right image section -->
            <div class="hidden md:block w-1/2 relative overflow-hidden">
                <img src="{{ asset('assets/image/report.jpeg') }}" alt="Background" 
                    class="absolute inset-0 h-full w-full object-cover opacity-80">
                <div class="absolute inset-0 bg-gradient-to-r from-green-500 to-transparent opacity-75"></div>
            </div>

            <!-- Right floating buttons -->
            @include('layout.button_floating')
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.getElementById('togglePassword');
            const password = document.getElementById('password');

            togglePassword.addEventListener('click', function() {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                this.querySelector('i').classList.toggle('fa-eye');
                this.querySelector('i').classList.toggle('fa-eye-slash');
            });

            // Add subtle animations to form inputs
            const inputs = document.querySelectorAll('input');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('ring-2', 'ring-green-200');
                });
                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('ring-2', 'ring-green-200');
                });
            });
        });
    </script>
</body>

</html>