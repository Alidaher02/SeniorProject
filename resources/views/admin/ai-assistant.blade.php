<x-admin-layout>

    <div class="mx-auto max-w-[1400px]">

        {{-- PAGE HEADER --}}
        <div class="mb-5 flex items-center justify-between">
            <div>
                <div class="flex items-center gap-2.5">
                    <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-600">
                        <svg class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M9 17.25 7.5 19.5h9L15 17.25M5.25 4.5h13.5A2.25 2.25 0 0 1 21 6.75v8.25a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V6.75A2.25 2.25 0 0 1 5.25 4.5Z"/>
                        </svg>
                    </div>

                    <div>
                        <h1 class="text-lg font-semibold text-slate-900">
                            In-Transit Shipments
                        </h1>
                        <p class="text-xs text-slate-500">
                            Monitor active shipments and analyze their condition.
                        </p>
                    </div>
                </div>
            </div>

            <div class="hidden items-center gap-2 rounded-lg border border-slate-200 bg-white px-3 py-2 sm:flex">
                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>

                <div>
                    <p class="text-[10px] text-slate-400">Active</p>
                    <p class="text-sm font-semibold text-slate-800">{{$shipments->count()}} Shipments</p>
                </div>
            </div>
        </div>


        {{-- TABLE --}}
        <div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">

            {{-- TABLE HEADER --}}
            <div class="flex items-center justify-between border-b border-slate-200 px-4 py-3">

                <div>
                    <h2 class="text-sm font-semibold text-slate-800">
                        Active Shipments
                    </h2>

                    <p class="mt-0.5 text-[11px] text-slate-400">
                        Analyze individual shipments using AI.
                    </p>
                </div>

                <button
                    type="button"
                    class="inline-flex items-center gap-1.5 rounded-md border border-slate-200 bg-white px-2.5 py-1.5 text-[11px] font-medium text-slate-600 hover:bg-slate-50"
                >
                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M3 4h18M6 8h12M9 12h6M11 16h2"/>
                    </svg>
                    Filter
                </button>

            </div>


            {{-- TABLE --}}
            <div class="overflow-x-auto">

                <table class="w-full min-w-[760px] text-left">

                    <thead class="border-b border-slate-100 bg-slate-50">
                    <tr>

                        <th class="px-4 py-2.5 text-[10px] font-semibold uppercase tracking-wide text-slate-400">
                            Shipment
                        </th>

                        <th class="px-4 py-2.5 text-[10px] font-semibold uppercase tracking-wide text-slate-400">
                            Product
                        </th>

                        <th class="px-4 py-2.5 text-[10px] font-semibold uppercase tracking-wide text-slate-400">
                            Route
                        </th>

                        <th class="px-4 py-2.5 text-[10px] font-semibold uppercase tracking-wide text-slate-400">
                            Status
                        </th>

                        <th class="px-4 py-2.5 text-right text-[10px] font-semibold uppercase tracking-wide text-slate-400">
                            Action
                        </th>

                    </tr>
                    </thead>


                    <tbody class="divide-y divide-slate-100">

                    @foreach ($shipments as $shipment)
                    <tr class="transition hover:bg-slate-50">

                        <td class="px-4 py-3">

                            <div class="flex items-center gap-2.5">

                                <div class="flex h-8 w-8 items-center justify-center rounded-md bg-blue-50">
                                    <svg class="h-3.5 w-3.5 text-blue-600"
                                         fill="none" viewBox="0 0 24 24"
                                         stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="M3 7.5 12 3l9 4.5M4.5 8.25V18L12 21l7.5-3V8.25M12 21V12M4.5 8.25 12 12l7.5-3.75"/>
                                    </svg>
                                </div>

                                <div>
                                    <p class="text-xs font-semibold text-slate-800">
                                        {{ $shipment->{'tracking-number'} }}
                                    </p>

                                    <p class="text-[10px] text-slate-400">
                                        Shipment #{{$shipment->id}}
                                    </p>
                                </div>

                            </div>

                        </td>


                        <td class="px-4 py-3">
                            <p class="text-xs font-medium text-slate-700">
                               {{ $shipment->product_name }}
                            </p>

                            <p class="mt-0.5 text-[10px] text-slate-400">
                                Temperature sensitive
                            </p>
                        </td>


                        <td class="px-4 py-3">

                            <div class="flex items-center gap-2">

                                <span class="text-xs font-medium text-slate-600">
                                    {{ $shipment->origin }}
                                </span>

                                <div class="flex w-16 items-center gap-1">
                                    <span class="h-1 w-1 rounded-full bg-blue-400"></span>
                                    <span class="h-px flex-1 border-t border-dashed border-slate-300"></span>

                                    <svg class="h-3 w-3 text-blue-500"
                                         fill="currentColor"
                                         viewBox="0 0 24 24">
                                        <path d="M21 16v-2l-8-5V3.5a1.5 1.5 0 0 0-3 0V9l-8 5v2l8-2.5V19l-2.5 1.5V22l4-1 4 1v-1.5L13 19v-5.5l8 2.5Z"/>
                                    </svg>

                                    <span class="h-px flex-1 border-t border-dashed border-slate-300"></span>
                                    <span class="h-1 w-1 rounded-full bg-blue-400"></span>
                                </div>

                                <span class="text-xs font-medium text-slate-600">
                                    {{ $shipment->destination }}
                                </span>

                            </div>

                        </td>


                        <td class="px-4 py-3">

                            <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2 py-1 text-[10px] font-medium text-emerald-700">
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                {{ $shipment->status }}
                            </span>

                        </td>


                        <td class="px-4 py-3 text-right">

                            <button
                                type="button"
                                class="analyze-btn cursor-pointer inline-flex items-center gap-1.5 rounded-md bg-blue-600 px-2.5 py-1.5 text-[10px] font-semibold text-white transition hover:bg-blue-700"
                                data-id="{{ $shipment->id }}"
                            >
                                <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.5 2 8 6.5 3.5 8l4.5 1.5L9.5 14l1.5-4.5L15.5 8 11 6.5 9.5 2ZM16 12l-.8 2.2L13 15l2.2.8.8 2.2L17 15l2.2-.8-2.2-.8L16 12Z"/>
                                </svg>

                                Analyze
                            </button>

                        </td>

                    </tr>                        
                    @endforeach
                <div
                    id="analysisLoading"
                    class="fixed inset-0 z-[200] hidden items-center justify-center bg-slate-900/40 p-4 backdrop-blur-sm"
                >
                    <div class="w-full max-w-sm rounded-2xl border border-slate-200 bg-white p-6 shadow-2xl">

                        <div class="mb-5 flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50">
                                <svg
                                    class="h-5 w-5 animate-spin text-blue-600"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <circle
                                        cx="12"
                                        cy="12"
                                        r="9"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        opacity=".25"
                                    />

                                    <path
                                        d="M21 12a9 9 0 0 0-9-9"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                    />
                                </svg>
                            </div>

                            <div>
                                <h3 class="text-sm font-semibold text-slate-900">
                                    Analyzing Shipment
                                </h3>

                                <p class="text-xs text-slate-500">
                                    ShipTrack AI is analyzing the shipment...
                                </p>
                            </div>
                        </div>

                        <div class="mb-2 flex items-center justify-between">
                            <span class="text-[11px] font-medium text-slate-500">
                                Analysis progress
                            </span>

                            <span
                                id="analysisProgressText"
                                class="text-sm font-bold text-blue-600"
                            >
                                0%
                            </span>
                        </div>

                        <div class="h-2 overflow-hidden rounded-full bg-slate-100">
                            <div
                                id="analysisProgressBar"
                                class="h-full rounded-full bg-blue-600 transition-all duration-300"
                                style="width: 0%"
                            ></div>
                        </div>

                        <p
                            id="analysisStatus"
                            class="mt-4 text-center text-[11px] text-slate-400"
                        >
                            Collecting shipment data...
                        </p>

                    </div>
                </div>


                    </tbody>

                </table>

            </div>


            {{-- PAGINATION --}}
            <div class="flex items-center justify-between border-t border-slate-100 px-4 py-2.5">

                <p class="text-[10px] text-slate-400">
                    Showing <span class="font-medium text-slate-600">1–3</span>
                    of <span class="font-medium text-slate-600">7</span>
                </p>

                <div class="flex gap-1">

                    <button class="rounded border border-slate-200 px-2 py-1 text-[10px] text-slate-400">
                        Previous
                    </button>

                    <button class="rounded bg-blue-600 px-2.5 py-1 text-[10px] font-medium text-white">
                        1
                    </button>

                    <button class="rounded border border-slate-200 px-2.5 py-1 text-[10px] text-slate-600 hover:bg-slate-50">
                        2
                    </button>

                    <button class="rounded border border-slate-200 px-2.5 py-1 text-[10px] text-slate-600 hover:bg-slate-50">
                        3
                    </button>

                    <button class="rounded border border-slate-200 px-2 py-1 text-[10px] text-slate-600 hover:bg-slate-50">
                        Next
                    </button>

                </div>

            </div>

        </div>


        {{-- HOW AI WORKS --}}
        <div class="mt-4 rounded-lg border border-slate-200 bg-white px-4 py-3">

            <div class="mb-3">
                <h2 class="text-xs font-semibold text-slate-800">
                    How AI Analysis Works
                </h2>

                <p class="text-[10px] text-slate-400">
                    AI evaluates the complete shipment history.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-2 sm:grid-cols-3">

                <div class="flex items-center gap-2.5 rounded-md bg-slate-50 px-3 py-2.5">
                    <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-blue-600 text-[10px] font-bold text-white">
                        1
                    </span>

                    <div>
                        <p class="text-[11px] font-semibold text-slate-700">
                            Sensor Data
                        </p>
                        <p class="text-[10px] text-slate-400">
                            Temperature, humidity, tilt and light.
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-2.5 rounded-md bg-slate-50 px-3 py-2.5">
                    <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-blue-600 text-[10px] font-bold text-white">
                        2
                    </span>

                    <div>
                        <p class="text-[11px] font-semibold text-slate-700">
                            Shipment Limits
                        </p>
                        <p class="text-[10px] text-slate-400">
                            Compare readings against allowed ranges.
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-2.5 rounded-md bg-slate-50 px-3 py-2.5">
                    <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-blue-600 text-[10px] font-bold text-white">
                        3
                    </span>

                    <div>
                        <p class="text-[11px] font-semibold text-slate-700">
                            AI Assessment
                        </p>
                        <p class="text-[10px] text-slate-400">
                            Generate risk and recommendations.
                        </p>
                    </div>
                </div>

            </div>

        </div>

    </div>


    {{-- ========================================================== --}}
    {{-- AI ANALYSIS MODAL --}}
    {{-- ========================================================== --}}

    <div
        id="analysisModal"
    class="fixed inset-0 z-[100] hidden items-center justify-center bg-slate-900/40 p-4 backdrop-blur-sm"
    >

        <div
            id="analysisModalContent"
            class="max-h-[90vh] w-full max-w-2xl overflow-hidden rounded-xl border border-slate-200 bg-white shadow-2xl"
        >

            {{-- MODAL HEADER --}}
            <div class="flex items-center justify-between border-b border-slate-200 px-5 py-4">

                <div class="flex items-center gap-3">

                    <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-600">
                        <svg class="h-4 w-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.5 2 8 6.5 3.5 8l4.5 1.5L9.5 14l1.5-4.5L15.5 8 11 6.5 9.5 2ZM16 12l-.8 2.2L13 15l2.2.8.8 2.2L17 15l2.2-.8-2.2-.8L16 12Z"/>
                        </svg>
                    </div>

                    <div>
                        <h2 class="text-sm font-semibold text-slate-900">
                            AI Shipment Analysis
                        </h2>

                        <p id="modalTracking" class="text-[10px] text-slate-400">
                            
                        </p>
                    </div>

                </div>

                <button
                    id="closeAnalysis"
                    type="button"
                    class="rounded-md p-1.5 cursor-pointer text-slate-400 hover:bg-slate-100 hover:text-slate-600"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M6 18 18 6M6 6l12 12"/>
                    </svg>
                </button>

            </div>


            {{-- MODAL CONTENT --}}
            <div class="max-h-[calc(90vh-130px)] overflow-y-auto p-5">

                {{-- RISK --}}
                <div class="mb-4">

                    <div class="mb-2 flex items-center justify-between">
                        <p class="text-[10px] font-semibold uppercase tracking-wide text-slate-400">
                            Overall Risk
                        </p>

                        <span id="riskLevel" class="rounded-full bg-orange-50 px-2 py-1 text-[9px] font-semibold text-orange-700">
                            HIGH RISK
                        </span>
                    </div>

                    <div class="rounded-lg border border-orange-200 bg-orange-50 p-4">

                        <div class="flex items-center gap-4">

                            <div class="relative flex h-20 w-20 shrink-0 items-center justify-center">

                                <svg class="h-20 w-20 -rotate-90" viewBox="0 0 100 100">

                                    <circle
                                        cx="50"
                                        cy="50"
                                        r="40"
                                        fill="none"
                                        stroke="#fed7aa"
                                        stroke-width="8"
                                    />

                                    <circle
                                    id="riskCircle"
                                        cx="50"
                                        cy="50"
                                        r="40"
                                        fill="none"
                                        stroke="#f97316"
                                        stroke-width="8"
                                        stroke-linecap="round"
                                        stroke-dasharray="251"
                                        stroke-dashoffset="80"
                                    />

                                </svg>

                                <div class="absolute">
                                    <span id="riskPercent" class="text-lg font-bold text-orange-700">
                                        
                                    </span>
                                </div>

                            </div>

                            <div>
                                <p class="text-sm font-semibold text-orange-800">
                                     shipment risk
                                </p>

                                <p class="mt-1 text-xs leading-5 text-orange-700">
                                    Sensor history indicates multiple threshold
                                    violations during transit.
                                </p>
                            </div>

                        </div>

                    </div>

                </div>


                {{-- SUMMARY --}}
                <div class="mb-4">

                    <p class="mb-2 text-[10px] font-semibold uppercase tracking-wide text-slate-400">
                        AI Summary
                    </p>

                    <div class="rounded-lg border border-slate-200 bg-slate-50 p-3.5">

                        <p id="summary" class="text-xs leading-5 text-slate-600">
                            
                        </p>

                    </div>

                </div>


                {{-- ENVIRONMENT --}}
                <div class="mb-4">

                    <p class="mb-2 text-[10px] font-semibold uppercase tracking-wide text-slate-400">
                        Current Conditions
                    </p>

                    <div class="grid grid-cols-2 gap-2.5">

                        <div class="rounded-lg border border-slate-200 p-3">

                            <div class="flex items-center justify-between">

                                <p class="text-[10px] text-slate-400">
                                    Temperature
                                </p>

                                <span class="text-[9px] font-semibold text-emerald-600">
                                    NORMAL
                                </span>

                            </div>

                            <p id="temp" class="mt-2 text-lg font-bold text-slate-800">
                               
                            </p>

                            <p id="tempRange" class="mt-1 text-[10px] text-slate-400">
                                Allowed: 2°C – 8°C
                            </p>

                        </div>


                        <div class="rounded-lg border border-slate-200 p-3">

                            <div class="flex items-center justify-between">

                                <p class="text-[10px] text-slate-400">
                                    Humidity
                                </p>

                                <span class="text-[9px] font-semibold text-emerald-600">
                                    NORMAL
                                </span>

                            </div>

                            <p id="humidity" class="mt-2 text-lg font-bold text-slate-800">
                                48%
                            </p>

                            <p id="humidityRange" class="mt-1 text-[10px] text-slate-400">
                                Allowed: 30% – 60%
                            </p>

                        </div>


                        <div class="rounded-lg border border-slate-200 p-3">

                            <p class="text-[10px] text-slate-400">
                                Location
                            </p>

                            <p class="mt-2 text-sm font-semibold text-slate-800">
                                Beirut, Lebanon
                            </p>

                            <p id="gpsReadings" class="mt-1 text-[10px] text-slate-400">
                                33.8938, 35.5018
                            </p>

                        </div>


                        <div class="rounded-lg border border-slate-200 p-3">

                            <p class="text-[10px] text-slate-400">
                                Last Update
                            </p>

                            <p class="mt-2 text-sm font-semibold text-slate-800">
                                10:30 AM
                            </p>

                            <p class="mt-1 text-[10px] text-slate-400">
                                15 May 2025
                            </p>

                        </div>

                    </div>

                </div>


                {{-- ISSUES --}}
                <div class="mb-4">

                    <div class="mb-2 flex items-center justify-between">

                        <p class="text-[10px] font-semibold uppercase tracking-wide text-slate-400">
                            Issues Detected
                        </p>

                        <span id="issuesCount" class="rounded-full bg-red-50 px-2 py-1 text-[9px] font-semibold text-red-600">
                            
                        </span>

                    </div>

                    <div id="issuesContainer" class="space-y-2">


                    </div>

                </div>


                {{-- WARNINGS --}}
                <div class="mb-4">

                    <p class="mb-2 text-[10px] font-semibold uppercase tracking-wide text-slate-400">
                        Warnings
                    </p>

                    <div id="warningContainer" class="grid grid-cols-2 gap-2">


                    </div>

                </div>


                {{-- RECOMMENDATIONS --}}
                <div>

                    <p class="mb-2 text-[10px] font-semibold uppercase tracking-wide text-slate-400">
                        Recommendations
                    </p>

                    <div id="recommendationsContainer" class="space-y-1.5">


                    </div>

                </div>

            </div>


            {{-- FOOTER --}}
            <div class="flex items-center justify-between border-t border-slate-200 bg-slate-50 px-5 py-3">

                <p class="text-[10px] text-slate-400">
                    Generated by ShipTrack AI
                </p>

                <button
                    id="closeAnalysisBottom"
                    type="button"
                    class="rounded-md bg-slate-800 px-3 py-1.5 text-[10px] font-medium text-white hover:bg-slate-700"
                >
                    Close
                </button>

            </div>

        </div>

    </div>


    {{-- ========================================================== --}}
    {{-- JAVASCRIPT --}}
    {{-- ========================================================== --}}

</x-admin-layout>