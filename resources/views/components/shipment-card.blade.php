@props([
    'status',
    'shipmentId',
    'title',
    'origin',
    'destination',
    'temperature',
    'humidity',
    'lastUpdated',
    'date',
    'detailsUrl',
])

@php
    // Icon circle + icon color follow the same status mapping as the badge.
    $iconWrapClasses = match ($status) {
        'approved' => 'bg-blue-50',
        'pending' => 'bg-yellow-50',
        'in_transit' => 'bg-green-50',
        'delivered' => 'bg-green-50',
        'alert' => 'bg-red-50',
        default => 'bg-blue-50',
    };

    $iconColorClasses = match ($status) {
        'approved' => 'text-blue-600',
        'pending' => 'text-yellow-600',
        'in_transit' => 'text-green-600',
        'delivered' => 'text-green-500',
        'alert' => 'text-red-600',
        default => 'text-blue-600',
    };
@endphp

<div class="w-full max-w-xs rounded-xl border border-gray-200 bg-white p-3.5 shadow-md">

    <!-- Header -->
    <div class="flex items-start justify-between">
        
        <span 
        @class([
        'rounded-md px-2 py-0.5 text-[11px] font-semibold',
        'bg-blue-100 text-blue-600' => $status === 'approved',
        'bg-yellow-100 text-yellow-600' => $status === 'pending',
        'bg-green-100 text-green-600' => $status === 'in_transit',
        'bg-green-100 text-green-500' => $status === 'delivered',
        'bg-red-100 text-red-600' => $status === 'rejected',
              ])
        
        >
            {{ $status }}
        </span>

        <button class="text-gray-500 hover:text-gray-700">
            ⋮
        </button>
    </div>

    <!-- Shipment -->
    <div class="mt-3 flex gap-3">
        <div class="flex h-14 w-14 items-center justify-center rounded-full {{ $iconWrapClasses }}">
            <svg xmlns="http://www.w3.org/2000/svg"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke-width="1.5"
                 stroke="currentColor"
                 class="h-7 w-7 {{ $iconColorClasses }}">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21 8.25 12 3 3 8.25m18 0V15.75L12 21m9-12.75L12 13.5M3 8.25V15.75L12 21m-9-12.75L12 13.5m0 7.5V13.5" />
            </svg>
        </div>

        <div>
            <h2 class="text-xl font-bold">{{ $shipmentId }}</h2>
            <p class="text-xs text-gray-500">{{ $title }}</p>
        </div>
    </div>

    <!-- Route -->
    <div class="mt-3 text-sm font-medium text-gray-700">
        {{ $origin }}
        <span class="mx-2">→</span>
        {{ $destination }}
    </div>

    <hr class="my-3">

    <!-- Stats -->
    <div class="grid grid-cols-3 gap-2">

        <div>
            <p class="text-[11px] text-gray-500">Temperature</p>
            <p class="mt-1 text-base font-bold text-blue-600">2.4°C</p>
        </div>

        <div>
            <p class="text-[11px] text-gray-500">Humidity</p>
            <p class="mt-1 text-base font-bold">45%</p>
        </div>

        <div>
            <p class="text-[11px] text-gray-500">Last Updated</p>
            <p class="mt-1 text-xs font-semibold">10 min ago</p>
        </div>

    </div>

    <hr class="my-3">

    <!-- Footer -->
    <div class="flex items-center justify-between">
        <span class="text-xs text-gray-500">📅 May 20, 2025</span>

        <a
            href="{{ $detailsUrl }}"
            class="rounded-lg border-2 border-blue-500 px-3 py-1 text-xs font-semibold text-blue-600 transition hover:bg-blue-600 hover:text-white">
            View Details
        </a>
    </div>

</div>