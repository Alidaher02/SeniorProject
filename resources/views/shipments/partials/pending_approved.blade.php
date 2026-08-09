<div class="min-h-screen p-6">

    <!-- Main Card -->
    @if (Auth::user()->role === 'admin')
          <a href="/admin"
   class="mb-3 px-20 inline-flex items-center gap-1 text-xs font-medium text-blue-600 transition hover:text-blue-800">

    <svg xmlns="http://www.w3.org/2000/svg"
         class="h-3.5 w-3.5"
         fill="none"
         viewBox="0 0 24 24"
         stroke="currentColor">

        <path stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M15 19l-7-7 7-7" />

    </svg>

    Back

</a>
    @else
          <a href="/"
   class="mb-3 px-20 inline-flex items-center gap-1 text-xs font-medium text-blue-600 transition hover:text-blue-800">

    <svg xmlns="http://www.w3.org/2000/svg"
         class="h-3.5 w-3.5"
         fill="none"
         viewBox="0 0 24 24"
         stroke="currentColor">

        <path stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M15 19l-7-7 7-7" />

    </svg>

    Home

</a>
    @endif
  
    <div class="mx-auto max-w-5xl rounded-2xl border border-blue-100 bg-white shadow-sm">
        <!-- Header -->
        <div class="flex items-center justify-between rounded-t-2xl  {{ $shipment->status === App\Enums\ShipmentStatus::APPROVED ? 'border-blue-100 bg-blue-50 border-b' : 'bg-yellow-50' }}  px-5 py-4">

            <div>
                <p class="text-xs font-medium text-blue-500">
                    Shipment Details
                </p>

                <h1 class="text-lg font-bold text-gray-800">
                    {{ $shipment->{'tracking-number'} }}
                </h1>
            </div>


            <div class="flex items-center gap-2">

                <!-- Edit Button -->
                @if ($shipment->status === App\Enums\ShipmentStatus::PENDING)
                     <button 
                    class="flex cursor-pointer editBtn items-center gap-1.5 rounded-lg border border-blue-200 bg-white px-3 py-1.5 text-xs font-semibold text-blue-600 transition hover:bg-blue-50">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-3.5 w-3.5"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.5-8.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 7.5-7.5z" />

                    </svg>

                    Edit

                </button>

                 <!-- Delete Button -->
<button type="button"
                    onclick="showCancelModal()"
                    class="flex items-center gap-1.5 rounded-lg border border-red-200 bg-white px-3 py-1.5 text-xs font-semibold text-red-600 transition hover:bg-red-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-7 0h10"/>
                    </svg>
                    Cancel
                </button>
                <div id="cancelModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 backdrop-blur-sm p-4">
    <div class="w-full max-w-sm rounded-2xl bg-white p-6 shadow-xl text-center">
        
        <div class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-red-100 text-red-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
        </div>

        <h3 class="text-base font-bold text-slate-900">Are you sure?</h3>
        <p class="mt-1 text-xs text-slate-500">This action cannot be undone. Do you really want to cancel this shipment?</p>

        <div class="mt-6 flex justify-center gap-3">
            <button type="button" onclick="closeCancelModal()" class="rounded-lg border border-slate-200 px-4 py-2 text-xs font-semibold text-slate-600 hover:bg-slate-50">
                Nevermind
            </button>

            <!-- Actual Form Submission -->
            <form action="/shipments/{{ $shipment->id }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="rounded-lg cursor-pointer bg-red-600 px-4 py-2 text-xs font-semibold text-white hover:bg-red-700">
                    Yes, Cancel
                </button>
            </form>
        </div>

    </div>
