<x-admin-layout>

    <div class="grid grid-cols-1 md:grid-cols-5  gap-2">

        <x-admin-card title="Users" id="totalCustomers" />

        <x-admin-card title="Shipments" id="total" />

        <x-admin-card title="Drivers" id="drivers" />        

        <x-admin-card title="Pending" id="pending" />

        <x-admin-card title="Approved" id="approved" />

        <x-admin-card title="In_transit" id="in_transit" />

        <x-admin-card title="Delivered" id="delivered" />

        <x-admin-card title="Rejected" id="rejected" />

        <x-admin-card title="Alerts" id="alerts" />

        <x-admin-card title="Alerts" id="alertsResolved" />


        

    </div>


    {{-- Charts --}}
    <div class="sm:flex items-center gap-5 mt-5">


        {{-- Shipments by Status --}}
        <div class="md:w-1/2 rounded-2xl border border-blue-100 bg-white p-5 shadow-sm md:h-[430px]">

            <h2 class="mb-4 text-lg font-semibold text-gray-800">
                Shipments by Status
            </h2>

            <div id="shipmentChart"></div>

        </div>


        {{-- Shipment Counts --}}
        <div class="md:w-1/2 rounded-2xl border border-blue-100 bg-white p-5 shadow-sm md:h-[430px]">

            <h2 class="mb-4 text-lg font-semibold text-gray-800">
                Shipment Counts
            </h2>

            <div id="shipmentCountChart"></div>

        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>


    {{-- Shipment Counts --}}
    <script>

        var shipmentCountOptions = {

            series: [{
                name: 'Shipments',
                data: @json($shipmentStatus)
            }],

            chart: {
                type: 'bar',
                height: 300,
                toolbar: {
                    show: false
                }
            },

            colors: [
                '#3B82F6'
            ],

            plotOptions: {
                bar: {
                    borderRadius: 8,
                    horizontal: true
                }
            },

            xaxis: {
                categories: [
                    'Pending',
                    'Approved',
                    'In Transit',
                    'Delivered',
                    'Rejected'
                ]
            }

        };


        new ApexCharts(
            document.querySelector("#shipmentCountChart"),
            shipmentCountOptions
        ).render();

    </script>


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