<x-layout>
@php
    $status = $shipment->status;
@endphp

@if ($status === App\Enums\ShipmentStatus::PENDING || $status === App\Enums\ShipmentStatus::APPROVED)
    @include('shipments.partials.pending_approved', ['shipment' => $shipment])
@elseif ($status === App\Enums\ShipmentStatus::DELIVERED)
    @include('shipments.partials.delivered', ['shipment' => $shipment])
@elseif ($status === App\Enums\ShipmentStatus::REJECTED)
    @include('shipments.partials.rejected', ['shipment' => $shipment])
@elseif ($status === App\Enums\ShipmentStatus::IN_TRANSIT)
    @include('shipments.partials.in_transit', ['shipment' => $shipment])
@endif

<!-- Edit Modal -->
<div id="editModel" class="hidden">
 <div class="fixed inset-0 z-50 flex items-center justify-center">
<div class="w-full max-w-xl h-[700px] rounded-3xl border border-blue-100 bg-white shadow-xl overflow-scroll">

    <!-- Header -->
    <div class="flex items-center gap-3 bg-blue-50 px-6 py-4">
        <i class="fa-solid fa-pen-to-square text-xl text-blue-600"></i>

        <h2 class="text-lg font-bold text-blue-700">
            Edit Shipment
        </h2>
    </div>

    <form action="/shipments/{{ $shipment->id }}" method="POST">
    @csrf
    @method('PATCH')
    <div class="space-y-5 p-6">


        <!-- Shipment Name -->
        <div>
            <label class="mb-2 block text-sm font-semibold text-gray-700">
                Shipment Name
            </label>

          

            <textarea
            name="product_name"
    class="w-full rounded-xl border border-blue-100 bg-blue-50 px-4 py-3 text-sm text-gray-700 shadow-sm transition focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100 resize-none"
    rows="2">{{ $shipment->product_name }}</textarea>
            </div>


        <!-- Locations -->
        <div class="grid grid-cols-2 gap-5">

            <div>
                <label class="mb-2 block text-sm font-semibold text-gray-700">
                    Pickup Location
                </label>

                <textarea
                name="origin"
    class="w-full rounded-xl border border-blue-100 bg-blue-50 px-4 py-3 text-sm text-gray-700 shadow-sm transition focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100 resize-none"
    rows="2">{{ $shipment->origin }}</textarea>
            </div>


            <div>
                <label class="mb-2 block text-sm font-semibold text-gray-700">
                    Delivery Location
                </label>

                <textarea
                name="destination"
    class="w-full rounded-xl border border-blue-100 bg-blue-50 px-4 py-3 text-sm text-gray-700 shadow-sm transition focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100 resize-none"
    rows="2">{{ $shipment->destination }}</textarea>
            </div>

        </div>


        <!-- Dates -->
        <div class="grid grid-cols-2 gap-5">

            <div>
                <label class="mb-2 block text-sm font-semibold text-gray-700">
                    Departure Date
                </label>

            <input
                name="departure_date"
                type="datetime-local"
                value="{{ \Carbon\Carbon::parse($shipment->departure_date)->format('Y-m-d\TH:i') }}"
                class="w-full rounded-xl border border-blue-100 bg-blue-50 px-4 py-3 text-sm">
            </div>


            <div>
                <label class="mb-2 block text-sm font-semibold text-gray-700">
                    Expected Arrival
                </label>

               <input
              name="expected_arrival"
             type="datetime-local"
               value="{{ \Carbon\Carbon::parse($shipment->expected_arrival)->format('Y-m-d\TH:i') }}"
              class="w-full rounded-xl border border-blue-100 bg-blue-50 px-4 py-3 text-sm">
          </div>

        </div>


        <!-- Temperature -->
        <div class="grid grid-cols-2 gap-5">

            <div>
                <label class="mb-2 block text-sm font-semibold text-gray-700">
                    Min Temperature
                </label>

                <input
                    name="min_temperature"
                    type="number"
                    value="{{ $shipment->min_temperature }}"
                    class="w-full rounded-xl border border-blue-100 bg-blue-50 px-4 py-3 text-sm">
            </div>


            <div>
                <label class="mb-2 block text-sm font-semibold text-gray-700">
                    Max Temperature
                </label>

                <input
                    name="max_temperature"
                    type="number"
                    value="{{ $shipment->max_temperature }}"
                    class="w-full rounded-xl border border-blue-100 bg-blue-50 px-4 py-3 text-sm">
            </div>
            <div>

               <label class="mb-2 block text-sm font-semibold text-gray-700">
                    Min Humidity
                </label>

                <input
                    name="min_humidity"
                    type="number"
                    value="{{ $shipment->min_humidity }}"
                    class="w-full rounded-xl border border-blue-100 bg-blue-50 px-4 py-3 text-sm">
            </div>


            <div>
                <label class="mb-2 block text-sm font-semibold text-gray-700">
                    Max Humidity
                </label>

                <input
                    name="max_humidity"
                    type="number"
                    value="{{ $shipment->max_humidity }}"
                    class="w-full rounded-xl border border-blue-100 bg-blue-50 px-4 py-3 text-sm">
            </div>

        </div>


        <!-- Description -->
        <div>
            <label class="mb-2 block text-sm font-semibold text-gray-700">
                Description
            </label>

            <textarea
                name="description"
                rows="4"
                class="w-full rounded-xl border border-blue-100 bg-blue-50 px-4 py-3 text-sm focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100">{{ $shipment->description   }}</textarea>
        </div>


        <!-- Buttons -->
        <div class="flex justify-end gap-3 border-t border-blue-100">

            <button
                id="editClose"
                type="button"
                class="rounded-xl border border-gray-300 px-5 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-100">
                Cancel
            </button>


            <button
                type="submit"
                class="rounded-xl bg-blue-600 px-6 py-2 text-sm font-semibold text-white hover:bg-blue-700">
                <i class="fa-solid fa-save mr-1"></i>
                Save Changes
            </button>

        </div>


    </div>

