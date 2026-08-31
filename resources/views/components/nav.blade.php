<div class="navbar bg-white border-b border-gray-200 shadow-sm px-6">

    <!-- Left -->
    <div class="navbar-start">

        <!-- Mobile menu -->
        <div class="dropdown">
            <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 text-gray-600"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </div>

            <ul tabindex="-1"
                class="menu menu-sm dropdown-content mt-3 z-[1] w-52 rounded-xl bg-white p-3 shadow-lg border border-gray-100">
                <li>
                    <a href="/shipments" class="rounded-lg hover:bg-blue-50 hover:text-blue-600">
                        Shipments
                    </a>
                </li>
                <li>
                    <a href="/shipments/request" class="rounded-lg hover:bg-blue-50 hover:text-blue-600">
                        Request Shipment
                    </a>
                </li>

                 <li>
                    <a href="/admin" class="rounded-lg hover:bg-blue-50 hover:text-blue-600">
                        admin
                    </a>
                </li>
            </ul>
        </div>


        <!-- Logo -->
        <a class="text-xl font-bold text-gray-800 hover:bg-transparent">
            <span class="text-blue-600">Cold</span>Chain
        </a>

    </div>


    @auth
        
    <!-- Center -->
    <div class="navbar-center hidden lg:flex">

        <ul class="menu menu-horizontal gap-2 px-1">
            @if(Auth::user()->role === 'customer')
            <li>
                <a href="/shipments"
                    class=" cursor-pointer rounded-lg text-sm font-medium text-gray-600 hover:bg-blue-50 hover:text-blue-600">
                    My Shipments
                </a>
            </li>

            <li>
                <a href="/shipments/request"
                    class="cursor-pointer rounded-lg text-sm font-medium text-gray-600 hover:bg-blue-50 hover:text-blue-600">
                    Request Shipment
                </a>
            </li>
            <li>
                    <a href="/ai-assistant" class="cursor-pointer rounded-lg text-sm font-medium text-gray-600 hover:bg-blue-50 hover:text-blue-600">
                        Ai Assistant
                    </a>
            </li>
            <li>
                    <a href="/shipments/settings" class="cursor-pointer rounded-lg text-sm font-medium text-gray-600 hover:bg-blue-50 hover:text-blue-600">
                        Settings
                    </a>
            </li>
            @endif


            @if(Auth::user()->role === 'admin')
            <li>
                <a href="/admin"
                    class="cursor-pointer rounded-lg text-sm font-medium text-gray-600 hover:bg-blue-50 hover:text-blue-600">
                    Admin Dashborad
                </a>
            </li>
            @endif


        </ul>

    </div>

    @endauth




