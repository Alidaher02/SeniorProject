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
                </tr>
            </thead>

            <tbody id="alertsContainer" class="divide-y divide-red-50">

            </tbody>

            <tbody>
            
            @if($alerts->isEmpty())
            
                        <tr>

                            <td colspan="6" class="px-5 py-8 text-center text-sm text-gray-400">
                                No Alerts Found.
                            </td>

                        </tr>
            @endif
            </tbody>

        </table>

    </div>




</div>
</x-admin-layout>