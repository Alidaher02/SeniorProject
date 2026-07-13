<x-layout>

<div class="flex items-center gap-3 py-5">

    <a href="/shipments"
       class="rounded-lg border px-4 py-2 text-xs font-semibold transition
       {{ request()->has('status')
            ? 'border-gray-200 bg-white text-gray-600'
            : 'border-blue-200 bg-blue-50 text-blue-600' }}">
        All
    </a>


    @foreach (['pending', 'approved', 'in_transit', 'delivered', 'rejected'] as $status)

        <a href="/shipments?status={{ $status }}"
           class="rounded-lg border px-4 py-2 text-xs font-semibold transition
           {{ request('status') === $status
                ? 'border-blue-200 bg-blue-50 text-blue-600'
                : 'border-gray-200 bg-white text-gray-600 hover:bg-blue-50 hover:text-blue-600' }}">
            
            {{ $status }}

        </a>

    @endforeach

</div>
{{-- 
</div>
     <!-- Header -->
    <div class="mb-6 flex items-start justify-between">
      <div>
        <h1 class="text-2xl font-bold text-slate-900">Shipments</h1>
        <p class="mt-1 text-sm text-slate-500">Showing All of Your Shipments</p>
      </div>
    </div> --}}

<div class="mt-5">
<div class="grid md:grid-cols-4 gap-3">
@forelse ($shipments as $shipment)
    
       <x-shipment-card
        status="{{ $shipment->status }}"
        title="{{ $shipment->product_name }}"
        origin="{{ $shipment->origin }}"
        destination="{{ $shipment->destination }}"
        shipmentId="{{ $shipment->{'tracking-number'} }}"
        detailsUrl="{{ url('/shipments/' . $shipment->id) }}"
        />   
    
    
@empty
  <h4>No Shipments.</h4>
@endforelse
</div>

</div>

</x-layout>