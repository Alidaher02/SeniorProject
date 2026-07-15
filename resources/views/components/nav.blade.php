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
        <a class="btn btn-ghost text-xl font-bold text-gray-800 hover:bg-transparent">
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
            @else 
             <p class="text-xs text-gray-500">
                Driver
            </p> 
            @endif
            
        </div>


        <div class="flex h-9 w-9 items-center justify-center rounded-full bg-blue-100 text-sm font-bold text-blue-600">
            {{ strtoupper(substr(Auth::user()->name,0,1)) }}
        </div>


        <!-- Logout -->
        <form action="/logout" method="POST">
            @csrf
            @method('DELETE')

            <button type="submit"
                class="cursor-pointer rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-xs font-semibold text-red-600 transition hover:bg-red-600 hover:text-white">
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