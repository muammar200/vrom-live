<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Libraries -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.7.0/dist/cdn.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

    <!-- Scripts -->
    @vite(['resources/css/front.css'])

    <!-- Styles -->
    @livewireStyles
</head>

<body>
    <main>
        <nav class="container relative my-4 lg:my-10">
            <div class="flex flex-col justify-between w-full lg:flex-row lg:items-center">
                <!-- Logo & Toggler Button here -->
                <div class="flex items-center justify-between">
                    <!-- LOGO -->
                    <a href="{{ route('front.index') }}">
                        <h1 class="text-4xl font-bold">IDNMobil</h1>
                    </a>
                    <!-- RESPONSIVE NAVBAR BUTTON TOGGLER -->
                    <div class="block lg:hidden">
                        <button class="p-1 outline-none mobileMenuButton" id="navbarToggler" data-target="#navigation">
                            <svg class="text-dark w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 8h16M4 16h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Nav Menu -->
                <div class="hidden w-full lg:block" id="navigation">
                    <div
                        class="flex flex-col items-baseline gap-4 mt-6 lg:justify-between lg:flex-row lg:items-center lg:mt-0">
                        <div
                            class="flex flex-col w-full ml-auto lg:w-auto gap-4 lg:gap-[50px] lg:items-center lg:flex-row">
                            <a href="{{ route('front.index') }}"
                                class="nav-link-item {{ request()->routeIs('front.index') ? 'active' : '' }}">Landing</a>
                            <a href="{{ route('front.catalog') }}"
                                class="nav-link-item {{ request()->routeIs('front.catalog') ? 'active' : '' }}">Catalog</a>
                            <a href="#!" class="nav-link-item">Benefits</a>
                            <a href="#!" class="nav-link-item">Stories</a>
                            <a href="#!" class="nav-link-item">Maps</a>
                        </div>
                        @if (request()->routeIs('front.index') || request()->routeIs('front.catalog') || request()->routeIs('front.detail') || request()->routeIs('front.checkout'))
                            @auth
                                <div
                                    class="relative flex flex-col w-full ml-auto lg:w-auto lg:gap-12 lg:items-center lg:flex-row">
                                    
                                    <!-- AUTH USER -->
                                    <a href="javascript:void(0);"
                                        class="flex flex-row-reverse lg:flex-row items-center justify-end lg:justify-start gap-[10px]"
                                        onclick="toggleDropdown(this)">
                                        <p class="text-base font-semibold text-dark">
                                            Hello <br> {{ $user->name }}
                                        </p>
                                        {{-- <span class="p-1 rounded-full w-[55px] border-2 border-secondary">
                                            <img src="{{ Storage::url($user->photo) }}" class="w-full" alt="">
                                        </span> --}}
                                        {{-- <span class="p-1 border-2 rounded-full w-[55px] h-[65px] border-secondary user-profile-picture">
                                          <img src="{{ Storage::url($user->photo) }}" class="w-full" alt="">
                                        </span> --}}
                                        <span class="p-1 border-2 rounded-full w-[60px] h-[60px] border-secondary flex items-center justify-center">
                                          <img src="{{ Storage::url($user->photo) }}" class="object-cover w-full h-full rounded-full" alt="">
                                      </span>
                                      
                                      
                                    </a>
                                    <!-- Dropdown menu -->
                                    <div class="absolute bottom-0 lg:right-0 translate-y-[107%] z-50 w-max hidden"
                                        id="userDropdownMenu">
                                        <div class="border border-secondary rounded-[22px] bg-white p-[26px]">
                                            <div class="flex flex-col gap-4">
                                                <a href="#!"
                                                    class="text-base font-medium transition-all text-dark hover:underline underline-offset-2 decoration-1">
                                                    My Transactions
                                                </a>
                                                <a href="#!"
                                                    class="text-base font-medium transition-all text-dark hover:underline underline-offset-2 decoration-1">
                                                    Rewards
                                                </a>
                                                <a href="#!"
                                                    class="text-base font-medium transition-all text-dark hover:underline underline-offset-2 decoration-1">
                                                    Add Benefit
                                                </a>
                                                <a href="#!"
                                                    class="text-base font-medium transition-all text-dark hover:underline underline-offset-2 decoration-1">
                                                    Payments
                                                </a>
                                                <div class="hidden">
                                                    <form method="POST" action="{{ route('logout') }}" id="logoutForm">
                                                        @csrf
                                                    </form>
                                                </div>
                                                <a href="#!" id="logoutButton"
                                                    class="text-base font-medium transition-all text-dark hover:underline underline-offset-2 decoration-1">
                                                    Logout
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="flex flex-col w-full ml-auto lg:w-auto lg:gap-12 lg:items-center lg:flex-row">
                                    <a href="{{ route('login') }}" class="btn-secondary">
                                        Log In
                                    </a>
                                </div>
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        {{ $slot }}
    </main>


    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
            duration: 300,
            easing: 'ease-out'
        });
    </script>

    <script src="{{ url('js/script.js') }}"></script>


    <script>
        // on signup click, submit the form
        $('#logoutButton').click(function() {
            $('#logoutForm').submit();
        });
    </script>

</body>

</html>
