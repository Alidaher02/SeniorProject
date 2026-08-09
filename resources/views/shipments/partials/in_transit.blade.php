<link rel="stylesheet"
      href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
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


            <div class="flex items-center gap-3">


                <!-- PDF Report Button -->
                <a href="/shipments/{{$shipment->id}}/pdf"
                   class="group inline-flex items-center gap-2 
                          rounded-xl 
                          border border-blue-200
                          bg-white
                          px-4 py-2.5
                          text-sm font-semibold
                          text-blue-600
                          shadow-sm
                          transition-all
                          duration-200
                          hover:border-blue-400
                          hover:bg-blue-100
                          hover:shadow-md">


                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-5 w-5 transition group-hover:scale-110"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                         stroke-width="2">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M12 10v6m0 0l-3-3m3 3l3-3
                                 M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H9l-4 4v10a2 2 0 002 2z"/>

                    </svg>


                    PDF Report


                </a>



                <!-- Status -->
                <span class="rounded-full 
                             bg-purple-100
                             px-3 py-1
                             text-xs
                             font-semibold
                             text-purple-600">

                    {{ $shipment->status }}

                </span>


            </div>


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


                    <span id="tempMessage"></span>


                </div>


                <p class="mt-2 text-xs text-gray-500">
                    Range:
                    {{ $shipment->min_temperature }}°C -
                    {{ $shipment->max_temperature }}°C
                </p>


            </div>



            <!-- Humidity -->
            <div class="rounded-2xl border border-blue-100 bg-white p-4">


                <p class="text-xs font-medium text-gray-400">
                    Humidity Level
                </p>


                <div class="mt-2 flex items-center justify-between">


                    <h2 id="humidity"
                        class="text-2xl font-bold">

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


                        <h2 id="location" class="mt-1 text-sm font-semibold text-gray-800">
                           
                        </h2>

                    </div>


                </div>



                <div id="map" data-shipment-id="{{ $shipment->id }}" class="mt-4 flex h-32 items-center justify-center rounded-xl bg-blue-100">


                    <div id="locationBtn"
                         class="cursor-pointer text-center">


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
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

