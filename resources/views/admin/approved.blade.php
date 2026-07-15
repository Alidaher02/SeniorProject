<x-admin-layout>

<div class="min-h-screen p-6">

    <div class="mx-auto mt-5 max-w-7xl overflow-hidden rounded-2xl border border-blue-100 bg-white shadow-sm">

        <!-- Header -->
        <div class="flex items-center justify-between border-b border-blue-100 bg-blue-50 px-5 py-4">

            <div>
                <h1 class="text-lg font-bold text-gray-800">
                    Approved Shipments
                </h1>

                <p class="text-xs text-gray-400">
                    Manage approved shipments and assign drivers for delivery.
                </p>
            </div>

        </div>


        <!-- Table -->
        <div class="p-5">

            <div class="overflow-hidden rounded-xl border border-blue-100">

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


                    <tbody class="divide-y divide-blue-50">

                        @forelse($shipments as $shipment)

                        <tr class="transition hover:bg-blue-50/50">


                            <!-- Shipment -->
                            <td class="px-5 py-4">

                                <div>

                                    <p class="text-sm font-semibold text-gray-800">
                                        {{ $shipment->product_name }}
                                    </p>

                                    <p class="text-xs text-gray-400">
                                        {{ $shipment->tracking_number }}
                                    </p>

                                </div>

                            </td>


                            <!-- Route -->
                            <td class="px-5 py-4">

                                <p class="text-sm text-gray-700">
                                    {{ $shipment->origin }}
                                </p>

                                <p class="text-xs text-gray-400">
                                    → {{ $shipment->destination }}
                                </p>

                            </td>


                            <!-- Temperature -->
                            <td class="px-5 py-4">

                                <span class="rounded-lg bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-600">
                                    {{ $shipment->min_temperature }}°C -
                                    {{ $shipment->max_temperature }}°C
                                </span>

                            </td>


                            <!-- Dates -->
                            <td class="px-5 py-4">

                                <p class="text-xs text-gray-700">
                                    {{ \Carbon\Carbon::parse($shipment->departure_date)->format('d M Y') }}
                                </p>

                                <p class="text-xs text-gray-400">
                                    {{ \Carbon\Carbon::parse($shipment->expected_arrival)->format('d M Y') }}
                                </p>

                            </td>


                            <!-- Status -->
                            <td class="px-5 py-4">

                                <span class="rounded-lg bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">
                                    Approved
                                </span>

                            </td>


                            <!-- Actions -->
                            <td class="px-5 py-4">

                                <div class="flex justify-end gap-2">


                                    <!-- Assign Driver -->
                                    {{-- <a href="/admin/shipments/{{ $shipment->id }}/assign"
                                        class="rounded-lg border border-blue-200 bg-blue-50 px-3 py-1.5 text-xs font-semibold text-blue-600 transition hover:bg-blue-100">
                                        Assign Driver
                                    </a> --}}
  
                                <form action="/admin/approved/{{ $shipment->id }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select name="driver_id"
                                     class="rounded-lg border border-blue-200 bg-blue-50 px-3 py-1.5 text-xs">

                                    <option value="">
                                        Select Driver
                                    </option>

                                    @foreach($drivers as $driver)

                                        <option value="{{ $driver->id }}">
                                        {{$driver->name}}
                                        </option>

                                    @endforeach

                                    </select>


                                    <button type="submit" class="rounded-lg border border-blue-100 bg-white px-3 py-1.5 text-xs font-semibold text-blue-600 transition hover:bg-blue-50">
                                        Assign
                                    </button>
                                    </form>



                                    <!-- View -->
                                    <a href="/showAdminShipments/{{ $shipment->id }}"
                                        class="rounded-lg border border-blue-100 bg-white px-3 py-1.5 text-xs font-semibold text-blue-600 transition hover:bg-blue-50">
                                        View
                                    </a>


                                </div>

                            </td>


                        </tr>


                        @empty

                        <tr>

                            <td colspan="6" class="px-5 py-8 text-center text-sm text-gray-400">
                                No approved shipments available.
                            </td>

                        </tr>

                        @endforelse


                    </tbody>

                </table>

            </div>

        </div>


    </div>

</div>

</x-admin-layout>