</div>


                @endif
               

                <!-- Status -->
                 <span 
                @class([
                    'rounded-md px-2 py-0.5 text-[11px] font-semibold',
                    'bg-blue-100 text-blue-600' => $shipment->status->value === 'approved',
                    'bg-yellow-100 text-yellow-600' => $shipment->status->value === 'pending',
                    'bg-green-100 text-green-600' => $shipment->status->value === 'in_transit',
                    'bg-green-100 text-green-500' => $shipment->status->value === 'delivered',
                    'bg-red-100 text-red-600' => $shipment->status->value === 'rejected',
                     ])
                     >

            {{ $shipment->status }}
        </span>

        

            </div>

        </div>



        <!-- Content -->
        <div class="grid gap-4 p-5 md:grid-cols-2">


            <!-- Product -->
            <div class="rounded-2xl border border-blue-100 bg-white p-4">

                <p class="text-xs font-medium text-gray-400">
                    Product Name
                </p>

                <h2 class="mt-1 text-sm font-semibold text-gray-800">
                    {{ $shipment->product_name }}
                </h2>

            </div>



            <!-- Tracking -->
            <div class="rounded-2xl border border-blue-100 bg-white p-4">

                <p class="text-xs font-medium text-gray-400">
                    Tracking Number
                </p>

                <h2 class="mt-1 text-sm font-semibold {{ $shipment->status === App\Enums\ShipmentStatus::APPROVED ? 'text-blue-600' : 'text-yellow-500' }} ">
                    {{ $shipment->{'tracking-number'} }}

                </h2>

            </div>



            <!-- Description -->
            <div class="rounded-2xl border border-blue-100 bg-white p-4 md:col-span-2">

                <p class="text-xs font-medium text-gray-400">
                    Description
                </p>

                <p class="mt-2 text-sm leading-6 text-gray-600">
                    {{ $shipment->description }}
                </p>

            </div>



            <!-- Temperature -->
            <div class="rounded-2xl border border-blue-100 bg-white p-4">

                <p class="text-xs font-medium text-gray-400">
                    Temperature Range
                </p>

                <div class="mt-2 flex items-center gap-2">

                    <span class="rounded-lg px-3 py-1 text-xs font-semibold {{ $shipment->status === App\Enums\ShipmentStatus::APPROVED ? 'text-blue-600 bg-blue-50 ' : 'text-yellow-500 bg-yellow-50' }}">
                       Min {{ $shipment->min_temperature }} °C
                    </span>

                    <span class="rounded-lg bg-blue-50 px-3 py-1 text-xs font-semibold {{ $shipment->status === App\Enums\ShipmentStatus::APPROVED ? 'text-blue-600' : 'text-yellow-500 bg-yellow-50' }} ">
                       Max {{ $shipment->max_temperature }} °C
                    </span>

                </div>

            </div>



            <!-- Route -->
            <div class="rounded-2xl border border-blue-100 bg-white p-4">

                <p class="text-xs font-medium text-gray-400">
                    Route
                </p>


                <div class="mt-2 flex items-center justify-between">


                    <div>
                        <p class="text-xs text-gray-400">
                            Origin
                        </p>

                        <p class="text-sm font-semibold text-gray-800">
                            {{ $shipment->origin }}
                        </p>
                    </div>



                    <div class="h-px w-10 bg-blue-200"></div>



                    <div>
                        <p class="text-xs text-gray-400">
                            Destination
                        </p>

                        <p class="text-sm font-semibold text-gray-800">
                            {{ $shipment->destination }}
                        </p>
                    </div>


                </div>

            </div>



            <!-- Dates -->
            <div class="rounded-2xl border border-blue-100 bg-white p-4 md:col-span-2">


                <div class="grid gap-4 sm:grid-cols-2">


                    <div>

                        <p class="text-xs font-medium text-gray-400">
                            Departure Date
                        </p>

                        <p class="mt-1 text-sm font-semibold text-gray-800">
                            {{ $shipment->departure_date }}
                        </p>

                    </div>



                    <div>

                        <p class="text-xs font-medium text-gray-400">
                            Expected Arrival
                        </p>

                        <p class="mt-1 text-sm font-semibold text-gray-800">
                            {{ $shipment->expected_arrival }}
                        </p>

                    </div>


                </div>


            </div>


        </div>

    </div>

</div>

