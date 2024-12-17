<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaduan Masyarakat</title>
    <link rel="icon" href="{{ asset('assets/image/wikrama-logo.png') }}" type="image/png">
    @include('layout.cdn')
</head>
<body class="min-h-screen">
  <!-- Sweet Alert Notifications -->
  @include('layout.alert')
    <main class="relative min-h-screen overflow-hidden">
        <!-- Background container -->
        <div class="absolute inset-0 flex">
          <!-- Orange gradient section -->
          <div class="w-[55%] bg-gradient-to-r from-green-500 to-green-400"></div>
          <!-- Image section -->
          <div class="w-[45%] relative">
              <img src="{{asset('assets/image/report.jpeg')}}" alt="Background" class="h-full w-full object-cover opacity-60">
              <!-- Diagonal divider -->
              <div class="absolute inset-0 -left-48">
                  <div class="h-full w-64 bg-green-400 transform -skew-x-12"></div>
              </div>
          </div>
      </div>
      

        <div class="relative z-10 flex min-h-screen">
          <!-- Left content -->
          <div class="basis-3/5 p-16 flex flex-col justify-center">
              <h1 class="text-white text-5xl font-bold mb-6">
                  Pengaduan<br/>
                  Masyarakat
              </h1>
              <p class="text-white text-lg mb-8 max-w-xl">
                  Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eligendi perspiciatis aut pariatur doloremque laborum quis in praesentium at, recusandae obcaecati dicta accusantium delectus asperiores illum minima veritatis iure quidem amet rerum fugit quaerat illo!
              </p>
              <a href="{{ route('login') }}" class="bg-teal-800 text-white px-8 py-3 rounded-md hover:bg-teal-700 transition-colors w-fit">
                  BERGABUNG
              </a>
          </div>
      
          <!-- Right floating buttons -->
          <div class="basis-2/5">
              @include('layout.button_floating')
          </div>
      </div>
      
    </main>
</body>
</html>
