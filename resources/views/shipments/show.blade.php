
<x-layout>
@if ($shipment->status === App\Enums\ShipmentStatus::PENDING || $shipment->status === App\Enums\ShipmentStatus::APPROVED)
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
       <form action="/shipments/{{ $shipment->id }}" method="POST">
        @csrf
        @method('DELETE')
         <button  type="submit"
        class="flex items-center gap-1.5 rounded-lg border border-red-200 bg-white px-3 py-1.5 text-xs font-semibold text-red-600 transition hover:bg-red-50">
         
        <svg xmlns="http://www.w3.org/2000/svg"
             class="h-3.5 w-3.5"
             fill="none"
             viewBox="0 0 24 24"
             stroke="currentColor">

            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-7 0h10"/>

        </svg>

        Cancel

    </button>
       </form>

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
@endif

@if ($shipment->status === App\Enums\ShipmentStatus::DELIVERED)
<div class="min-h-screen p-6">

    <!-- Main Card -->
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
                     <button
                    class="editBtn flex items-center gap-1.5 rounded-lg border border-blue-200 bg-white px-3 py-1.5 text-xs font-semibold text-blue-600 transition hover:bg-blue-50">

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
       <form action="/shipments/{{ $shipment->id }}" method="POST">
        @csrf
        @method('DELETE')
         <button  type="submit"
        class="flex items-center gap-1.5 rounded-lg border border-red-200 bg-white px-3 py-1.5 text-xs font-semibold text-red-600 transition hover:bg-red-50">
         
        <svg xmlns="http://www.w3.org/2000/svg"
             class="h-3.5 w-3.5"
             fill="none"
             viewBox="0 0 24 24"
             stroke="currentColor">

            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-7 0h10"/>

        </svg>

        Cancel

    </button>
</form>

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

    <div class="mx-auto max-w-5xl rounded-2xl border border-blue-100 bg-white shadow-sm">


        <!-- Header -->
        <div class="flex items-center justify-between rounded-t-2xl border-b border-blue-100 bg-blue-50 px-5 py-4">

            <div>
                <p class="text-xs font-medium text-blue-500">
                    Live Shipment Tracking
                </p>

                <h1 class="text-lg font-bold text-gray-800">
                    {{ $shipment->{'tracking-number'} }}
                </h1>
            </div>


            <span class="rounded-full bg-purple-100 px-3 py-1 text-xs font-semibold text-purple-600">
                {{ $shipment->Status }}
            </span>

        </div>



        <div class="grid gap-4 p-5 md:grid-cols-2">


            <!-- Temperature -->
            <div class="rounded-2xl border border-blue-100 bg-white p-4">

                <p class="text-xs font-medium text-gray-400">
                    Current Temperature
                </p>


                <div class="mt-2 flex items-center justify-between">
                    <h2 class="text-2xl font-bold" id="temperature">
                    
                    </h2>


                    {{-- @if ($sensorReading->temperature > $shipment->max_temperature + 10) --}}
                    <span id="tempMessage"  class="">
                    </span> 


                </div>


                <p class="mt-2 text-xs text-gray-500">
                    Range: {{ $shipment->min_temperature}}°C - {{ $shipment->max_temperature}}°C
                </p>


            </div>




            <!-- Humidity -->
            <div class="rounded-2xl border border-blue-100 bg-white p-4">

                <p class="text-xs font-medium text-gray-400">
                    Humidity Level
                </p>


                <div class="mt-2 flex items-center justify-between">

                    <h2 id="humidity" class="text-2xl font-bold

                    ">

                        --
                    </h2>

                    <span id="humidityMessage">
                    --
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


                </div>



                <!-- Fake Map -->
                <div class="mt-4 flex h-32 items-center justify-center rounded-xl bg-blue-100">

                    <div id="locationBtn" class="text-center cursor-pointer">

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


                        <p  class=" mt-1 text-xs text-blue-600">
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

<!-- Edit Modal -->
<div id="editModel" class="hidden">
 <div class="fixed inset-0 z-50 flex items-center justify-center">
