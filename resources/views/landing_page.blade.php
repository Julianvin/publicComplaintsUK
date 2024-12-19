<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaduan Masyarakat</title>
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
        <!-- Animated background -->
        <div class="absolute inset-0 animate-gradient"></div>
        
        <!-- Content -->
        <div class="relative z-10 flex min-h-screen w-full">
            @include('layout.alert')
            <!-- Left content -->
            <div class="w-full md:w-3/5 p-8 md:p-16 flex flex-col justify-center">
                <div class="max-w-2xl animate-fadeIn" style="animation-delay: 0.2s;">
                    <h1 class="text-4xl md:text-5xl font-bold mb-6 text-white">
                        Pengaduan<br/>
                        Masyarakat
                    </h1>
                    <p class="text-white text-lg mb-8 max-w-xl">
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eligendi perspiciatis aut pariatur doloremque laborum quis in praesentium at, recusandae obcaecati dicta accusantium delectus asperiores illum minima veritatis iure quidem amet rerum fugit quaerat illo!
                    </p>
                    <a href="{{ route('login') }}" class="inline-block bg-teal-800 text-white px-8 py-3 rounded-md hover:bg-teal-700 transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-opacity-50">
                        <i class="fas fa-user-plus mr-2"></i>BERGABUNG
                    </a>
                </div>
            </div>

            <!-- Right image section -->
            <div class="hidden md:block w-2/5 relative overflow-hidden">
                <img src="{{asset('assets/image/report.jpeg')}}" alt="Background" 
                    class="absolute inset-0 h-full w-full object-cover opacity-80">
                <div class="absolute inset-0 bg-gradient-to-l from-green-500 to-transparent opacity-75"></div>
            </div>

            <!-- Right floating buttons -->
            @include('layout.button_floating')
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add subtle animations to content
            const content = document.querySelector('.animate-fadeIn');
            content.style.opacity = '0';
            content.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                content.style.opacity = '1';
                content.style.transform = 'translateY(0)';
            }, 200);

            // Add hover effect to the button
            const button = document.querySelector('a[href="{{ route('login') }}"]');
            button.addEventListener('mouseenter', function() {
                this.classList.add('shadow-lg');
            });
            button.addEventListener('mouseleave', function() {
                this.classList.remove('shadow-lg');
            });
        });
    </script>
</body>
</html>