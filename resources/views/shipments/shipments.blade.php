<x-layout>
<div class="grid grid-cols-3 md:flex items-center gap-3 py-5">

    <button onclick="filterStatus('')"
       class="rounded-lg border px-4 py-2 text-xs font-semibold transition cursor-pointer
       {{ !request()->has('status')
            ? 'border-blue-200 bg-blue-50 text-blue-600'
            : 'border-gray-200 bg-white text-gray-600' }}">
        All
    </button>


    @foreach (['pending', 'approved', 'in_transit', 'delivered', 'rejected'] as $status)

        <button onclick="filterStatus('{{ $status }}')"
           class="rounded-lg border px-4 py-2 text-xs font-semibold transition cursor-pointer
           {{ request('status') === $status
                ? 'border-blue-200 bg-blue-50 text-blue-600'
                : 'border-gray-200 bg-white text-gray-600 hover:bg-blue-50 hover:text-blue-600' }}">
            
            {{ ucfirst(str_replace('_', ' ', $status)) }}

        </button>

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
<div id="shipmentSContainer" class="grid md:grid-cols-4 gap-3">

</div>

</div>

</x-layout>