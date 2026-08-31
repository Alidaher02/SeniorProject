<x-admin-layout>

    <div class="grid grid-cols-1 md:grid-cols-4  gap-2">

        <x-admin-card title="Users" id="totalCustomers" />

        <x-admin-card title="Shipments" id="total" />

        <x-admin-card title="Pending" id="pending" />

        <x-admin-card title="Approved" id="approved" />

        <x-admin-card title="In_transit" id="in_transit" />

        <x-admin-card title="Delivered" id="delivered" />

        <x-admin-card title="Rejected" id="rejected" />

        <x-admin-card title="Alerts" id="alerts" />



        

    </div>


{{-- Charts & Recent Activity --}}
<div class="mt-5 flex flex-col gap-5 sm:flex-row">

    {{-- Shipments by Status --}}
    <div class="h-[430px] rounded-2xl border border-blue-100 bg-white p-5 shadow-sm sm:w-1/2">
        <h2 class="mb-4 text-lg font-semibold text-gray-800">
            Shipments by Status
        </h2>

        <div id="shipmentChart"></div>
    </div>


    {{-- Recent Activity --}}
    <div class="h-[430px] overflow-hidden rounded-2xl border border-blue-100 bg-white p-5 shadow-sm sm:w-1/2">

        <div class="mb-5 flex items-center justify-between">
            <div>
                <h2 class="text-lg font-semibold text-gray-800">
                    Recent Activity
                </h2>
                <p class="text-sm text-gray-400">
                    Latest user actions
                </p>
            </div>

            <span class="rounded-lg bg-blue-50 px-3 py-1 text-xs font-medium text-blue-600">
                Today
            </span>
        </div>


        <div class="space-y-1">

            {{-- Activity --}}
        @foreach ($activities as $activity)
            <div class="flex items-center gap-3 border-b border-gray-100 py-3 last:border-0">

                {{-- User --}}
                <div class="flex h-8 w-8 shrink-0 items-center justify-center overflow-hidden rounded-lg bg-blue-50 text-xs font-semibold text-blue-600">
                    @if ($activity->user?->image)
                        <img
                            src="{{ asset('storage/' . $activity->user->image) }}"
                            alt="{{ $activity->user->name }}"
                            class="h-full w-full object-cover"
                        >
                    @else
                        {{ strtoupper(substr($activity->user?->name ?? 'U', 0, 1)) }}
                    @endif
                </div>

                {{-- Content --}}
                <div class="min-w-0 flex-1">
                    <div class="flex items-center justify-between gap-2">
                        <p class="truncate text-xs font-semibold text-gray-800">
                            {{ $activity->action }}
                        </p>

                        <span class="shrink-0 text-[10px] text-gray-400">
                            {{ $activity->created_at->diffForHumans() }}
                        </span>
                    </div>

                    <p class="mt-0.5 truncate text-[11px] text-gray-500">
                        {{ $activity->description }}
                    </p>
                </div>

            </div>
        @endforeach


        </div>
    </div>

</div>


    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    {{-- Shipments by Status --}}
    <script>

        var shipmentOptions = {

            series: @json($shipmentStatus),

            chart: {
                type: 'pie',
                height: 350
            },

            colors: [
                '#FACC15', // Pending
                '#3B82F6', // Approved
                '#8B5CF6', // In Transit
                '#22C55E', // Delivered
                '#EF4444'  // Rejected
            ],

            labels: [
                'Pending',
                'Approved',
                'In Transit',
                'Delivered',
                'Rejected'
            ],

            legend: {
                position: 'bottom'
            }

        };


        new ApexCharts(
            document.querySelector("#shipmentChart"),
            shipmentOptions
        ).render();

    </script>


</x-admin-layout>