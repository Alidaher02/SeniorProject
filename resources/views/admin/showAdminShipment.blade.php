
<x-layout>
@if ($shipment->status === App\Enums\ShipmentStatus::PENDING || $shipment->status === App\Enums\ShipmentStatus::APPROVED)
<div class="min-h-screen p-6">

    <!-- Main Card -->
    <a href="/admin/requests"
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
@endif

@if ($shipment->status === App\Enums\ShipmentStatus::DELIVERED)
<div class="min-h-screen p-6">

    <!-- Main Card -->
    <a href="/admin/shipments"
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
    <div class="mx-auto max-w-5xl rounded-2xl border border-green-100 bg-white shadow-sm">


        <!-- Header -->
        <div class="flex items-center justify-between rounded-t-2xl border-b border-green-100 bg-green-50 px-5 py-4">

            <div>
                <p class="text-xs font-medium text-green-600">
                    Shipment Details
                </p>

                <h1 class="text-lg font-bold text-gray-800">
                   {{ $shipment->{'tracking-number'} }}
                </h1>
            </div>


            <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-600">
                Arrived
            </span>

        </div>



        <!-- Content -->
        <div class="grid gap-4 p-5 md:grid-cols-2">



            <!-- Product -->
            <div class="rounded-2xl border border-green-100 bg-white p-4">

                <p class="text-xs font-medium text-gray-400">
                    Product Name
                </p>

                <h2 class="mt-1 text-sm font-semibold text-gray-800">
                    {{ $shipment->product_name }}
                </h2>

            </div>



            <!-- Tracking -->
            <div class="rounded-2xl border border-green-100 bg-white p-4">

                <p class="text-xs font-medium text-gray-400">
                    Tracking Number
                </p>

                <h2 class="mt-1 text-sm font-semibold text-green-600">
                    {{ $shipment->{'tracking-number'} }}
                </h2>

            </div>




            <!-- Delivery Status -->
            <div class="rounded-2xl border border-green-100 bg-green-50 p-4 md:col-span-2">

                <p class="text-xs font-medium text-green-600">
                    Delivery Status
                </p>

                <h2 class="mt-1 text-sm font-semibold text-gray-800">
                    Shipment successfully arrived
                </h2>

                <p class="mt-1 text-xs text-gray-500">
                    Delivered safely to the destination location.
                </p>

            </div>




            <!-- Temperature -->
            <div class="rounded-2xl border border-green-100 bg-white p-4">

                <p class="text-xs font-medium text-gray-400">
                    Temperature Range
                </p>


                <div class="mt-2 flex gap-2">

                    <span class="rounded-lg bg-green-50 px-3 py-1 text-xs font-semibold text-green-600">
                        Min {{ $shipment->min_temperature }}°C
                    </span>


                    <span class="rounded-lg bg-green-50 px-3 py-1 text-xs font-semibold text-green-600">
                        Max {{ $shipment->max_temperature }}°C
                    </span>

                </div>

            </div>





            <!-- Route -->
            <div class="rounded-2xl border border-green-100 bg-white p-4">

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



                    <div class="h-px w-10 bg-green-200"></div>



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
            <div class="rounded-2xl border border-green-100 bg-white p-4 md:col-span-2">


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
                            Arrival Date
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
@endif

@if ($shipment->status === App\Enums\ShipmentStatus::REJECTED)

<div class="min-h-screen p-6">

    <!-- Main Card -->
    <a href="/admin/shipments"
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
    <div class="mx-auto max-w-5xl rounded-2xl border border-red-100 bg-white shadow-sm">


        <!-- Header -->
        <div class="flex items-center justify-between rounded-t-2xl border-b border-red-100 bg-red-50 px-5 py-4">

            <div>
                <p class="text-xs font-medium text-red-500">
                    Shipment Details
                </p>

                <h1 class="text-lg font-bold text-gray-800">
                   {{ $shipment->{'tracking-number'} }}
                </h1>
            </div>
        

             <div class="flex items-center gap-2">
                <!-- Edit Button -->
                    

                <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-600">
                Rejected
            </span>

            </div>
           

                
            

   
        </div>



        <!-- Content -->
        <div class="grid gap-4 p-5 md:grid-cols-2">



            <!-- Product -->
            <div class="rounded-2xl border border-red-100 bg-white p-4">

                <p class="text-xs font-medium text-gray-400">
                    Product Name
                </p>

                <h2 class="mt-1 text-sm font-semibold text-gray-800">
                    {{ $shipment->product_name }}
                </h2>

            </div>





            <!-- Tracking -->
            <div class="rounded-2xl border border-red-100 bg-white p-4">

                <p class="text-xs font-medium text-gray-400">
                    Tracking Number
                </p>

                <h2 class="mt-1 text-sm font-semibold text-red-600">
                    {{ $shipment->{'tracking-number'} }}
                </h2>

            </div>





            <!-- Rejection Reason -->
            <div class="rounded-2xl border border-red-100 bg-red-50 p-4 md:col-span-2">


                <p class="text-xs font-medium text-red-600">
                    Rejection Reason
                </p>


                <h2 class="mt-1 text-sm font-semibold text-gray-800">
                    Please review your shipment details and submit a new request.
                </h2>


                <p class="mt-2 text-xs text-gray-500">
                    Shipment was rejected after reviewing the delivery conditions.
                </p>


            </div>





            <!-- Temperature -->
            <div class="rounded-2xl border border-red-100 bg-white p-4">

                <p class="text-xs font-medium text-gray-400">
                    Temperature Range
                </p>


                <div class="mt-2 flex gap-2">

                    <span class="rounded-lg bg-red-50 px-3 py-1 text-xs font-semibold text-red-600">
                        Min {{ $shipment->min_temperature }}°C
                    </span>


                    <span class="rounded-lg bg-red-50 px-3 py-1 text-xs font-semibold text-red-600">
                        Max {{ $shipment->max_temperature }}°C
                    </span>

                </div>


            </div>





            <!-- Route -->
            <div class="rounded-2xl border border-red-100 bg-white p-4">


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




                    <div class="h-px w-10 bg-red-200"></div>




                    <div>

                        <p class="text-xs text-gray-400">
                            Destination
                        </p>

                        <p class="text-sm font-semibold text-gray-800">
                            {{ $shipment->origin }}
                        </p>

                    </div>


                </div>


            </div>





            <!-- Dates -->
            <div class="rounded-2xl border border-red-100 bg-white p-4 md:col-span-2">


                <div class="grid gap-4 sm:grid-cols-2">



                    <div>

                        <p class="text-xs font-medium text-gray-400">
                            Request Date
                        </p>

                        <p class="mt-1 text-sm font-semibold text-gray-800">
                            {{ $shipment->departure_date }}
                        </p>

                    </div>





                    <div>

                        <p class="text-xs font-medium text-gray-400">
                            Rejected Date
                        </p>

                        <p class="mt-1 text-sm font-semibold text-gray-800">
                            {{ $shipment->updated_at }}
                        </p>

                    </div>



                </div>


            </div>



        </div>


    </div>


