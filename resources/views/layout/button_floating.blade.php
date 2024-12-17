<div class="fixed bottom-8 right-8 flex flex-col gap-4">
    @auth
        {{-- Menu untuk GUEST --}}
        @if (auth()->user()->role === 'GUEST')
            <a href="{{ route('guest_page') }}"
                class="w-12 h-12 bg-teal-800 rounded-full flex items-center justify-center hover:bg-teal-700 transition-colors">
                <i class="fas fa-home text-white"></i>
            </a>

            <a href="{{ route('report_me') }}"
                class="w-12 h-12 bg-teal-800 rounded-full flex items-center justify-center hover:bg-teal-700 transition-colors">
                <i class="fas fa-exclamation-circle text-white"></i>
            </a>

            <a href="{{ route('guest_create_report') }}"
                class="w-12 h-12 bg-teal-800 rounded-full flex items-center justify-center hover:bg-teal-700 transition-colors">
                <i class="fas fa-pen text-white"></i>
            </a>
        @endif

        {{-- Menu untuk STAFF --}}
        @if (auth()->user()->role === 'STAFF')
            <a href="{{ route('staff_page') }}"
                class="w-12 h-12 bg-blue-800 rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                <i class="fas fa-tachometer-alt text-white"></i>
            </a>

            <a href=""
                class="w-12 h-12 bg-blue-800 rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                <i class="fas fa-file-alt text-white"></i>
            </a>
        @endif

        {{-- Menu untuk HEAD_STAFF --}}
        @if (auth()->user()->role === 'HEAD_STAFF')
            <a href="{{ route('headstaff_page') }}"
                class="w-12 h-12 bg-purple-800 rounded-full flex items-center justify-center hover:bg-purple-700 transition-colors">
                <i class="fas fa-chart-line text-white"></i>
            </a>

            <a href="{{ route('headstaff_create_acc') }}"
                class="w-12 h-12 bg-purple-800 rounded-full flex items-center justify-center hover:bg-purple-700 transition-colors">
                <i class="fas fa-clipboard-list text-white"></i>
            </a>
        @endif

        {{-- Logout Menu (Visible for all roles) --}}
        <a href="{{ route('logout') }}"
            class="w-12 h-12 bg-red-800 rounded-full flex items-center justify-center hover:bg-red-700 transition-colors">
            <i class="fas fa-sign-out-alt text-white"></i>
        </a>
    @endauth


    @guest
        <a href="{{ route('landing_page') }}"
            class="w-12 h-12 bg-teal-800 rounded-full flex items-center justify-center hover:bg-teal-700 transition-colors">
            <i class="fas fa-home text-white"></i>
        </a>

        <a href="{{ route('login') }}"
            class="w-12 h-12 bg-teal-800 rounded-full flex items-center justify-center hover:bg-teal-700 transition-colors">
            <i class="fas fa-user text-white"></i>
        </a>
    @endguest
</div>
