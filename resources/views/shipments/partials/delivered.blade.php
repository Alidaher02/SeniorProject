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