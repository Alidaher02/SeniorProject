<x-layout>
<div class="min-h-screen bg-gray-50 p-6">

    <div class="mx-auto mt-5 max-w-7xl">

        <!-- Header -->
        <div class="mb-6 flex items-center justify-between">

            <div>
                <h1 class="text-xl font-bold text-gray-800">
                    Driver Dashboard
                </h1>

                <p class="text-sm text-gray-400">
                    Manage your assigned shipments and delivery progress.
                </p>
            </div>


            <div>
                <span class="rounded-full bg-green-100 px-4 py-2 text-xs font-semibold text-green-600">
                    ● Available
                </span>
            </div>

        </div>



        <!-- Stats -->
        <div class="mb-6 grid grid-cols-1 gap-4 md:grid-cols-3">


            <div class="rounded-2xl border border-blue-100 bg-white p-5 shadow-sm">

                <p class="text-xs text-gray-400">
                    Assigned Shipments
                </p>

                <h2 class="mt-2 text-2xl font-bold text-gray-800">
                    {{ $assignedShipments->count()  }}
                </h2>

            </div>



            <div class="rounded-2xl border border-blue-100 bg-white p-5 shadow-sm">

                <p class="text-xs text-gray-400">
                    In Transit
                </p>

                <h2 class="mt-2 text-2xl font-bold text-blue-600">
                    {{ $in_transitCount->count() }}
                </h2>

            </div>



            <div class="rounded-2xl border border-green-100 bg-white p-5 shadow-sm">

                <p class="text-xs text-gray-400">
                    Delivered
                </p>

                <h2 class="mt-2 text-2xl font-bold text-green-600">
                    {{ $deliveredCount->count() }}
                </h2>

            </div>


        </div>




        <!-- Shipments Table -->

        <div class="overflow-hidden rounded-2xl border border-blue-100 bg-white shadow-sm">

            


            <div class="border-b border-blue-100 bg-blue-50 px-5 py-4">


                <h2 class="text-sm font-bold text-gray-800">
                    Assigned Shipments
                </h2>

                <p class="text-xs text-gray-400">
                    Shipments assigned for delivery.
                </p>

            </div>




            <div class="overflow-x-auto p-5">

                <table class="w-full text-left">

                    <thead class="bg-blue-50">


                        <tr>

                            <th class="px-5 py-3 text-xs font-semibold text-blue-600">
                                Shipment
                            </th>

                            <th class="px-5 py-3 text-xs font-semibold text-blue-600">
                                Route
                            </th>

                            <th class="px-5 py-3 text-xs font-semibold text-blue-600">
                                Temperature
                            </th>

                            <th class="px-5 py-3 text-xs font-semibold text-blue-600">
                                Schedule
                            </th>

                            <th class="px-5 py-3 text-xs font-semibold text-blue-600">
                                Status
                            </th>

                            <th class="px-5 py-3 text-right text-xs font-semibold text-blue-600">
                                Action
                            </th>

                        </tr>



                    </thead>


                       <tbody class="divide-y  divide-blue-50">
                      
                    


                        <!-- Row 1 -->
                    @foreach ($assignedShipments as $assignedShipment)
                        <tr class="transition hover:bg-blue-50/50">


                            <td class="px-5 py-4">

                                <p class="text-sm font-semibold text-gray-800">
                                    {{ $assignedShipment->product_name }}
                                </p>

                                <p class="text-xs text-gray-400">
                                    {{ $assignedShipment->{'tracking-number'} }}
                                </p>

                            </td>



                            <td class="px-5 py-4">

                                <p class="text-sm text-gray-700">
                                    Beirut
                                </p>

                                <p class="text-xs text-gray-400">
                                    → Tripoli
                                </p>

                            </td>



                            <td class="px-5 py-4">

                                <span class="rounded-lg bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-600" >
                                    2°C - 8°C
                                </span>

                            </td>



                            <td class="px-5 py-4">

                                <p class="text-xs text-gray-700">
                                    15 Jul 2026
                                </p>

                                <p class="text-xs text-gray-400">
                                    Expected 17 Jul
                                </p>

                            </td>



                            <td class="px-5 py-4">

                                <span class="rounded-lg bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-600 ">
                                    {{ $assignedShipment->status }}
                                </span>

                            </td>



                            <td class="px-5 py-4">

                                <div class="flex justify-end gap-2">

                                    <button
                                        class="rounded-lg border border-blue-200 bg-blue-50 px-3 py-1.5 text-xs font-semibold text-blue-600 hover:bg-blue-100">
                                        View
                                    </button>

                                    @if ($assignedShipment->status === App\Enums\ShipmentStatus::IN_TRANSIT)
                                    <form action="/driver/{{ $assignedShipment->id }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                      <button
                                        type="submit"
                                        class="rounded-lg cursor-pointer bg-blue-600 px-3 py-1.5 text-xs font-semibold text-white hover:bg-blue-700">
                                        Update
                                    </button>  
                                    </form>               
                                    @endif
                                    

                                </div>

                            </td>


                        </tr>
                    @endforeach
                        



                    </tbody>


                </table>

            </div>


        </div>




        <!-- Driver Profile -->

        <div class="mt-6 rounded-2xl border border-blue-100 bg-white p-5 shadow-sm">


            <h2 class="text-sm font-bold text-gray-800">
                Driver Information
            </h2>


            <div class="mt-4 grid grid-cols-1 gap-5 md:grid-cols-3">


                <div>

                    <p class="text-xs text-gray-400">
                        Name
                    </p>

                    <p class="text-sm font-semibold text-gray-700">
                        {{ Auth::user()->name }}
                    </p>

                </div>



                <div>

                    <p class="text-xs text-gray-400">
                        Email
                    </p>

                    <p class="text-sm font-semibold text-gray-700">
                        {{ Auth::user()->email }}
                    </p>

                </div>



                <div>

                    <p class="text-xs text-gray-400">
                        Vehicle Status
                    </p>

                    <p class="text-sm font-semibold text-green-600">
                        Available
                    </p>

                </div>


            </div>


        </div>


    </div>

</div>

</x-layout>
