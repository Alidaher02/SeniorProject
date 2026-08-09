{{-- <x-admin-layout>

<div class="relative min-h-screen bg-[#0a0d12] p-6 text-slate-300">

    <!-- subtle scanline texture -->
    <div class="pointer-events-none fixed inset-0 opacity-[0.035]"
         style="background-image: repeating-linear-gradient(0deg, #fff 0px, #fff 1px, transparent 1px, transparent 3px);"></div>

    <div class="relative mx-auto max-w-6xl">

        <!-- Header -->
        <div class="flex flex-wrap items-end justify-between gap-4 border-b border-[#1e2530] pb-5">
            <div>
                <div class="flex items-center gap-2 text-[11px] font-semibold uppercase tracking-[0.25em] text-slate-500">
                    <span class="relative flex h-1.5 w-1.5">
                        <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                    </span>
                    System Status &middot; Live Feed
                </div>
                <h1 class="mt-2 font-mono text-3xl font-black uppercase tracking-[0.1em] text-white">
                    Alerts <span class="text-slate-600">/</span> Center
                </h1>
                <p class="mt-1 font-mono text-xs text-slate-500">COLD-CHAIN TELEMETRY &middot; ALL ACTIVE ROUTES</p>
            </div>

            <div class="flex gap-2">
                <button class="rounded-md border border-[#1e2530] bg-[#10141b] px-3 py-2 font-mono text-xs uppercase tracking-wide text-slate-400 transition hover:border-slate-500 hover:text-slate-200">
                    <i class="fa-solid fa-sliders mr-1.5"></i>Filter
                </button>
                <button class="rounded-md border border-[#1e2530] bg-[#10141b] px-3 py-2 font-mono text-xs uppercase tracking-wide text-slate-400 transition hover:border-slate-500 hover:text-slate-200">
                    <i class="fa-solid fa-arrow-down-wide-short mr-1.5"></i>Sort
                </button>
            </div>
        </div>

        <!-- Status strip -->
        <div class="mt-5 grid grid-cols-2 divide-y divide-[#1e2530] rounded-lg border border-[#1e2530] bg-[#10141b] md:grid-cols-4 md:divide-x md:divide-y-0">

            <div class="flex items-center justify-between px-5 py-4">
                <div>
                    <p class="flex items-center gap-1.5 font-mono text-[11px] uppercase tracking-wider text-slate-500">
                        <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>Critical
                    </p>
                    <p class="mt-1 font-mono text-3xl font-bold text-white">03</p>
                </div>
                <span class="font-mono text-[11px] text-red-400"><i class="fa-solid fa-arrow-trend-up mr-1"></i>+2</span>
            </div>

            <div class="flex items-center justify-between px-5 py-4">
                <div>
                    <p class="flex items-center gap-1.5 font-mono text-[11px] uppercase tracking-wider text-slate-500">
                        <span class="h-1.5 w-1.5 rounded-full bg-amber-400"></span>Active
                    </p>
                    <p class="mt-1 font-mono text-3xl font-bold text-white">08</p>
                </div>
                <span class="font-mono text-[11px] text-slate-500"><i class="fa-solid fa-minus mr-1"></i>0</span>
            </div>

            <div class="flex items-center justify-between px-5 py-4">
                <div>
                    <p class="flex items-center gap-1.5 font-mono text-[11px] uppercase tracking-wider text-slate-500">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>Resolved
                    </p>
                    <p class="mt-1 font-mono text-3xl font-bold text-white">24</p>
                </div>
                <span class="font-mono text-[11px] text-emerald-400"><i class="fa-solid fa-arrow-trend-up mr-1"></i>+6</span>
            </div>

            <div class="flex items-center justify-between px-5 py-4">
                <div>
                    <p class="flex items-center gap-1.5 font-mono text-[11px] uppercase tracking-wider text-slate-500">
                        <span class="h-1.5 w-1.5 rounded-full bg-blue-400"></span>Total
                    </p>
                    <p class="mt-1 font-mono text-3xl font-bold text-white">35</p>
                </div>
                <span class="font-mono text-[11px] text-slate-500">24H</span>
            </div>

        </div>

        <!-- Alerts Container -->
        <div id="AlertsContainer" class="mt-6 space-y-3">

            <!-- Alert Ticket: Critical -->
            <div class="flex flex-col overflow-hidden rounded-lg border border-[#1e2530] bg-[#10141b] md:flex-row">

                <!-- severity spine -->
                <div class="flex shrink-0 items-center justify-center gap-2 bg-red-500/10 px-3 py-2 md:w-11 md:flex-col md:py-4">
                    <i class="fa-solid fa-temperature-high text-red-400"></i>
                    <span class="font-mono text-[10px] font-bold uppercase tracking-widest text-red-400 md:[writing-mode:vertical-rl] md:rotate-180">Critical</span>
                </div>

                <!-- body -->
                <div class="flex-1 p-5">
                    <div class="flex flex-wrap items-start justify-between gap-3">
                        <div>
                            <div class="flex items-center gap-2">
                                <h3 class="text-sm font-bold text-white">Temperature High</h3>
                                <span class="rounded bg-white/5 px-1.5 py-0.5 font-mono text-[10px] text-slate-500">#102</span>
                            </div>
                            <p class="mt-1 font-mono text-[11px] text-slate-500">MEDICINE BOX &middot; BEY &rarr; TRP &middot; SENSOR A-102-T</p>
                        </div>
                        <!-- barcode flourish -->
                        <div class="h-6 w-16 opacity-30"
                             style="background-image: repeating-linear-gradient(90deg, currentColor 0 1px, transparent 1px 2px, currentColor 3px 5px, transparent 5px 7px, currentColor 7px 8px, transparent 8px 10px); color: #94a3b8;"></div>
                    </div>

                    <div class="mt-4 grid gap-3 md:grid-cols-[1fr_1fr_1.2fr]">

                        <div>
                            <p class="font-mono text-[10px] uppercase tracking-wider text-slate-500">Reading</p>
                            <p class="mt-1 font-mono text-2xl font-bold text-red-400">15.0<span class="text-sm text-red-400/50">°C</span></p>
                            <p class="font-mono text-[11px] text-slate-500">Range 2–8°C &middot; <span class="text-red-400">+7.0 over</span></p>
                        </div>

                        <div>
                            <p class="font-mono text-[10px] uppercase tracking-wider text-slate-500">Duration</p>
                            <p class="mt-1 font-mono text-2xl font-bold text-white">10<span class="text-sm text-slate-500">m</span></p>
                            <p class="font-mono text-[11px] text-slate-500">Since 14:22 UTC</p>
                        </div>

                        <div>
                            <p class="font-mono text-[10px] uppercase tracking-wider text-slate-500">Excursion level</p>
                            <div class="mt-2 flex gap-1">
                                <div class="h-4 flex-1 rounded-sm bg-red-500"></div>
                                <div class="h-4 flex-1 rounded-sm bg-red-500"></div>
                                <div class="h-4 flex-1 rounded-sm bg-red-500"></div>
                                <div class="h-4 flex-1 rounded-sm bg-red-500"></div>
                                <div class="h-4 flex-1 rounded-sm bg-red-500"></div>
                                <div class="h-4 flex-1 rounded-sm bg-white/10"></div>
                            </div>
                            <p class="mt-1 font-mono text-[11px] text-red-400">5 / 6 &middot; escalate now</p>
                        </div>

                    </div>

                    <div class="mt-4 flex flex-wrap items-center justify-between gap-3 border-t border-dashed border-[#1e2530] pt-3">
                        <p class="font-mono text-[11px] text-slate-500">10 minutes ago</p>
                        <div class="flex gap-2">
                            <button class="rounded border border-[#1e2530] px-3 py-1.5 font-mono text-[11px] uppercase tracking-wide text-slate-400 transition hover:border-slate-500 hover:text-slate-200">
                                View
                            </button>
                            <button class="rounded bg-emerald-500 px-3 py-1.5 font-mono text-[11px] font-bold uppercase tracking-wide text-[#0a0d12] transition hover:bg-emerald-400">
                                Resolve
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alert Ticket: Active -->
            <div class="flex flex-col overflow-hidden rounded-lg border border-[#1e2530] bg-[#10141b] md:flex-row">

                <div class="flex shrink-0 items-center justify-center gap-2 bg-amber-400/10 px-3 py-2 md:w-11 md:flex-col md:py-4">
                    <i class="fa-solid fa-droplet text-amber-400"></i>
                    <span class="font-mono text-[10px] font-bold uppercase tracking-widest text-amber-400 md:[writing-mode:vertical-rl] md:rotate-180">Active</span>
                </div>

                <div class="flex-1 p-5">
                    <div class="flex flex-wrap items-start justify-between gap-3">
                        <div>
                            <div class="flex items-center gap-2">
                                <h3 class="text-sm font-bold text-white">Humidity Fluctuation</h3>
                                <span class="rounded bg-white/5 px-1.5 py-0.5 font-mono text-[10px] text-slate-500">#098</span>
                            </div>
                            <p class="mt-1 font-mono text-[11px] text-slate-500">VACCINE BATCH &middot; BEY &rarr; DXB &middot; SENSOR B-098-H</p>
                        </div>
                        <div class="h-6 w-16 opacity-30"
                             style="background-image: repeating-linear-gradient(90deg, currentColor 0 1px, transparent 1px 2px, currentColor 3px 5px, transparent 5px 7px, currentColor 7px 8px, transparent 8px 10px); color: #94a3b8;"></div>
                    </div>

                    <div class="mt-4 grid gap-3 md:grid-cols-[1fr_1fr_1.2fr]">

                        <div>
                            <p class="font-mono text-[10px] uppercase tracking-wider text-slate-500">Reading</p>
                            <p class="mt-1 font-mono text-2xl font-bold text-amber-400">85<span class="text-sm text-amber-400/50">%</span></p>
                            <p class="font-mono text-[11px] text-slate-500">Range 40–60% &middot; <span class="text-amber-400">+25 over</span></p>
                        </div>

                        <div>
                            <p class="font-mono text-[10px] uppercase tracking-wider text-slate-500">Duration</p>
                            <p class="mt-1 font-mono text-2xl font-bold text-white">42<span class="text-sm text-slate-500">m</span></p>
                            <p class="font-mono text-[11px] text-slate-500">Since 13:50 UTC</p>
                        </div>

                        <div>
                            <p class="font-mono text-[10px] uppercase tracking-wider text-slate-500">Excursion level</p>
                            <div class="mt-2 flex gap-1">
                                <div class="h-4 flex-1 rounded-sm bg-amber-400"></div>
                                <div class="h-4 flex-1 rounded-sm bg-amber-400"></div>
                                <div class="h-4 flex-1 rounded-sm bg-amber-400"></div>
                                <div class="h-4 flex-1 rounded-sm bg-white/10"></div>
                                <div class="h-4 flex-1 rounded-sm bg-white/10"></div>
                                <div class="h-4 flex-1 rounded-sm bg-white/10"></div>
                            </div>
                            <p class="mt-1 font-mono text-[11px] text-amber-400">3 / 6 &middot; monitoring</p>
                        </div>

                    </div>

                    <div class="mt-4 flex flex-wrap items-center justify-between gap-3 border-t border-dashed border-[#1e2530] pt-3">
                        <p class="font-mono text-[11px] text-slate-500">42 minutes ago</p>
                        <div class="flex gap-2">
                            <button class="rounded border border-[#1e2530] px-3 py-1.5 font-mono text-[11px] uppercase tracking-wide text-slate-400 transition hover:border-slate-500 hover:text-slate-200">
                                View
                            </button>
                            <button class="rounded bg-emerald-500 px-3 py-1.5 font-mono text-[11px] font-bold uppercase tracking-wide text-[#0a0d12] transition hover:bg-emerald-400">
                                Resolve
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alert Ticket: Resolved -->
            <div class="flex flex-col overflow-hidden rounded-lg border border-[#1e2530] bg-[#10141b]/60 opacity-70 md:flex-row">

                <div class="flex shrink-0 items-center justify-center gap-2 bg-emerald-400/10 px-3 py-2 md:w-11 md:flex-col md:py-4">
                    <i class="fa-solid fa-check text-emerald-400"></i>
                    <span class="font-mono text-[10px] font-bold uppercase tracking-widest text-emerald-400 md:[writing-mode:vertical-rl] md:rotate-180">Resolved</span>
                </div>

                <div class="flex flex-1 flex-wrap items-center justify-between gap-3 p-5">
                    <div>
                        <div class="flex items-center gap-2">
                            <h3 class="text-sm font-bold text-white">Temperature Normalized</h3>
                            <span class="rounded bg-white/5 px-1.5 py-0.5 font-mono text-[10px] text-slate-500">#091</span>
                        </div>
                        <p class="mt-1 font-mono text-[11px] text-slate-500">INSULIN PACK &middot; BEY &rarr; JED &middot; RESOLVED 2H AGO</p>
                    </div>
                    <button class="rounded border border-[#1e2530] px-3 py-1.5 font-mono text-[11px] uppercase tracking-wide text-slate-400 transition hover:border-slate-500 hover:text-slate-200">
                        View
                    </button>
                </div>
            </div>

        </div>

    </div>

</div>

</x-admin-layout> --}}