<div class="w-full max-w-xl h-[700px] rounded-3xl border border-blue-100 bg-white shadow-xl overflow-scroll">

    <!-- Header -->
    <div class="flex items-center gap-3 bg-blue-50 px-6 py-4">
        <i class="fa-solid fa-pen-to-square text-xl text-blue-600"></i>

        <h2 class="text-lg font-bold text-blue-700">
            Edit Shipment
        </h2>
    </div>

    <form action="/shipments/{{ $shipment->id }}" method="POST">
    @csrf
    @method('PATCH')
    <div class="space-y-5 p-6">


        <!-- Shipment Name -->
        <div>
            <label class="mb-2 block text-sm font-semibold text-gray-700">
                Shipment Name
            </label>

          

            <textarea
            name="product_name"
    class="w-full rounded-xl border border-blue-100 bg-blue-50 px-4 py-3 text-sm text-gray-700 shadow-sm transition focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100 resize-none"
    rows="2">{{ $shipment->product_name }}</textarea>
            </div>


        <!-- Locations -->
        <div class="grid grid-cols-2 gap-5">

            <div>
                <label class="mb-2 block text-sm font-semibold text-gray-700">
                    Pickup Location
                </label>

                <textarea
                name="origin"
    class="w-full rounded-xl border border-blue-100 bg-blue-50 px-4 py-3 text-sm text-gray-700 shadow-sm transition focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100 resize-none"
    rows="2">{{ $shipment->origin }}</textarea>
            </div>


            <div>
                <label class="mb-2 block text-sm font-semibold text-gray-700">
                    Delivery Location
                </label>

                <textarea
                name="destination"
    class="w-full rounded-xl border border-blue-100 bg-blue-50 px-4 py-3 text-sm text-gray-700 shadow-sm transition focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100 resize-none"
    rows="2">{{ $shipment->destination }}</textarea>
            </div>

        </div>


        <!-- Dates -->
        <div class="grid grid-cols-2 gap-5">

            <div>
                <label class="mb-2 block text-sm font-semibold text-gray-700">
                    Departure Date
                </label>

            <input
                name="departure_date"
                type="datetime-local"
                value="{{ \Carbon\Carbon::parse($shipment->departure_date)->format('Y-m-d\TH:i') }}"
                class="w-full rounded-xl border border-blue-100 bg-blue-50 px-4 py-3 text-sm">
            </div>


            <div>
                <label class="mb-2 block text-sm font-semibold text-gray-700">
                    Expected Arrival
                </label>

               <input
              name="expected_arrival"
             type="datetime-local"
               value="{{ \Carbon\Carbon::parse($shipment->expected_arrival)->format('Y-m-d\TH:i') }}"
              class="w-full rounded-xl border border-blue-100 bg-blue-50 px-4 py-3 text-sm">
          </div>

        </div>


        <!-- Temperature -->
        <div class="grid grid-cols-2 gap-5">

            <div>
                <label class="mb-2 block text-sm font-semibold text-gray-700">
                    Min Temperature
                </label>

                <input
                    name="min_temperature"
                    type="number"
                    value="2"
                    class="w-full rounded-xl border border-blue-100 bg-blue-50 px-4 py-3 text-sm">
            </div>


            <div>
                <label class="mb-2 block text-sm font-semibold text-gray-700">
                    Max Temperature
                </label>

                <input
                    name="max_temperature"
                    type="number"
                    value="8"
                    class="w-full rounded-xl border border-blue-100 bg-blue-50 px-4 py-3 text-sm">
            </div>
            <div>

               <label class="mb-2 block text-sm font-semibold text-gray-700">
                    Min Humidity
                </label>

                <input
                    name="min_humidity"
                    type="number"
                    value="2"
                    class="w-full rounded-xl border border-blue-100 bg-blue-50 px-4 py-3 text-sm">
            </div>


            <div>
                <label class="mb-2 block text-sm font-semibold text-gray-700">
                    Max Humidity
                </label>

                <input
                    name="max_humidity"
                    type="number"
                    value="8"
                    class="w-full rounded-xl border border-blue-100 bg-blue-50 px-4 py-3 text-sm">
            </div>

        </div>


        <!-- Description -->
        <div>
            <label class="mb-2 block text-sm font-semibold text-gray-700">
                Description
            </label>

            <textarea
                name="description"
                rows="4"
                class="w-full rounded-xl border border-blue-100 bg-blue-50 px-4 py-3 text-sm focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100">{{ $shipment->description   }}</textarea>
        </div>


        <!-- Buttons -->
        <div class="flex justify-end gap-3 border-t border-blue-100">

            <button
            id="editClose"
                class="rounded-xl border border-gray-300 px-5 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-100">
                Cancel
            </button>


            <button
                class="rounded-xl bg-blue-600 px-6 py-2 text-sm font-semibold text-white hover:bg-blue-700">
                <i class="fa-solid fa-save mr-1"></i>
                Save Changes
            </button>

        </div>


    </div>

