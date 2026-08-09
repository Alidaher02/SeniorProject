<x-layout>

<div class="min-h-screen bg-slate-100/70 text-slate-900 font-sans" x-data="coldChainAssistant()">

    {{-- Page Header --}}
    <div class="border-b border-slate-200/80 bg-white/80 backdrop-blur-md sticky top-0 z-10 shadow-xs">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-cyan-600 to-sky-500 p-[1px] flex items-center justify-center shadow-md shadow-cyan-900/10">
                    <div class="w-full h-full bg-white rounded-[11px] flex items-center justify-center">
                        <svg class="w-5 h-5 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <h1 class="text-base font-bold text-slate-900 tracking-tight">Cold Chain Copilot</h1>
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold bg-cyan-50 text-cyan-700 border border-cyan-200/60">v2.4</span>
                    </div>
                    <p class="text-xs text-slate-500">Intelligent Logistics Engine</p>
                </div>
            </div>
            
            <div class="flex items-center gap-3">
                <div class="hidden sm:flex items-center gap-2 px-3 py-1.5 rounded-full bg-slate-100 border border-slate-200/80 text-xs text-slate-600">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                    </span>
                    Monitoring <span class="font-mono font-bold text-slate-900">{{ Auth::user()->shipments->count() }}</span> active shipments
                </div>
            </div>
        </div>
    </div>

    {{-- Main Grid --}}
    <div class="max-w-7xl mx-auto px-6 py-6 grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Chat Panel --}}
        <div class="lg:col-span-2 bg-white border border-slate-200 rounded-2xl flex flex-col h-[700px] shadow-sm overflow-hidden">

            {{-- Chat Panel Header --}}
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="relative">
                        <div class="w-8 h-8 rounded-lg bg-cyan-100 border border-cyan-200 flex items-center justify-center text-cyan-800 font-bold text-xs">
                            AI
                        </div>
                        <span class="absolute -bottom-0.5 -right-0.5 w-2.5 h-2.5 bg-emerald-500 rounded-full border-2 border-white"></span>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-slate-800">Active Copilot Session</p>
                        <p class="text-xs text-slate-500">Ask about telemetry, excursions, or routing</p>
                    </div>
                </div>
                <div class="text-[10px] font-mono font-semibold text-slate-400 bg-slate-100 border border-slate-200 px-2 py-1 rounded">
                    RAG ENABLED
                </div>
            </div>

            {{-- Messages Area --}}
            <div class="flex-1 overflow-y-auto p-6 space-y-4" x-ref="scrollArea" id="chatMessages">
                {{-- Example bot response layout --}}
                <div class="flex gap-3 max-w-[85%]">
                    <div class="w-7 h-7 rounded bg-cyan-50 border border-cyan-200 flex-shrink-0 flex items-center justify-center text-[10px] font-bold text-cyan-700">AI</div>
                    <div class="space-y-1">
                        <div class="bg-slate-100/80 border border-slate-200/60 text-slate-800 text-sm p-3.5 rounded-2xl rounded-tl-none leading-relaxed shadow-xs">
                            Hello! I am monitoring your cold chain network. How can I assist you with telemetry data or excursion reports today?
                        </div>
                        <span class="text-[10px] text-slate-400 font-mono pl-1">System ready</span>
                    </div>
                </div>
            </div>

            {{-- Suggested Prompts --}}
            <div class="px-6 py-2.5 flex flex-wrap gap-2 border-t border-slate-100 bg-slate-50/30">
                <template x-for="prompt in suggestedPrompts" :key="prompt">
                    <button 
                        
                        class="text-xs px-3 py-1.5 rounded-lg border border-slate-200 bg-white text-slate-600 hover:text-cyan-800 hover:border-cyan-300 hover:bg-cyan-50/50 transition-all shadow-2xs">
                        <span x-text="prompt"></span>
                    </button>
                </template>
            </div>

            {{-- Input Bar --}}
            <div class="p-4 border-t border-slate-200 bg-white">
                <div class="flex gap-2 items-center bg-slate-50 border border-slate-200/90 rounded-xl p-1.5 focus-within:border-cyan-500 focus-within:ring-2 focus-within:ring-cyan-500/20 focus-within:bg-white transition-all">
                    <input 
                        type="text" 
                        id="messageInput" 
                        name="message" 
                        x-model="inputText" 
                        @keydown.enter="chat()"
                        placeholder="Ask about shipment #SC-4471, a lane, or an excursion..."
                        class="flex-1 bg-transparent px-3 py-2 text-sm text-slate-800 placeholder:text-slate-400 focus:outline-none" 
                    />
                    <button 
                        onclick="chat()"
                        class="px-4 py-2 cursor-pointer rounded-lg bg-cyan-700 hover:bg-cyan-800 text-white font-medium text-sm transition-all shadow-xs hover:shadow flex items-center gap-2">
                        <span>Send</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Live Context Sidebar --}}
        <div class="space-y-6">

            {{-- Telemetry Gauge Card --}}
            <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm relative overflow-hidden">
                <div class="absolute -right-8 -bottom-8 w-28 h-28 bg-cyan-500/5 rounded-full blur-xl pointer-events-none"></div>
                
                <div class="flex items-center justify-between mb-5">
                    <p class="text-[11px] font-bold uppercase tracking-widest text-slate-400">Referenced Shipment</p>
                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-slate-100 text-slate-700 border border-slate-200">
                        SC-4471
                    </span>
                </div>

                <div class="flex items-center gap-6">
                    {{-- Vertical Gauge --}}
                    <div class="relative w-2.5 h-36 rounded-full bg-slate-100 overflow-hidden border border-slate-200/80">
                        <div class="absolute inset-x-0 top-0 bottom-0 bg-gradient-to-t from-cyan-500 via-sky-400 to-amber-500 opacity-90"></div>
                        {{-- Indicator Pin --}}
                        <div class="absolute left-1/2 -translate-x-1/2 w-4 h-2 rounded-full bg-white border border-slate-700 shadow-md transition-all duration-500" style="top: 45%;"></div>
                    </div>

                    <div class="space-y-2">
                        <div>
                            <p class="font-mono text-4xl font-extrabold text-slate-900 tracking-tight">2.4<span class="text-cyan-600 text-2xl">°C</span></p>
                            <p class="text-xs text-slate-500 mt-1 flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                Target band: <span class="text-slate-700 font-mono font-medium">2°C – 8°C</span>
                            </p>
                        </div>
                        
                        <div class="pt-2 border-t border-slate-100">
                            <p class="text-xs font-bold text-cyan-800">Beirut → Dubai</p>
                            <p class="text-[11px] text-slate-400 mt-0.5">Updated 3 min ago</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Fleet Snapshot Card --}}
            <div class="bg-white border border-slate-200 rounded-2xl p-5 space-y-4 shadow-sm">
                <p class="text-[11px] font-bold uppercase tracking-widest text-slate-400">Fleet Telemetry</p>
                
                <div class="space-y-2">
                    <div class="flex items-center justify-between text-sm p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                        <span class="text-slate-500 text-xs font-medium">In transit</span>
                        <span class="font-mono font-bold text-slate-900">{{ Auth::user()->shipments->where('status' , 'in_transit')->count() }}</span>
                    </div>

                    <div class="flex items-center justify-between text-sm p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                        <span class="text-slate-500 text-xs font-medium">Within range</span>
                        <span class="font-mono font-bold text-cyan-700">121</span>
                    </div>

                    <div class="flex items-center justify-between text-sm p-2.5 rounded-xl bg-amber-50/60 border border-amber-200/50">
                        <span class="text-amber-900 text-xs font-medium flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                            Active excursions
                        </span>
                        <span class="font-mono font-bold text-amber-700">3</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

</x-layout>