</div>
</form>
</div> 
</div>

    <script>

    function loadReading() {
        const temperature = document.getElementById("temperature");
        const tempMessage = document.getElementById("tempMessage");
        const humidityMessage = document.getElementById("humidityMessage");

        fetch('/shipments/{{ $shipment->id }}/sensor-reading')
            .then(response => response.json())
            .then(data => {

                temperature.textContent =
                    data.temperature ?? "--";
            if (data.temperature > {{ $shipment->max_temperature }} + 10) {

        temperature.style.setProperty("color", "#dc2626", "important"); // red-600

        tempMessage.innerHTML = `
            <span class="rounded-lg bg-red-100 px-2 py-1 text-[11px] font-semibold text-red-600">
                Warning: High Temperature
            </span>
        `;

    } else if (data.temperature > {{ $shipment->max_temperature }}) {

        temperature.style.setProperty("color", "#dc2626", "important"); // red-600

        tempMessage.innerHTML = `
            <span class="rounded-lg bg-red-100 px-2 py-1 text-[11px] font-semibold text-red-600">
                High Temperature
            </span>
        `;

    } else if (data.temperature < {{ $shipment->min_temperature }}) {

        temperature.style.setProperty("color", "#0891b2", "important"); // cyan-600

        tempMessage.innerHTML = `
            <span class="rounded-lg bg-cyan-100 px-2 py-1 text-[11px] font-semibold text-cyan-600">
                Low Temperature
            </span>
        `;

    } else {

        temperature.style.setProperty("color", "#16a34a", "important"); // green-600

        tempMessage.innerHTML = `
            <span class="rounded-lg bg-green-100 px-2 py-1 text-[11px] font-semibold text-green-600">
                Normal
            </span>
        `;
    }

                const humidity = document.getElementById("humidity");
                document.getElementById("humidity").textContent =
                    data.humidity ?? "--";

    humidity.textContent = data.humidity ?? "--";

    if (data.humidity > {{ $shipment->max_humidity }} + 10) {

        humidity.style.setProperty("color", "#dc2626", "important"); // red-600

        humidityMessage.innerHTML = `
            <span class="rounded-lg bg-red-100 px-2 py-1 text-[11px] font-semibold text-red-600">
                Warning: High humidity
            </span>
        `;

    } else if (data.humidity > {{ $shipment->max_humidity }}) {

        humidity.style.setProperty("color", "#dc2626", "important"); // red-600

        humidityMessage.innerHTML = `
            <span class="rounded-lg bg-red-100 px-2 py-1 text-[11px] font-semibold text-red-600">
                High humidity
            </span>
        `;

    } else if (data.humidity < {{ $shipment->min_humidity }}) {

        humidity.style.setProperty("color", "#0891b2", "important"); // cyan-600

        humidityMessage.innerHTML = `
            <span class="rounded-lg bg-cyan-100 px-2 py-1 text-[11px] font-semibold text-cyan-600">
                Low humidity
            </span>
        `;

    } else {

        humidity.style.setProperty("color", "#16a34a", "important"); // green-600

        humidityMessage.innerHTML = `
            <span class="rounded-lg bg-green-100 px-2 py-1 text-[11px] font-semibold text-green-600">
                Normal
            </span>
        `;
    }


                    

            });

    }

    loadReading();
    setInterval(loadReading, 1000);

    </script>


</x-layout>
