<link rel="stylesheet"
      href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<div class="min-h-screen bg-slate-50 p-4 sm:p-6">

<div  data-shipment-id="{{ $shipment->id }}" class="mx-auto max-w-5xl overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <!-- Header -->
        <div class="border-b border-slate-200 bg-white px-5 py-4">

            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                <!-- Shipment Info -->
                <div>
                    <div class="flex items-center gap-2">

                        <span class="h-2 w-2 rounded-full bg-green-500"></span>

                        <p class="text-xs font-semibold text-green-600">
                            Live Tracking
                        </p>

                    </div>

                    <h1 class="mt-1 text-lg font-bold text-slate-800">
                        {{ $shipment->{'tracking-number'} }}
                    </h1>

                    <p class="mt-0.5 text-xs text-slate-400">
                        {{ $shipment->origin }} → {{ $shipment->destination }}
                    </p>
                </div>


                <!-- Header Actions -->
                <div class="flex items-center gap-2">

                    <!-- Sensors -->
                    @if ($shipment->sensorReadings->isNotEmpty()) 


                    <div id="sensor" class="inline-flex items-center gap-2 rounded-lg border border-green-100 bg-green-50 px-3 py-2">



                    </div>
                    @endif

                    <!-- Status -->
                    <span class="rounded-lg bg-purple-50 px-3 py-2 text-xs font-semibold capitalize text-purple-600">
                        {{ str_replace('_', ' ', $shipment->status->value) }}
                    </span>


                    <!-- PDF -->
                    <a href="/shipments/{{ $shipment->id }}/pdf"
                       class="group inline-flex items-center gap-2 rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-600 shadow-sm transition hover:border-blue-200 hover:bg-blue-50 hover:text-blue-600">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="h-4 w-4 transition group-hover:scale-110"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                             stroke-width="2">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M12 10v6m0 0l-3-3m3 3l3-3
                                     M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H9l-4 4v10a2 2 0 002 2z"/>

                        </svg>

                        PDF
                    </a>

                </div>

            </div>

        </div>


        <!-- Sensor Readings -->
        <div class="grid gap-3 p-5 sm:grid-cols-2">


            <!-- Temperature -->
            <div class="rounded-xl border border-slate-200 bg-white p-4 transition hover:border-blue-200">

                <div class="flex items-center justify-between">

                    <p class="text-xs font-semibold text-slate-400">
                        Temperature
                    </p>

                    <span id="tempMessage"
                          class="text-xs font-semibold text-green-500">
                        Normal
                    </span>

                </div>


                <div class="mt-3 flex items-baseline gap-1">

                    <h2 id="temperature"
                        class="text-3xl font-bold text-slate-800">
                        --
                    </h2>

                    <span class="text-sm text-slate-400">
                        °C
                    </span>

                </div>


                <p class="mt-1 text-[11px] text-slate-400">

                    Safe range:
                    {{ $shipment->min_temperature }}°C -
                    {{ $shipment->max_temperature }}°C

                </p>

            </div>



            <!-- Humidity -->
            <div class="rounded-xl border border-slate-200 bg-white p-4 transition hover:border-blue-200">

                <div class="flex items-center justify-between">

                    <p class="text-xs font-semibold text-slate-400">
                        Humidity
                    </p>

                    <span id="humidityMessage"
                          class="text-xs font-semibold text-green-500">
                        Normal
                    </span>

                </div>


                <div class="mt-3 flex items-baseline gap-1">

                    <h2 id="humidity"
                        class="text-3xl font-bold text-slate-800">
                        --
                    </h2>

                    <span class="text-sm text-slate-400">
                        %
                    </span>

                </div>


                <div class="mt-3 h-1.5 overflow-hidden rounded-full bg-slate-100">

                    <div id="humidityBar"
                         class="h-full w-0 rounded-full transition-all duration-500">
                    </div>

                </div>

            </div>



            <!-- Tilt -->
            <div class="rounded-xl border border-slate-200 bg-white p-4 transition hover:border-blue-200">

                <div class="flex items-center justify-between">

                    <p class="text-xs font-semibold text-slate-400">
                        Tilt
                    </p>

                    <span id="tiltMessage"
                          class="text-xs font-semibold text-green-500">
                        Stable
                    </span>

                </div>


                <div class="mt-3">

                    <h2 id="tilt"
                        class="text-2xl font-bold text-slate-800">
                        --
                    </h2>

                </div>


                <p class="mt-1 text-[11px] text-slate-400">
                    Device orientation
                </p>

            </div>



            <!-- Light -->
            <div class="rounded-xl border border-slate-200 bg-white p-4 transition hover:border-blue-200">

                <div class="flex items-center justify-between">

                    <p class="text-xs font-semibold text-slate-400">
                        Light
                    </p>

                    <span id="lightMessage"
                          class="text-xs font-semibold text-green-500">
                        Normal
                    </span>

                </div>


                <div class="mt-3 flex items-baseline gap-1">

                    <h2 id="light"
                        class="text-3xl font-bold text-slate-800">
                        --
                    </h2>

                    <span class="text-sm text-slate-400">
                        lux
                    </span>

                </div>


                <p class="mt-1 text-[11px] text-slate-400">
                    Current light level
                </p>

            </div>

        </div>



        <!-- GPS Tracking -->
        <div class="px-5 pb-5">

            <div class="overflow-hidden rounded-xl border border-slate-200 bg-white">

                <!-- Location Header -->
                <div class="flex items-center justify-between border-b border-slate-100 px-4 py-3">

                    <div>

                        <p class="text-xs font-semibold text-slate-400">
                            Current Location
                        </p>

                        <h2 id="location"
                            class="mt-1 text-sm font-semibold text-slate-800">
                        </h2>

                    </div>


                    <div class="flex items-center gap-2">

                        <span class="h-2 w-2 rounded-full bg-green-500"></span>

                        <span class="text-xs font-medium text-green-600">
                            GPS Active
                        </span>

                    </div>

                </div>


                <!-- Map -->
                <div id="map"
                     data-shipment-id="{{ $shipment->id }}"
                     class="relative flex h-48 items-center justify-center bg-slate-100">


                    <div id="locationBtn"
                         class="cursor-pointer text-center">

                        <div class="mx-auto flex h-10 w-10 items-center justify-center rounded-full bg-white shadow-sm">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="h-5 w-5 text-blue-600"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/>

                            </svg>

                        </div>

                        <p class="mt-2 text-xs font-medium text-slate-500">
                            GPS Tracking Active
                        </p>

                    </div>

                </div>

            </div>

        </div>



        <!-- Shipment Progress -->
        <div class="px-5 pb-5">

            <div class="rounded-xl border border-slate-200 bg-white p-4">

                <div class="flex items-center justify-between">

                    <p class="text-xs font-semibold text-slate-400">
                        Shipment Progress
                    </p>

                    <span class="text-[11px] text-slate-400">
                        In transit
                    </span>

                </div>


                <div class="mt-5 flex items-center">


                    <!-- Picked Up -->
                    <div class="flex flex-col items-center">

                        <div class="flex h-7 w-7 items-center justify-center rounded-full bg-green-100">

                            <div class="h-2.5 w-2.5 rounded-full bg-green-500"></div>

                        </div>

                        <p class="mt-2 text-[11px] font-medium text-slate-600">
                            Picked Up
                        </p>

                    </div>


                    <!-- Line -->
                    <div class="h-px flex-1 bg-green-200"></div>


                    <!-- In Transit -->
                    <div class="flex flex-col items-center">

                        <div class="flex h-7 w-7 items-center justify-center rounded-full bg-blue-100">

                            <div class="h-2.5 w-2.5 rounded-full bg-blue-600"></div>

                        </div>

                        <p class="mt-2 text-[11px] font-semibold text-blue-600">
                            In Transit
                        </p>

                    </div>


                    <!-- Line -->
                    <div class="h-px flex-1 bg-slate-200"></div>


                    <!-- Delivered -->
                    <div class="flex flex-col items-center">

                        <div class="flex h-7 w-7 items-center justify-center rounded-full bg-slate-100">

                            <div class="h-2.5 w-2.5 rounded-full bg-slate-300"></div>

                        </div>

                        <p class="mt-2 text-[11px] font-medium text-slate-400">
                            Delivered
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>