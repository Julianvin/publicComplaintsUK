<div class="fixed bottom-8 right-8 flex flex-col gap-4">
    @auth
        {{-- Menu untuk GUEST --}}
        @if (auth()->user()->role === 'GUEST')
            <div class="group relative">
                <a href="{{ route('guest_page') }}"
                    class="w-14 h-14 bg-teal-600 rounded-full flex items-center justify-center hover:bg-teal-500 transition-all duration-300 ease-in-out shadow-lg hover:shadow-xl transform hover:scale-110">
                    <i class="fas fa-home text-white text-xl"></i>
                </a>
                <span
                    class="absolute right-full mr-3 top-1/2 -translate-y-1/2 bg-black text-white text-sm py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">Home</span>
            </div>

            <div class="group relative">
                <a href="{{ route('report_me') }}"
                    class="w-14 h-14 bg-teal-600 rounded-full flex items-center justify-center hover:bg-teal-500 transition-all duration-300 ease-in-out shadow-lg hover:shadow-xl transform hover:scale-110">
                    <i class="fas fa-exclamation-circle text-white text-xl"></i>
                </a>
                <span
                    class="absolute right-full mr-3 top-1/2 -translate-y-1/2 bg-black text-white text-sm py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">My
                    Reports</span>
            </div>

            <div class="group relative">
                <a href="{{ route('guest_create_report') }}"
                    class="w-14 h-14 bg-teal-600 rounded-full flex items-center justify-center hover:bg-teal-500 transition-all duration-300 ease-in-out shadow-lg hover:shadow-xl transform hover:scale-110">
                    <i class="fas fa-pen text-white text-xl"></i>
                </a>
                <span
                    class="absolute right-full mr-3 top-1/2 -translate-y-1/2 bg-black text-white text-sm py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">Create
                    Report</span>
            </div>
        @endif

        {{-- Menu untuk STAFF --}}
        @if (auth()->user()->role === 'STAFF')
            <div class="group relative">
                <a href="{{ route('staff_page') }}"
                    class="w-14 h-14 bg-blue-600 rounded-full flex items-center justify-center hover:bg-blue-500 transition-all duration-300 ease-in-out shadow-lg hover:shadow-xl transform hover:scale-110">
                    <i class="fas fa-tachometer-alt text-white text-xl"></i>
                </a>
                <span
                    class="absolute right-full mr-3 top-1/2 -translate-y-1/2 bg-black text-white text-sm py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">Dashboard</span>
            </div>

        @endif

        {{-- Menu untuk HEAD_STAFF --}}
        @if (auth()->user()->role === 'HEAD_STAFF')
            <div class="group relative">
                <a href="{{ route('headstaff_page') }}"
                    class="w-14 h-14 bg-purple-600 rounded-full flex items-center justify-center hover:bg-purple-500 transition-all duration-300 ease-in-out shadow-lg hover:shadow-xl transform hover:scale-110">
                    <i class="fas fa-chart-line text-white text-xl"></i>
                </a>
                <span
                    class="absolute right-full mr-3 top-1/2 -translate-y-1/2 bg-black text-white text-sm py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">Analytics</span>
            </div>

            <div class="group relative">
                <a href="{{ route('headstaff_create_acc') }}"
                    class="w-14 h-14 bg-purple-600 rounded-full flex items-center justify-center hover:bg-purple-500 transition-all duration-300 ease-in-out shadow-lg hover:shadow-xl transform hover:scale-110">
                    <i class="fas fa-clipboard-list text-white text-xl"></i>
                </a>
                <span
                    class="absolute right-full mr-3 top-1/2 -translate-y-1/2 bg-black text-white text-sm py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">Create
                    Account</span>
            </div>
        @endif

        {{-- Logout Menu (Visible for all roles) --}}
        <div class="group relative">
            <a href="{{ route('logout') }}"
                class="w-14 h-14 bg-red-600 rounded-full flex items-center justify-center hover:bg-red-500 transition-all duration-300 ease-in-out shadow-lg hover:shadow-xl transform hover:scale-110">
                <i class="fas fa-sign-out-alt text-white text-xl"></i>
            </a>
            <span
                class="absolute right-full mr-3 top-1/2 -translate-y-1/2 bg-black text-white text-sm py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">Logout</span>
        </div>
    @endauth

    @guest
        <div class="group relative">
            <a href="{{ route('landing_page') }}"
                class="w-14 h-14 bg-teal-600 rounded-full flex items-center justify-center hover:bg-teal-500 transition-all duration-300 ease-in-out shadow-lg hover:shadow-xl transform hover:scale-110">
                <i class="fas fa-home text-white text-xl"></i>
            </a>
            <span
                class="absolute right-full mr-3 top-1/2 -translate-y-1/2 bg-black text-white text-sm py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">Home</span>
        </div>

        <div class="group relative">
            <a href="{{ route('login') }}"
                class="w-14 h-14 bg-teal-600 rounded-full flex items-center justify-center hover:bg-teal-500 transition-all duration-300 ease-in-out shadow-lg hover:shadow-xl transform hover:scale-110">
                <i class="fas fa-user text-white text-xl"></i>
            </a>
            <span
                class="absolute right-full mr-3 top-1/2 -translate-y-1/2 bg-black text-white text-sm py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">Login</span>
        </div>
    @endguest
</div>
