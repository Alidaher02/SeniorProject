<x-admin-layout>
<!-- Alerts -->
<div class="p-4 sm:p-5">

    <!-- Desktop Table -->
    <div class="hidden overflow-hidden rounded-xl border border-red-100 md:block">

        <table class="w-full text-left">

            <thead class="bg-red-50">
                <tr>
                    <th class="px-5 py-3 text-xs font-semibold text-red-600">Alert</th>
                    <th class="px-5 py-3 text-xs font-semibold text-red-600">Shipment</th>
                    <th class="px-5 py-3 text-xs font-semibold text-red-600">Reading</th>
                    <th class="px-5 py-3 text-xs font-semibold text-red-600">Severity</th>
                    <th class="px-5 py-3 text-xs font-semibold text-red-600">Time</th>
                    <th class="px-5 py-3 text-xs font-semibold text-red-600">Action</th>
                </tr>
            </thead>

            <tbody id="alertsContainer" class="divide-y divide-red-50">


            </tbody>

        </table>

    </div>



    <!-- Mobile Cards -->
    <div class="space-y-3 md:hidden">

        @foreach([
            ['High Temperature','Above maximum limit','TRK-874321','12°C','Critical','2 min ago'],
            ['Low Humidity','Below minimum range','TRK-345122','28%','Warning','8 min ago'],
            ['GPS Signal Lost','Device disconnected','TRK-998421','—','Critical','16 min ago'],
        ] as $alert)


        <div class="rounded-xl border border-red-100 bg-white p-4 shadow-sm">

            <div class="flex items-start justify-between">

                <div>
                    <h3 class="text-sm font-bold text-gray-800">
                        {{ $alert[0] }}
                    </h3>

                    <p class="text-xs text-gray-400">
                        {{ $alert[1] }}
                    </p>
                </div>


                <span class="rounded-lg px-2.5 py-1 text-xs font-semibold
                    {{ $alert[4] == 'Critical'
                        ? 'bg-red-100 text-red-600'
                        : 'bg-orange-100 text-orange-600' }}">
                    {{ $alert[4] }}
                </span>

            </div>


            <div class="mt-4 grid grid-cols-2 gap-3 text-sm">

                <div>
                    <p class="text-xs text-gray-400">
                        Shipment
                    </p>
                    <p class="font-semibold text-red-600">
                        {{ $alert[2] }}
                    </p>
                </div>


                <div>
                    <p class="text-xs text-gray-400">
                        Reading
                    </p>
                    <p class="font-semibold text-gray-700">
                        {{ $alert[3] }}
                    </p>
                </div>


                <div>
                    <p class="text-xs text-gray-400">
                        Time
                    </p>
                    <p class="text-gray-600">
                        {{ $alert[5] }}
                    </p>
                </div>


                <div class="flex items-end justify-end">

                    <button class="rounded-lg border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-600 hover:bg-red-100">
                        View
                    </button>

                </div>

            </div>

        </div>


        @endforeach

    </div>

</div>
</x-admin-layout>