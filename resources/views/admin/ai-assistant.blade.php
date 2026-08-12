<x-admin-layout>

    <div class="max-w-6xl mx-auto space-y-5" id="aiPage">

        {{-- Header --}}
        <div class="bg-white border border-slate-200 rounded-2xl p-5 md:p-6 shadow-sm">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                <div class="flex items-center gap-4">

                    {{-- AI Icon --}}
                    <div class="relative shrink-0">
                        <span class="absolute inset-0 rounded-xl bg-blue-500/40 animate-ping"></span>

                        <div class="relative h-12 w-12 rounded-xl bg-gradient-to-br from-blue-600 to-violet-600 flex items-center justify-center shadow-lg shadow-blue-600/20">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6 text-white"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round">

                                <path d="M12 2a4 4 0 0 1 4 4v2a4 4 0 0 1-8 0V6a4 4 0 0 1 4-4Z"/>
                                <path d="M8 14v1a4 4 0 0 0 8 0v-1"/>
                                <path d="M12 18v3"/>
                                <path d="M5 10h1"/>
                                <path d="M18 10h1"/>
                            </svg>
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center gap-2">

                            <h1 class="text-lg md:text-xl font-semibold text-slate-900">
                                AI System Analysis
                            </h1>

                            <span class="flex items-center gap-1 text-xs font-medium text-emerald-700 bg-emerald-50 border border-emerald-200 px-2 py-0.5 rounded-full">
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                Monitoring
                            </span>

                        </div>

                        <p class="text-sm text-slate-500 mt-0.5">
                            AI-powered analysis of active shipments and sensor data
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-3">

                    <span id="lastAnalyzed" class="text-xs text-slate-400">
                        
                    </span>

            <button onclick="analayze()"
                class="group flex items-center cursor-pointer gap-2 rounded-md border border-slate-200 bg-white px-3 py-2 font-mono text-xs uppercase tracking-wide text-slate-500 shadow-sm transition-all duration-300 hover:border-blue-300 hover:bg-blue-50 hover:text-blue-600">

                <svg class="h-4 w-4 cursor-pointer transition-transform duration-500 group-hover:rotate-180" 
                    fill="none" 
                    stroke="currentColor" 
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" 
                        stroke-linejoin="round" 
                        stroke-width="2" 
                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>

                Refresh
            </button>

                </div>
            </div>
        </div>


        {{-- AI Summary --}}
        <div class="bg-white border border-slate-200 rounded-2xl p-5 md:p-6 shadow-sm border-l-4 border-l-blue-600">

            <div class="flex items-center gap-2 mb-3">

                <div class="h-8 w-8 rounded-lg bg-blue-50 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4 text-blue-600"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2">

                        <path d="M12 2v4"/>
                        <path d="m16.24 7.76 2.83-2.83"/>
                        <path d="M18 12h4"/>
                        <path d="m16.24 16.24 2.83 2.83"/>
                        <path d="M12 18v4"/>
                        <path d="m4.93 19.07 2.83-2.83"/>
                        <path d="M2 12h4"/>
                        <path d="m4.93 4.93 2.83 2.83"/>
                    </svg>
                </div>

                <p class="text-xs font-semibold uppercase tracking-wide text-blue-600">
                    AI Summary
                </p>

            </div>
            <div >
            <div>
            <p class="text-slate-700 leading-relaxed" id="summaryContainer">

            </p>               
            </div>
         
            </div>


        </div>


        {{-- Statistics --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

            {{-- Active Shipments --}}
            <div class="bg-white border border-slate-200 rounded-2xl p-4 shadow-sm">

                <p class="text-xs text-slate-500">
                    Active shipments
                </p>

                <div class="flex items-end justify-between mt-1">

                    <p id="activeShipments" class="text-2xl font-semibold text-slate-900">
                        
                    </p>

                    <span class="text-xs font-medium text-emerald-600">
                        +3 today
                    </span>

                </div>
            </div>


            {{-- Active Alerts --}}
            <div class="bg-white border border-slate-200 rounded-2xl p-4 shadow-sm">

                <p class="text-xs text-slate-500">
                    Active alerts
                </p>

                <div class="flex items-end justify-between mt-1">

                    <p id="activeAlerts" class="text-2xl font-semibold text-slate-900">
                        
                    </p>

                    <span class="text-xs font-medium text-amber-600">
                        Needs review
                    </span>

                </div>
            </div>


            {{-- Critical --}}
            <div class="bg-white border border-red-200 rounded-2xl p-4 shadow-sm">

                <p class="text-xs text-red-600">
                    Critical alerts
                </p>

                <div class="flex items-end justify-between mt-1">

                    <p id="criticalAlerts" class="text-2xl font-semibold text-red-600">
                        
                    </p>

                    <span class="text-xs font-medium text-red-500">
                        High risk
                    </span>

                </div>
            </div>


            {{-- Warnings --}}
            <div class="bg-white border border-amber-200 rounded-2xl p-4 shadow-sm">

                <p class="text-xs text-amber-600">
                    Warnings
                </p>

                <div class="flex items-end justify-between mt-1">

                    <p id="warningsCount" class="text-2xl font-semibold text-amber-600">
                        
                    </p>

                    <span class="text-xs font-medium text-slate-400">
                        Monitoring
                    </span>

                </div>
            </div>

        </div>


        {{-- AI Analysis Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">


            {{-- Critical --}}
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">

                <div class="flex items-center justify-between px-4 py-3 bg-red-50 border-b border-red-100">

                    <div class="flex items-center gap-2">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 text-red-600"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2">

                            <path d="m21.73 18-8-14a2 2 0 0 0-3.46 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/>
                            <path d="M12 9v4"/>
                            <path d="M12 17h.01"/>
                        </svg>

                        <p class="text-sm font-semibold text-red-700">
                            Critical
                        </p>

                    </div>


                </div>


                <div id="criticalContainer" class="p-4 space-y-3">


                </div>
            </div>


            {{-- Warnings --}}
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">

                <div class="flex items-center justify-between px-4 py-3 bg-amber-50 border-b border-amber-100">

                    <div class="flex items-center gap-2">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 text-amber-600"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2">

                            <circle cx="12" cy="12" r="10"/>
                            <line x1="12" y1="8" x2="12" y2="12"/>
                            <line x1="12" y1="16" x2="12.01" y2="16"/>
                        </svg>

                        <p class="text-sm font-semibold text-amber-700">
                            Warnings
                        </p>

                    </div>


                </div>


                <div id="warningsContainer" class="p-4 space-y-3">

                    

                </div>
            </div>


            {{-- Recommendations --}}
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">

                <div class="flex items-center justify-between px-4 py-3 bg-blue-50 border-b border-blue-100">

                    <div class="flex items-center gap-2">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 text-blue-600"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2">

                            <path d="M9 18h6"/>
                            <path d="M10 22h4"/>
                            <path d="M12 2a7 7 0 0 0-4 12.7c.5.4.8 1 .8 1.7v.6h6.4v-.6c0-.7.3-1.3.8-1.7A7 7 0 0 0 12 2Z"/>
                        </svg>

                        <p class="text-sm font-semibold text-blue-700">
                            Recommendations
                        </p>

                    </div>

                </div>


                <div id="recommendationsContainer" class="p-4 space-y-4">



                </div>
            </div>

        </div>


        {{-- Shipment Risk Overview --}}
        <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">

            <div class="px-5 py-4 border-b border-slate-200 flex items-center justify-between">

                <div>
                    <h2 class="text-sm font-semibold text-slate-900">
                        Shipment Risk Overview
                    </h2>

                    <p class="text-xs text-slate-500 mt-0.5">
                        AI-assessed risk based on recent shipment activity
                    </p>
                </div>


            </div>


            <div id="riskCotnainer" class="divide-y divide-slate-100">

    

            </div>

        </div>

    </div>



</x-admin-layout>
