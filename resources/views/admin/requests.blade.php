<x-admin-layout>

<div class="min-h-screen p-6">

    <div class="mx-auto mt-5 max-w-7xl overflow-hidden rounded-2xl border border-blue-100 bg-white shadow-sm">

        <!-- Header -->
        <div class="flex items-center justify-between border-b border-blue-100 bg-blue-50 px-5 py-4">

            <div>
                <h1 class="text-lg font-bold text-gray-800">
                    Requested Shipments
                </h1>

                <p class="text-xs text-gray-400">
                    Review customer shipment requests
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
                                Dates
                            </th>

                            <th class="px-5 py-3 text-xs font-semibold text-blue-600">
                                Status
                            </th>

                            <th class="px-5 py-3 text-xs font-semibold text-blue-600 text-right">
                                Action
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-blue-50">

                        @forelse($shipments as $shipment)

                        <tr class="transition hover:bg-blue-50/50">

                            <td class="px-5 py-4">

                                <div>

                                    <p class="text-sm font-semibold text-gray-800">
                                        {{ $shipment->product_name }}
                                    </p>

                                    <p class="text-xs text-gray-400">
                                        {{ $shipment->{'tracking-number'} }}                                    </p>

                                </div>

                            </td>

                            <td class="px-5 py-4">

                                <p class="text-sm text-gray-700">
                                    {{ $shipment->origin }}
                                </p>

                                <p class="text-xs text-gray-400">
                                    → {{ $shipment->destination }}
                                </p>

                            </td>

                            <td class="px-5 py-4">

                                <span class="rounded-lg bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-600">
                                    {{ $shipment->min_temperature }}°C -
                                    {{ $shipment->max_temperature }}°C
                                </span>

                            </td>

                            <td class="px-5 py-4">

                                <p class="text-xs text-gray-700">
                                    {{ $shipment->departure_date }}
                                </p>

                                <p class="text-xs text-gray-400">
                                    {{ $shipment->expected_arrival }}
                                </p>

                            </td>

                            <td class="px-5 py-4">

                                <span class="rounded-lg bg-yellow-50 px-3 py-1 text-xs font-semibold text-yellow-600">
                                    Pending
                                </span>

                            </td>

                            <td class="px-5 py-4">

                                <div class="flex justify-end gap-2">

                                    <a href="/showAdminShipments/{{ $shipment->id }}"
                                        class="rounded-lg border border-blue-100 bg-blue-50 px-3 py-1.5 text-xs font-semibold text-blue-600 hover:bg-blue-100">
                                        View
                                    </a>

                                      <form action="/admin/shipments/{{ $shipment->id }}" method="POST">
                                     @csrf
                                    @method('PATCH')
                                    <button
                                        class="rounded-lg cursor-pointer bg-blue-600 px-3 py-1.5 text-xs font-semibold text-white hover:bg-blue-700">
                                        Approve
                                    </button>

                                    </form>

                                    <form action="/admin/Rejectshipments/{{ $shipment->id }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button
                                        class="rounded-lg border cursor-pointer border-red-200 bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-600 hover:bg-red-100">
                                        Reject
                                    </button>
                                 </form>
                                   

                                </div>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="6"
                                class="px-5 py-6 text-center text-sm text-gray-400">

                                No shipment requests found.

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