@auth
<!-- Right -->
<div class="navbar-end flex items-center gap-4">

    <!-- User -->
    <div class="hidden sm:block text-right">
        <p class="text-sm font-semibold text-gray-800">
            {{ Auth::user()->name }}
        </p>

        @if (Auth::user()->role === 'customer')
            <p class="text-xs text-gray-500">
                Customer
            </p>
        @elseif(Auth::user()->role === 'driver')
            <p class="text-xs text-gray-500">
                Driver
            </p>
        @else
            <p class="text-xs text-gray-500">
                Admin
            </p>
        @endif
    </div>


    <!-- Profile Image -->
    @if(Auth::user()->image)

        <img
            src="{{ asset('storage/' . auth()->user()->image) }}"
            alt="Profile"
            class="h-9 w-9 rounded-full object-cover"
        >

    @else

        <div class="flex h-9 w-9 items-center justify-center rounded-full bg-blue-100 text-sm font-bold text-blue-600">
            {{ strtoupper(substr(Auth::user()->name,0,1)) }}
        </div>

    @endif

    <!-- Notifications -->
    <div  class="dropdown dropdown-end">

        <!-- Bell Button -->
        <button
        
            tabindex="0"
            type="button"
            class="relative flex h-9 w-9 items-center justify-center rounded-full
                   text-gray-500 transition hover:bg-gray-100 hover:text-blue-600
                   cursor-pointer"
        >

            <!-- Bell SVG -->
            <svg
            
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.8"
                stroke="currentColor"
                class="h-5 w-5"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9a6 6 0 0 0-12 0v.75a8.967 8.967 0 0 1-2.31 6.022c1.73.64 3.546 1.108 5.454 1.31m5.713 0a24.255 24.255 0 0 1-5.713 0m5.713 0a3 3 0 1 1-5.713 0"
                />
            </svg>


            <!-- Notification Count -->
            <span id="unreadNotificationsCount"
                class="absolute -right-0.5 -top-0.5 flex h-4 min-w-4
                       items-center justify-center rounded-full bg-red-500
                       px-1 text-[9px] font-bold text-white ring-2 ring-white"
            >
              0
            </span>

        </button>
            
        <!-- Notification Dropdown -->
        <ul
            tabindex="0"
            class="menu dropdown-content z-[50] mt-3 w-80
                   overflow-hidden rounded-2xl border border-gray-100
                   bg-white p-0 shadow-xl"
        >
            <!-- Header -->
            <li class="pointer-events-none">

                <div class="flex items-center justify-between border-b border-gray-100 px-4 py-3">

                    <div>
                        <p class="text-sm font-bold text-gray-800">
                            Notifications
                        </p>

                        <p class="text-xs text-gray-400">
                            {{ auth()->user()->notifications->count() }}  notifications
                        </p>
                    </div>

                    <span
                        class="rounded-full bg-blue-50 px-2 py-1 text-[10px]
                               font-semibold text-blue-600"
                    >
                        NEW
                    </span>

                </div>

            </li>

        @forelse(auth()->user()->unreadnotifications()->latest()->limit(5)->get() as $notification)

            <!-- Notification 1 -->
            <div id="unreadnotificationsContainer">
            
            </div>
            @empty
                <li class="px-4 py-8 text-center">
                    <div class="flex flex-col items-center justify-center">

                        <div class="flex h-9 w-9 items-center justify-center rounded-full bg-gray-50 text-gray-400">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.7"
                                stroke="currentColor"
                                class="h-4 w-4"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9a6 6 0 1 0-12 0v.75a8.967 8.967 0 0 1-2.31 6.022c1.733.64 3.56 1.082 5.454 1.31m5.713 0a24.255 24.255 0 0 1-5.713 0m5.713 0a3 3 0 1 1-5.713 0"
                                />
                            </svg>
                        </div>

                        <p class="mt-2 text-[11px] font-medium text-gray-700">
                            No notifications
                        </p>

                        <p class="mt-0.5 text-[10px] text-gray-400">
                            You're all caught up.
                        </p>

                    </div>
                </li>

            @endforelse


            <!-- Footer -->
            <li class="border-t border-gray-100">

                <a
                    href="/notifications"
                    class="justify-center py-3 text-xs font-semibold
                           text-blue-600 hover:bg-blue-50"
                >
                    View all notifications
                </a>

            </li>

        </ul>
    </div>

    <!-- Logout -->
    <form action="/logout" method="POST">

        @csrf
        @method('DELETE')

        <button
            type="submit"
            class="cursor-pointer rounded-lg border border-red-200
                   bg-red-50 px-3 py-2 text-xs font-semibold text-red-600
                   transition hover:bg-red-600 hover:text-white"
        >
            Logout
        </button>

    </form>

</div>

@endauth



    @guest
    <div class="navbar-end flex items-center gap-3">

        <a href="/login"
            class="text-sm font-medium text-gray-600 hover:text-blue-600 cursor-pointer">
            Sign In
        </a>

        <a href="/register"
            class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-blue-700 cursor-pointer">
            Sign Up
        </a>

    </div>
    @endguest


</div>