</div>
</form>
</div> 
</div>

<script>

   function loadReading() {
    const temperature = document.getElementById("temperature");
    const tempMessage = document.getElementById("tempMessage");
    const humidityMessage = document.getElementById("humidityMessage");

    fetch('/shipments/{{ $shipment->id }}/sensor-reading')
        .then(response => response.json())
        .then(data => {

            temperature.textContent =
                data.temperature ?? "--";
         if (data.temperature > {{ $shipment->max_temperature }} + 10) {

    temperature.style.setProperty("color", "#dc2626", "important"); // red-600

    tempMessage.innerHTML = `
        <span class="rounded-lg bg-red-100 px-2 py-1 text-[11px] font-semibold text-red-600">
            Warning: High Temperature
        </span>
    `;

} else if (data.temperature > {{ $shipment->max_temperature }}) {

    temperature.style.setProperty("color", "#dc2626", "important"); // red-600

    tempMessage.innerHTML = `
        <span class="rounded-lg bg-red-100 px-2 py-1 text-[11px] font-semibold text-red-600">
            High Temperature
        </span>
    `;

} else if (data.temperature < {{ $shipment->min_temperature }}) {

    temperature.style.setProperty("color", "#0891b2", "important"); // cyan-600

    tempMessage.innerHTML = `
        <span class="rounded-lg bg-cyan-100 px-2 py-1 text-[11px] font-semibold text-cyan-600">
            Low Temperature
        </span>
    `;

} else {

    temperature.style.setProperty("color", "#16a34a", "important"); // green-600

    tempMessage.innerHTML = `
        <span class="rounded-lg bg-green-100 px-2 py-1 text-[11px] font-semibold text-green-600">
            Normal
        </span>
    `;
}

            const humidity = document.getElementById("humidity");
            document.getElementById("humidity").textContent =
                data.humidity ?? "--";

humidity.textContent = data.humidity ?? "--";

if (data.humidity > {{ $shipment->max_humidity }} + 10) {

    humidity.style.setProperty("color", "#dc2626", "important"); // red-600

    humidityMessage.innerHTML = `
        <span class="rounded-lg bg-red-100 px-2 py-1 text-[11px] font-semibold text-red-600">
            Warning: High humidity
        </span>
    `;

} else if (data.humidity > {{ $shipment->max_humidity }}) {

    humidity.style.setProperty("color", "#dc2626", "important"); // red-600

    humidityMessage.innerHTML = `
        <span class="rounded-lg bg-red-100 px-2 py-1 text-[11px] font-semibold text-red-600">
            High humidity
        </span>
    `;

} else if (data.humidity < {{ $shipment->min_humidity }}) {

    humidity.style.setProperty("color", "#0891b2", "important"); // cyan-600

    humidityMessage.innerHTML = `
        <span class="rounded-lg bg-cyan-100 px-2 py-1 text-[11px] font-semibold text-cyan-600">
            Low humidity
        </span>
    `;

} else {

    humidity.style.setProperty("color", "#16a34a", "important"); // green-600

    humidityMessage.innerHTML = `
        <span class="rounded-lg bg-green-100 px-2 py-1 text-[11px] font-semibold text-green-600">
            Normal
        </span>
    `;
}


                

        });

}

loadReading();
setInterval(loadReading, 1000);

</script>


</x-layout>