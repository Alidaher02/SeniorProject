<x-admin-layout>

<div class="min-h-screen p-6">

    <div class="mx-auto mt-5 max-w-7xl overflow-hidden rounded-2xl border border-green-100 bg-white shadow-sm">

        <!-- Header -->
        <div class="flex items-center justify-between border-b border-green-100 bg-green-50 px-5 py-4">

            <div>
                <h1 class="text-lg font-bold text-gray-800">
                    Delivered Shipments
                </h1>

                <p class="text-xs text-gray-400">
                    View shipments that have successfully reached their destination.
                </p>
            </div>

        </div>


        <!-- Table -->
        <div class="p-5">

            <div class="overflow-hidden rounded-xl border border-green-100">

                <table class="w-full text-left">

                    <thead class="bg-green-50">

                        <tr>

                            <th class="px-5 py-3 text-xs font-semibold text-green-600">
                                Shipment
                            </th>

                            <th class="px-5 py-3 text-xs font-semibold text-green-600">
                                Route
                            </th>

                            <th class="px-5 py-3 text-xs font-semibold text-green-600">
                                Temperature
                            </th>

                            <th class="px-5 py-3 text-xs font-semibold text-green-600">
                                Schedule
                            </th>

                            <th class="px-5 py-3 text-xs font-semibold text-green-600">
                                Status
                            </th>

                            <th class="px-5 py-3 text-right text-xs font-semibold text-green-600">
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-green-50">

                        @forelse($shipments as $shipment)

                        <tr class="transition hover:bg-green-50/50">


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

                                <span class="rounded-lg bg-green-50 px-3 py-1 text-xs font-semibold text-green-600">
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

                                <span class="rounded-lg bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                    Delivered
                                </span>

                            </td>


                            <!-- Actions -->
                            <td class="px-5 py-4">

                                <div class="flex justify-end gap-2">

                                    <a href="{{ url('/shipments/' . $shipment->id) }}"
                                        class="rounded-lg border border-green-100 bg-green-50 px-3 py-1.5 text-xs font-semibold text-green-600 transition hover:bg-green-100">
                                        View
                                    </a>

                                </div>

                            </td>


                        </tr>


                        @empty

                        <tr>

                            <td colspan="6" class="px-5 py-8 text-center text-sm text-gray-400">
                                No delivered shipments available.
                            </td>

                        </tr>

                        @endforelse


                    </tbody>

                </table>

            </div>


            <!-- Pagination -->

            <div class="mt-5 flex items-center justify-between">

                {{-- Previous --}}

                @if ($shipments->onFirstPage())

                    <span class="flex h-9 items-center justify-center rounded-lg px-3 text-sm font-medium text-slate-300 cursor-not-allowed">
                        Previous
                    </span>

                @else

                    <a href="{{ $shipments->previousPageUrl() }}"
                       class="flex h-9 items-center justify-center rounded-lg border border-slate-200 px-3 text-sm font-medium text-slate-600 transition hover:bg-green-50 hover:text-green-600">
                        Previous
                    </a>

                @endif


                {{-- Pages --}}

                <div class="hidden items-center gap-1 sm:flex">

                    {{-- First page --}}

                    @if ($shipments->currentPage() > 3)

                        <a href="{{ $shipments->url(1) }}"
                           class="flex h-9 min-w-9 items-center justify-center rounded-lg px-3 text-sm font-medium text-slate-600 hover:bg-green-50 hover:text-green-600">
                            1
                        </a>

                        <span class="px-1 text-slate-400">
                            ...
                        </span>

                    @endif


                    {{-- Nearby pages --}}

                    @foreach ($shipments->getUrlRange(
                        max(1, $shipments->currentPage() - 2),
                        min($shipments->lastPage(), $shipments->currentPage() + 2)
                    ) as $page => $url)

                        @if ($page == $shipments->currentPage())

                            <span class="flex h-9 min-w-9 items-center justify-center rounded-lg bg-green-600 px-3 text-sm font-semibold text-white shadow-sm shadow-green-600/20">
                                {{ $page }}
                            </span>

                        @else

                            <a href="{{ $url }}"
                               class="flex h-9 min-w-9 items-center justify-center rounded-lg px-3 text-sm font-medium text-slate-600 transition hover:bg-green-50 hover:text-green-600">
                                {{ $page }}
                            </a>

                        @endif

                    @endforeach


                    {{-- Last page --}}

                    @if ($shipments->currentPage() < $shipments->lastPage() - 2)

                        <span class="px-1 text-slate-400">
                            ...
                        </span>

                        <a href="{{ $shipments->url($shipments->lastPage()) }}"
                           class="flex h-9 min-w-9 items-center justify-center rounded-lg px-3 text-sm font-medium text-slate-600 hover:bg-green-50 hover:text-green-600">
                            {{ $shipments->lastPage() }}
                        </a>

                    @endif

                </div>


                {{-- Next --}}

                @if ($shipments->hasMorePages())

                    <a href="{{ $shipments->nextPageUrl() }}"
                       class="flex h-9 items-center justify-center rounded-lg border border-slate-200 px-3 text-sm font-medium text-slate-600 transition hover:bg-green-50 hover:text-green-600">
                        Next
                    </a>

                @else

                    <span class="flex h-9 items-center justify-center rounded-lg px-3 text-sm font-medium text-slate-300 cursor-not-allowed">
                        Next
                    </span>

                @endif

            </div>

        </div>


    </div>

</div>

</x-admin-layout>   