<x-admin-layout>


  <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
  

  <x-admin-card title="Shipments" id="total" />

    <x-admin-card title="Pending" id="pending" />

      <x-admin-card title="Approved" id="approved" />

        <x-admin-card title="In_transit" id="in_transit" />

          <x-admin-card title="Delivered" id="delivered" />
           
                <x-admin-card title="Alerts" id="alerts" />





   </div>


<div class="mt-5">
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

</div>

</x-admin-layout>