</div>

@endif

@if ($shipment->status === App\Enums\ShipmentStatus::IN_TRANSIT)

<div class="min-h-screen p-6">
<a href="/admin/shipments"
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
    <div class="mx-auto max-w-5xl rounded-2xl border border-blue-100 bg-white shadow-sm">


        <!-- Header -->
        <div class="flex items-center justify-between rounded-t-2xl border-b border-blue-100 bg-blue-50 px-5 py-4">

            <div>
                <p class="text-xs font-medium text-blue-500">
                    Live Shipment Tracking
                </p>

                <h1 class="text-lg font-bold text-gray-800">
                    #TRK-892734
                </h1>
            </div>


            <span class="rounded-full bg-purple-100 px-3 py-1 text-xs font-semibold text-purple-600">
                In Transit
            </span>

        </div>



        <div class="grid gap-4 p-5 md:grid-cols-2">


            <!-- Temperature -->
            <div class="rounded-2xl border border-blue-100 bg-white p-4">

                <p class="text-xs font-medium text-gray-400">
                    Current Temperature
                </p>


                <div class="mt-2 flex items-center justify-between">

                    <h2 class="text-2xl font-bold text-blue-600">
                        5°C
                    </h2>


                    <span class="rounded-lg bg-green-100 px-2 py-1 text-[11px] font-semibold text-green-600">
                        Normal
                    </span>

                </div>


                <p class="mt-2 text-xs text-gray-500">
                    Range: 2°C - 8°C
                </p>

            </div>




            <!-- Humidity -->
            <div class="rounded-2xl border border-blue-100 bg-white p-4">

                <p class="text-xs font-medium text-gray-400">
                    Humidity Level
                </p>


                <div class="mt-2 flex items-center justify-between">

                    <h2 class="text-2xl font-bold text-blue-600">
                        54%
                    </h2>


                    <span class="rounded-lg bg-green-100 px-2 py-1 text-[11px] font-semibold text-green-600">
                        Stable
                    </span>

                </div>


                <p class="mt-2 text-xs text-gray-500">
                    Last updated 2 minutes ago
                </p>

            </div>





            <!-- GPS Tracking -->
            <div class="rounded-2xl border border-blue-100 bg-blue-50 p-4 md:col-span-2">


                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-xs font-medium text-blue-500">
                            Current Location
                        </p>


                        <h2 class="mt-1 text-sm font-semibold text-gray-800">
                            Istanbul, Turkey
                        </h2>

                    </div>



                    <button class="rounded-lg bg-blue-600 px-3 py-1.5 text-xs font-semibold text-white hover:bg-blue-700">
                        View Map
                    </button>


                </div>



                <!-- Fake Map -->
                <div class="mt-4 flex h-32 items-center justify-center rounded-xl bg-blue-100">

                    <div class="text-center">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="mx-auto h-8 w-8 text-blue-600"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/>

                        </svg>


                        <p class="mt-1 text-xs text-blue-600">
                            GPS Tracking Active
                        </p>

                    </div>

                </div>


            </div>





            <!-- Shipment Progress -->
            <div class="rounded-2xl border border-blue-100 bg-white p-4 md:col-span-2">


                <p class="text-xs font-medium text-gray-400">
                    Shipment Progress
                </p>


                <div class="mt-4 flex items-center justify-between">


                    <div class="text-center">

                        <div class="mx-auto h-3 w-3 rounded-full bg-green-500"></div>

                        <p class="mt-2 text-xs">
                            Picked Up
                        </p>

                    </div>



                    <div class="h-px flex-1 bg-blue-200"></div>



                    <div class="text-center">

                        <div class="mx-auto h-3 w-3 rounded-full bg-blue-600"></div>

                        <p class="mt-2 text-xs">
                            In Transit
                        </p>

                    </div>




                    <div class="h-px flex-1 bg-gray-200"></div>




                    <div class="text-center">

                        <div class="mx-auto h-3 w-3 rounded-full bg-gray-300"></div>

                        <p class="mt-2 text-xs">
                            Delivered 
                        </p>

                    </div>


                </div>


            </div>



        </div>


    </div>

</div>

@endif



</x-layout>