<x-admin-layout>


  <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
  

  <x-admin-card title="Shipments" id="total" />

    <x-admin-card title="Pending" id="pending" />

      <x-admin-card title="Approved" id="approved" />

        <x-admin-card title="In_transit" id="in_transit" />

          <x-admin-card title="Delivered" id="delivered" />
           
                <x-admin-card title="Alerts" id="alerts" />





   </div>

   {{-- charts --}}
 <div class="sm:flex items-center gap-5 mt-5">
 <div class="md:w-1/2 rounded-2xl border border-blue-100 bg-white p-5 shadow-sm md:h-[430px]">
    <h2 class="mb-4 text-lg font-semibold text-gray-800">
        Shipments by Status
    </h2>

    <div id="shipmentChart"></div>
</div>


<div class=" md:w-1/2 rounded-2xl border border-blue-100 bg-white p-5 shadow-sm md:h-[430px]">

    <h2 class="mb-4 text-lg font-semibold text-gray-800">
        Users Overview
    </h2>

    <div id="usersChart"></div>

</div>

 </div>



<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>

var options = {

    series: [{
        name: 'Users',
        data: @json($userStats)
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
            'Customers',
            'Drivers'
        ]
    }

};


new ApexCharts(
    document.querySelector("#usersChart"),
    options
).render();

</script>



<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
var options = {
    series: @json($shipmentStatus),
    chart: {
        type: 'pie',
        height: 350
    },

    colors: [
    '#FACC15', // Pending - Yellow
    '#3B82F6', // Approved - Blue
    '#8B5CF6', // In Transit - Purple
    '#22C55E', // Delivered - Green
    '#EF4444'  // Rejected - Red
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

new ApexCharts(document.querySelector("#shipmentChart"), options).render();
</script>


{{-- <div class="mt-5">
<div class="grid md:grid-cols-4 gap-3">
@forelse ($shipments as $shipment)
    
       <x-shipment-card
        status="{{ $shipment->status }}"
        title="{{ $shipment->product_name }}"
        origin="{{ $shipment->origin }}"
        destination="{{ $shipment->destination }}"
        shipmentId="{{ $shipment->{'tracking-number'} }}"
        detailsUrl="{{ url('/showAdminShipments/' . $shipment->id) }}"
        />   
    
    
@empty
  <h4>No Shipments.</h4>
@endforelse
</div>

</div> --}}

</x-admin-layout>
