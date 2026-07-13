<x-admin-layout>


    <div class="min-h-screen p-6">

        <div class="mx-auto mt-5 max-w-6xl overflow-hidden rounded-2xl border border-red-100 bg-white shadow-sm">

            <!-- Header -->
            <div class="flex items-center justify-between border-b border-red-100 bg-red-50 px-5 py-4">

                <div>
                    <h1 class="text-lg font-bold text-gray-800">
                        Shipment Alerts
                    </h1>

                    <p class="text-xs text-gray-400">
                        Monitor temperature, humidity and GPS alerts
                    </p>
                </div>

                <span class="rounded-lg bg-red-100 px-4 py-2 text-xs font-semibold text-red-600">
                    3 Active Alerts
                </span>

            </div>

            <!-- Table -->
            <div class="p-5">

                <div class="overflow-hidden rounded-xl border border-red-100">

                    <table class="w-full text-left">

                        <thead class="bg-red-50">

                            <tr>

                                <th class="px-5 py-3 text-xs font-semibold text-red-600">
                                    Alert
                                </th>

                                <th class="px-5 py-3 text-xs font-semibold text-red-600">
                                    Shipment
                                </th>

                                <th class="px-5 py-3 text-xs font-semibold text-red-600">
                                    Reading
                                </th>

                                <th class="px-5 py-3 text-xs font-semibold text-red-600">
                                    Severity
                                </th>

                                <th class="px-5 py-3 text-xs font-semibold text-red-600">
                                    Time
                                </th>

                                <th class="px-5 py-3 text-xs font-semibold text-red-600">
                                    Action
                                </th>

                            </tr>

                        </thead>

                        <tbody class="divide-y divide-red-50">

                            <!-- Alert 1 -->
                            <tr class="transition hover:bg-red-50/50">

                                <td class="px-5 py-4">

                                    <div>

                                        <p class="text-sm font-semibold text-gray-800">
                                            High Temperature
                                        </p>

                                        <p class="text-xs text-gray-400">
                                            Above maximum limit
                                        </p>

                                    </div>

                                </td>

                                <td class="px-5 py-4 text-sm font-medium text-red-600">
                                    TRK-874321
                                </td>

                                <td class="px-5 py-4 text-sm text-gray-600">
                                    12°C
                                </td>

                                <td class="px-5 py-4">

                                    <span class="rounded-lg bg-red-100 px-3 py-1 text-xs font-semibold text-red-600">
                                        Critical
                                    </span>

                                </td>

                                <td class="px-5 py-4 text-sm text-gray-500">
                                    2 min ago
                                </td>

                                <td class="px-5 py-4">

                                    <button class="rounded-lg border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-600 hover:bg-red-100">
                                        View
                                    </button>

                                </td>

                            </tr>



                            <!-- Alert 2 -->
                            <tr class="transition hover:bg-red-50/50">

                                <td class="px-5 py-4">

                                    <div>

                                        <p class="text-sm font-semibold text-gray-800">
                                            Low Humidity
                                        </p>

                                        <p class="text-xs text-gray-400">
                                            Below minimum range
                                        </p>

                                    </div>

                                </td>

                                <td class="px-5 py-4 text-sm font-medium text-red-600">
                                    TRK-345122
                                </td>

                                <td class="px-5 py-4 text-sm text-gray-600">
                                    28%
                                </td>

                                <td class="px-5 py-4">

                                    <span class="rounded-lg bg-orange-100 px-3 py-1 text-xs font-semibold text-orange-600">
                                        Warning
                                    </span>

                                </td>

                                <td class="px-5 py-4 text-sm text-gray-500">
                                    8 min ago
                                </td>

                                <td class="px-5 py-4">

                                    <button class="rounded-lg border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-600 hover:bg-red-100">
                                        View
                                    </button>

                                </td>

                            </tr>



                            <!-- Alert 3 -->
                            <tr class="transition hover:bg-red-50/50">

                                <td class="px-5 py-4">

                                    <div>

                                        <p class="text-sm font-semibold text-gray-800">
                                            GPS Signal Lost
                                        </p>

                                        <p class="text-xs text-gray-400">
                                            Device disconnected
                                        </p>

                                    </div>

                                </td>

                                <td class="px-5 py-4 text-sm font-medium text-red-600">
                                    TRK-998421
                                </td>

                                <td class="px-5 py-4 text-sm text-gray-600">
                                    —
                                </td>

                                <td class="px-5 py-4">

                                    <span class="rounded-lg bg-red-100 px-3 py-1 text-xs font-semibold text-red-600">
                                        Critical
                                    </span>

                                </td>

                                <td class="px-5 py-4 text-sm text-gray-500">
                                    16 min ago
                                </td>

                                <td class="px-5 py-4">

                                    <button class="rounded-lg border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-600 hover:bg-red-100">
                                        View
                                    </button>

                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</x-admin-layout>