<x-admin-layout>

<div class="relative min-h-screen bg-[#f6f7f9] p-6 text-slate-700">

    <div class="relative mx-auto max-w-6xl">

        <!-- Header -->
        <div class="flex flex-wrap items-end justify-between gap-4 border-b border-slate-200 pb-5">
            <div>
                <div class="flex items-center gap-2 text-[11px] font-semibold uppercase tracking-[0.25em] text-slate-400">
                    <span class="relative flex h-1.5 w-1.5">
                        <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-500 opacity-75"></span>
                        <span class="relative inline-flex h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                    </span>
                    System Status &middot; Live Feed
                </div>
                <h1 class="mt-2 font-mono text-3xl font-black uppercase tracking-[0.1em] text-slate-900">
                    Alerts <span class="text-slate-300">/</span> Center
                </h1>
                <p class="mt-1 font-mono text-xs text-slate-400">COLD-CHAIN TELEMETRY &middot; ALL ACTIVE ROUTES</p>
            </div>

            <div class="flex gap-2">
                <button onclick="alerts()"  class="rounded-md border cursor-pointer border-slate-200 bg-white px-3 py-2 font-mono text-xs uppercase tracking-wide text-slate-500 shadow-sm transition hover:border-slate-300 hover:text-slate-800">
                    <i class="fa-solid fa-sliders mr-1.5"></i>Active
                </button>
                <button onclick="loadResolved()" class="rounded-md cursor-pointer border border-slate-200 bg-white px-3 py-2 font-mono text-xs uppercase tracking-wide text-slate-500 shadow-sm transition hover:border-slate-300 hover:text-slate-800">
                    <i class="fa-solid fa-arrow-down-wide-short mr-1.5"></i>Resolved
                </button>
            <button onclick="alerts()" 
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

        <!-- Status strip -->
        <div class="mt-5 grid grid-cols-2 divide-y divide-slate-200 rounded-lg border border-slate-200 bg-white shadow-sm md:grid-cols-4 md:divide-x md:divide-y-0">

            <div class="flex items-center justify-between px-5 py-4">
                <div>
                    <p class="flex items-center gap-1.5 font-mono text-[11px] uppercase tracking-wider text-slate-400">
                        <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>Critical
                    </p>
                    <p class="mt-1 font-mono text-3xl font-bold text-slate-900">03</p>
                </div>
                <span class="font-mono text-[11px] text-red-500"><i class="fa-solid fa-arrow-trend-up mr-1"></i>+2</span>
            </div>

            <div class="flex items-center justify-between px-5 py-4">
                <div>
                    <p class="flex items-center gap-1.5 font-mono text-[11px] uppercase tracking-wider text-slate-400">
                        <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>Active
                    </p>
                    <p id="activeAlerts" class="mt-1 font-mono text-3xl font-bold text-slate-900">08</p>
                </div>
                <span class="font-mono text-[11px] text-slate-400"><i class="fa-solid fa-minus mr-1"></i>0</span>
            </div>

            <div class="flex items-center justify-between px-5 py-4">
                <div>
                    <p class="flex items-center gap-1.5 font-mono text-[11px] uppercase tracking-wider text-slate-400">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>Resolved
                    </p>
                    <p id="resolvedAlerts" class="mt-1 font-mono text-3xl font-bold text-slate-900">24</p>
                </div>
                <span class="font-mono text-[11px] text-emerald-600"><i class="fa-solid fa-arrow-trend-up mr-1"></i>+6</span>
            </div>

            <div class="flex items-center justify-between px-5 py-4">
                <div>
                    <p class="flex items-center gap-1.5 font-mono text-[11px] uppercase tracking-wider text-slate-400">
                        <span class="h-1.5 w-1.5 rounded-full bg-blue-500"></span>Total
                    </p>
                    <p id="totalCount" class="mt-1 font-mono text-3xl font-bold text-slate-900">35</p>
                </div>
                <span class="font-mono text-[11px] text-slate-400">24H</span>
            </div>

        </div>

        <!-- Alerts Container -->
        <div id="AlertsContainer" class="mt-6 space-y-3">
            
        </div>

    </div>

</div>

</x-admin-layout>   