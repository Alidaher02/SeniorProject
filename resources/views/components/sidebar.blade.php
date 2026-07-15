<aside class="fixed top-0 left-0 flex h-screen w-64 flex-col border-r border-slate-200 bg-white">

    <!-- Logo -->
    <div class="flex h-16 items-center border-b border-slate-200 px-6">
        <h1 class="text-xl font-bold text-slate-800">
            Cold<span class="text-blue-600"> Chain</span>
        </h1>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 overflow-y-auto px-4 py-6">

        <p class="mb-3 px-3 text-xs font-semibold uppercase tracking-widest text-slate-400">
            Main
        </p>

        <!-- Active -->
        <a href="/admin"
            @class([
        'mb-1 flex h-10 items-center gap-3 rounded-lg px-3 text-sm font-medium text-gray-600',
        'border-l-4  border-blue-600 bg-blue-50 px-3 text-sm font-medium text-blue-600' => request()->is('admin'),
        ])
            >

            <i class="fa-solid fa-chart-line w-5 text-center"></i>
            Dashboard
        </a>

        <a href="/admin/approved"
 @class([
        'mb-1 flex h-10 items-center gap-3 rounded-lg px-3 text-sm font-medium text-gray-600',
        'border-l-4  border-blue-600 bg-blue-50 px-3 text-sm font-medium text-blue-600' => request()->is('admin/approved'),
        ])
        >
            <i class="fa-solid fa-box w-5 text-center text-slate-400"></i>
            approved
        </a>

        <a href="/admin/requests"
         @class([
        'mb-1 flex h-10 items-center gap-3 rounded-lg px-3 text-sm font-medium text-gray-600',
        'border-l-4  border-blue-600 bg-blue-50 px-3 text-sm font-medium text-blue-600' => request()->is('admin/requests'),
        ])>
            <i class="fa-solid fa-clock-rotate-left w-5 text-center text-slate-400"></i>
            Shipment Requests
        </a>

        <a href="/admin/intransit"
        @class([
        'mb-1 flex h-10 items-center gap-3 rounded-lg px-3 text-sm font-medium text-gray-600',
        'border-l-4  border-blue-600 bg-blue-50 px-3 text-sm font-medium text-blue-600' => request()->is('admin/intransit'),
        ])
        >
            <i class="fa-solid fa-truck-fast w-5 text-center text-slate-400"></i>
            In Transit
        </a>

        <a href="/admin/delivered"
            @class([
        'mb-1 flex h-10 items-center gap-3 rounded-lg px-3 text-sm font-medium text-gray-600',
        'border-l-4  border-blue-600 bg-blue-50 px-3 text-sm font-medium text-blue-600' => request()->is('admin/delivered'),
        ])
        >
            <i class="fa-solid fa-circle-check w-5 text-center text-slate-400"></i>
            Delivered
        </a>

        <hr class="my-5">

        <p class="mb-3 px-3 text-xs font-semibold uppercase tracking-widest text-slate-400">
            Management
        </p>

        <a href="/admin/customers"
        @class([
        'mb-1 flex h-10 items-center gap-3 rounded-lg px-3 text-sm font-medium text-gray-600',
        'border-l-4  border-blue-600 bg-blue-50 px-3 text-sm font-medium text-blue-600' => request()->is('admin/customers'),
        ])
        >
            <i class="fa-solid fa-users w-5 text-center text-slate-400"></i>
            Customers
        </a>

        <a href="/admin/drivers"
        @class([
        'mb-1 flex h-10 items-center gap-3 rounded-lg px-3 text-sm font-medium text-gray-600',
        'border-l-4  border-blue-600 bg-blue-50 px-3 text-sm font-medium text-blue-600' => request()->is('admin/drivers'),
        ])
        >
            <i class="fa-solid fa-user-tie w-5 text-center text-slate-400"></i>
            Drivers
        </a>

        <a href="/admin/alerts"
        @class([
        'mb-1 flex h-10 items-center gap-3 rounded-lg px-3 text-sm font-medium text-gray-600',
        'border-l-4  border-blue-600 bg-blue-50 px-3 text-sm font-medium text-blue-600' => request()->is('admin/alerts'),
        ])>
            <i class="fa-solid fa-chart-column w-5 text-center text-slate-400"></i>
            Alerts
        </a>

        <a href="#"
            class="mb-1 flex h-10 items-center gap-3 rounded-lg px-3 text-sm font-medium text-slate-600 transition hover:bg-slate-100 hover:text-slate-900">
            <i class="fa-solid fa-gear w-5 text-center text-slate-400"></i>
            Settings
        </a>

    </nav>

    <!-- Bottom User -->
    <div class="border-t border-slate-200 p-4">

        <div class="mb-4 flex items-center gap-3">

            <div
                class="flex h-11 w-11 items-center justify-center rounded-full bg-blue-100 text-sm font-bold text-blue-600">
                A
            </div>

            <div>
                <h4 class="text-sm font-semibold text-slate-800">
                    Admin
                </h4>

                <p class="text-xs text-slate-500">
                    Administrator
                </p>
            </div>

        </div>

       <form action="/logout" method="POST">
       @csrf
       @method('DELETE')

       <button
            class="flex h-10 w-full items-center cursor-pointer justify-center gap-2 rounded-lg border border-slate-200 text-sm font-medium text-slate-600 transition hover:border-red-200 hover:bg-red-50 hover:text-red-600">

            <i class="fa-solid fa-right-from-bracket"></i>

            Logout

        </button>

       </form>

    </div>

</aside>
