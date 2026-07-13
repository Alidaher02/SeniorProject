<x-layout>


<main class="flex-1 px-4 py-6 sm:px-8">

    <!-- Header -->
    <div class="mb-6 flex items-start justify-between">
      <div>
        <h1 class="text-2xl font-bold text-slate-900">Request a Shipment</h1>
        <p class="mt-1 text-sm text-slate-500">Fill in the details below to create a new shipment request.</p>
      </div>
    </div>

    <!-- Stepper -->
    <div class="mb-6 rounded-2xl border border-slate-200 bg-white p-6">
      <div class="flex items-center">

        <div class="flex flex-col items-center gap-2">
          <div class="flex h-11 w-11 items-center justify-center rounded-full bg-blue-600 text-white">
            <i class="fa-solid fa-cube"></i>
          </div>
          <span class="text-xs font-semibold text-blue-600">Shipment Details</span>
        </div>

        <div class="mx-3 h-px flex-1 bg-slate-200"></div>

        <div class="flex flex-col items-center gap-2">
          <div class="flex h-11 w-11 items-center justify-center rounded-full bg-slate-100 text-slate-400">
            <i class="fa-solid fa-map-location-dot"></i>
          </div>
          <span class="text-xs font-medium text-slate-500">Pickup &amp; Delivery</span>
        </div>

        <div class="mx-3 h-px flex-1 bg-slate-200"></div>

        <div class="flex flex-col items-center gap-2">
          <div class="flex h-11 w-11 items-center justify-center rounded-full bg-slate-100 text-slate-400">
            <i class="fa-solid fa-box-open"></i>
          </div>
          <span class="text-xs font-medium text-slate-500">Package Info</span>
        </div>

        <div class="mx-3 h-px flex-1 bg-slate-200"></div>

        <div class="flex flex-col items-center gap-2">
          <div class="flex h-11 w-11 items-center justify-center rounded-full bg-slate-100 text-slate-400">
            <i class="fa-solid fa-check"></i>
          </div>
          <span class="text-xs font-medium text-slate-500">Review &amp; Submit</span>
        </div>

      </div>
    </div>

    <form action="/shipments/request" method="POST">
      @csrf
      <!-- Content grid -->
    <div class="grid grid-cols-1 xl:grid-cols-[1fr_340px] gap-6 items-start">

      <!-- Left column: form -->
      <div class="space-y-6">

        <!-- Shipment Type -->
        <section class="rounded-2xl border border-slate-200 bg-white p-6">
          <h2 class="text-base font-semibold text-slate-900">Shipment Type</h2>
          <p class="mt-0.5 mb-4 text-sm text-slate-500">Select the type of shipment you want to create.</p>

          <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">

            <label class="relative flex cursor-pointer flex-col gap-3 rounded-xl border-2 border-blue-600 bg-blue-50 p-4">
              <input type="checkbox" name="shipment_type" class="absolute right-4 top-4 h-4 w-4 accent-blue-600" checked onclick="return false;">
              <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-100 text-blue-600">
                <i class="fa-solid fa-temperature-half"></i>
              </div>
              <div>
                <p class="text-sm font-semibold text-slate-900">Temperature Sensitive</p>
                <p class="mt-0.5 text-xs text-slate-500">For vaccines, medicines and cold chain items.</p>
              </div>
            </label>

            <label class="relative flex cursor-pointer flex-col gap-3 rounded-xl bg-blue-50 border-2 border-blue-600 p-4">
              <input type="checkbox" name="shipment_type" class="absolute right-4 top-4 h-4 w-4 accent-blue-600" checked onclick="return false;">
              <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100 text-slate-500">
                <i class="fa-solid fa-box"></i>
              </div>
              <div>
                <p class="text-sm font-semibold text-slate-900">Humadity Sensitive</p>
                <p class="mt-0.5 text-xs text-slate-500">For general items and non-sensitive goods.</p>
              </div>
            </label>

              

          </div>

          <div class="mt-5">
            <label class="text-sm font-semibold text-slate-800">Shipment Name <span class="font-normal text-slate-400">(Optional)</span></label>
            <p class="mb-2 text-xs text-slate-500">Give your shipment a name for easy reference.</p>
            <input name="product_name" type="text" placeholder="e.g. COVID-19 Vaccine Shipment" class="w-full rounded-lg border border-slate-200 px-3 py-2.5 text-sm placeholder-slate-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
          </div>
          <x-forms.error name="product_name" />

          <div class="mt-5">
            <label class="text-sm font-semibold text-slate-800">Description <span class="font-normal text-slate-400">(Optional)</span></label>
            <p class="mb-2 text-xs text-slate-500">Add any special instructions or notes.</p>
            <textarea name="description" rows="3" placeholder="e.g. Handle with care, keep refrigerated, etc." class="w-full resize-y rounded-lg border border-slate-200 px-3 py-2.5 text-sm placeholder-slate-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"></textarea>
             <x-forms.error name="description" />
          </div>
        </section>

        <!-- Pickup & Delivery -->
        <section class="rounded-2xl border border-slate-200 bg-white p-6">
          <h2 class="flex items-center gap-2 text-base font-semibold text-slate-900">
            <i class="fa-solid fa-location-dot text-blue-600"></i>
            Pickup &amp; Delivery Locations
          </h2>

          <div class="mt-4 grid grid-cols-1 md:grid-cols-[1fr_auto_1fr] gap-4 items-start">

            <div>
              <p class="text-sm font-semibold text-slate-800">Pickup Location</p>
              <p class="mb-2 text-xs text-slate-500">Where should we pick up the package?</p>
              <div class="relative mb-2">
                <i class="fa-solid fa-location-dot pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                <input name="origin" type="text" placeholder="Enter pickup address" class="w-full rounded-lg border border-slate-200 py-2.5 pl-8 pr-3 text-sm placeholder-slate-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
              </div>
              <x-forms.error name="origin" />        
              <div class="grid grid-cols-1 gap-2">
                <div class="relative">
                  <input type="datetime-local" name="departure_date" placeholder="Select date" class="w-full rounded-lg border border-slate-200 py-2.5 pl-3 pr-8 text-sm placeholder-slate-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                </div>   
                <x-forms.error name="departure_date" />        
              </div>
            </div>

            <div class="hidden md:flex h-full items-center justify-center pt-10">
              <i class="fa-solid fa-arrow-right text-blue-400"></i>
            </div>

            <div>
              <p class="text-sm font-semibold text-slate-800">Delivery Location</p>
              <p class="mb-2 text-xs text-slate-500">Where should we deliver the package?</p>
              <div class="relative mb-2">
                <i class="fa-solid fa-location-dot pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                <input name="destination" type="text" placeholder="Enter delivery address" class="w-full rounded-lg border border-slate-200 py-2.5 pl-8 pr-3 text-sm placeholder-slate-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
               <x-forms.error name="destination" /> 
              </div>
              <div class="grid grid-cols-1 gap-2">
                <div class="relative">
                  <input type="datetime-local" name="expected_arrival" placeholder="Select date" class="w-full rounded-lg border border-slate-200 py-2.5 pl-3 pr-8 text-sm placeholder-slate-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                 <x-forms.error name="expected_arrival" /> 
                </div>
              </div>
            </div>

          </div>
        </section>

        <!-- Package Information -->
        <section class="rounded-2xl border border-slate-200 bg-white p-6">
          <h2 class="flex items-center gap-2 text-base font-semibold text-slate-900">
            <i class="fa-solid fa-box text-blue-600"></i>
            Package Information
          </h2>

          <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

            <div>
              <label class="mb-2 block text-sm font-semibold text-slate-800">Temperature (c)</label>
              <div class="grid grid-cols-2 gap-2">
                <input type="number" name="min_temperature" placeholder="min" class="w-full rounded-lg border border-slate-200 px-2 py-2.5 text-sm placeholder-slate-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                <input type="number" name="max_temperature" placeholder="max" class="w-full rounded-lg border border-slate-200 px-2 py-2.5 text-sm placeholder-slate-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
              </div>
               <x-forms.error name="min_temperature" />                 
               <x-forms.error name="max_temperature" /> 
            </div>
        </section>

      </div>

      <!-- Right column: summary -->
      <aside class="xl:sticky xl:top-6 rounded-2xl border border-slate-200 bg-white p-6">
        <h2 class="text-base font-semibold text-slate-900">Shipment Summary</h2>

        <div class="mt-4">
          <p class="text-xs font-medium text-slate-500">Shipment Type</p>
          <div class="mt-1.5 flex items-center gap-2 rounded-lg bg-blue-50 px-3 py-2 text-sm font-semibold text-blue-700 w-max">
            <i class="fa-solid fa-temperature-half text-xs"></i>
            Temperature Sensitive
          </div>
          <div class="mt-1.5 flex items-center gap-2 rounded-lg bg-blue-50 px-3 py-2 text-sm font-semibold text-blue-700 w-max">
            <i class="fa-solid fa-temperature-half text-xs"></i>
            Humadity Sensitive
          </div>
        </div>

        <div class="mt-5 space-y-4">
          <div class="flex gap-3">
            <div class="flex flex-col items-center pt-1">
              <span class="h-2.5 w-2.5 rounded-full bg-blue-600"></span>
              <span class="mt-1 h-8 w-px border-l border-dashed border-slate-300"></span>
            </div>
            <div>
              <p class="text-xs font-medium text-slate-500">From</p>
            </div>
          </div>

          <div class="flex gap-3">
            <div class="flex flex-col items-center pt-1">
              <i class="fa-solid fa-location-dot text-blue-600 text-xs"></i>
            </div>
            <div>
              <p class="text-xs font-medium text-slate-500">To</p>
            </div>
          </div>
        </div>

        <div class="mt-5 space-y-4 border-t border-slate-100 pt-4">
          <div class="flex items-start gap-3">
            <i class="fa-solid fa-box mt-0.5 w-4 text-center text-slate-400"></i>
            <div>
              <p class="text-xs font-medium text-slate-500">Package</p>
              <p class="text-sm font-medium text-slate-400">Not specified</p>
            </div>
          </div>

          <div class="flex items-start gap-3">
            <i class="fa-regular fa-calendar mt-0.5 w-4 text-center text-slate-400"></i>
            <div>
              <p class="text-xs font-medium text-slate-500">Est. Delivery</p>
              <p class="text-sm font-medium text-slate-400">Not specified</p>
            </div>
          </div>

          <div class="flex items-start gap-3">
            <i class="fa-solid fa-weight-hanging mt-0.5 w-4 text-center text-slate-400"></i>
            <div>
              <p class="text-xs font-medium text-slate-500">Weight</p>
              <p class="text-sm font-medium text-slate-400">Not specified</p>
            </div>
          </div>
        </div>

        <div class="mt-5 flex items-center justify-between border-t border-slate-100 pt-4">
          <p class="text-sm font-semibold text-slate-800">Estimated Cost</p>
          <p class="text-lg font-bold text-slate-900">$0.00</p>
        </div>

        <div class="mt-4 flex items-start gap-2 rounded-lg bg-slate-50 p-3">
          <i class="fa-solid fa-circle-info mt-0.5 text-xs text-slate-400"></i>
          <p class="text-xs text-slate-500">The final cost will be calculated based on package details and destination.</p>
        </div>

        <button type="submit" class="mt-4 flex w-full items-center justify-center gap-2 rounded-lg bg-blue-600 py-2.5 text-sm font-semibold text-white hover:bg-blue-700">
          Next Step
          <i class="fa-solid fa-arrow-right text-xs"></i>
        </button>
      </aside>

    </div>

    </form>
  </main>



 {{-- <div>
<p class="text-sm font-bold py-2">Approved Shipments: </p>
<div class="grid place-items-center md:flex items-center gap-12">
@foreach ($shipments as $shipment)
 @if ($shipment->status === App\Enums\ShipmentStatus::IN_TRANSIT)
<a href="/shipments/{{ $shipment->id }}" class="shipmentCart">
 <div class="max-w-sm rounded-lg overflow-hidden shadow-lg h-[460px]">
  <img class="w-full" src="{{ asset('images/medical.jpg') }}" alt="Sunset in the mountains">
  <div class="px-6 py-4">
    <div class="font-bold text-xl mb-2 line-clamp-1">{{ $shipment->product_name }}</div>
    <p class="text-gray-700 text-xs line-clamp-3">
        {{ $shipment->description }}
    </p>
  </div>
  <div class="px-6">
    <span class="inline-block bg-indigo-600 text-white rounded-full px-10 py-3 text-xs font-semibold mr-2 mb-2">{{ $shipment->status }}</span>
  </div>
</div>
</a>
@endif       
@endforeach
</div>
 </div> --}}
</x-layout>    