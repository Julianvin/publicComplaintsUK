<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">
    <title>Pengaduan Masyarakat</title>
    <link rel="icon"
        href="{{ asset('assets/image/wikrama-logo.png') }}"
        type="image/png">
    @include('layout.cdn')
</head>

<body class="min-h-screen">

    @include('layout.alert')

    <main class="relative min-h-screen overflow-hidden">
        <!-- Background container -->
        <div class="absolute inset-0 flex">
            <!-- Orange gradient section -->
            <div class="w-[55%] bg-gradient-to-r from-green-500 to-green-400"></div>
            <!-- Image section -->
            <div class="w-[45%] relative">
                <img src="{{ asset('assets/image/report.jpeg') }}"
                    alt="Background"
                    class="h-full w-full object-cover opacity-60">
                <!-- Diagonal divider -->
                <div class="absolute inset-0 -left-48">
                    <div class="h-full w-64 bg-green-400 transform -skew-x-12"></div>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="relative z-10 flex min-h-screen">
            <!-- Left content -->
            <div class="w-1/2 p-16 flex flex-col justify-center">
                <h1 class="text-white text-5xl font-bold mb-6">
                    Login
                </h1>
                <form action="{{ route('login.auth') }}"
                    method="POST"
                    class="w-96">
                    @csrf
                    <div class="mb-4">
                        <label for="email"
                            class="block text-white text-sm font-bold mb-2">Email</label>
                        <input type="email"
                            name="email"
                            id="email"
                            class="w-full px-4 py-2 border-2 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-200"
                            required>
                    </div>
                    <div class="mb-4">
                        <label for="password"
                            class="block text-white text-sm font-bold mb-2">Password</label>
                        <input type="password"
                            name="password"
                            id="password"
                            class="w-full px-4 py-2 border-2 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-200"
                            required>
                    </div>
                    <div class="flex items-center pt-4 pr-4 gap-4">
                        <button type="submit"
                            name="action"
                            value="login"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md">Login</button>
                        <button type="submit"
                            name="action"
                            value="register"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md text-center">daftar
                            akun</button>
                    </div>
                </form>
            </div>
            <!-- Right floating buttons -->
            @include('layout.button_floating')
        </div>
    </main>
</body>

</html>
