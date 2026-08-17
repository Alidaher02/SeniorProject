<x-layout>

    <div class="grid grid-cols-1  gap-x-8 gap-y-6 max-w-6xl mx-auto">

        <!-- Page header -->
        <div class="md:col-span-2 flex items-end justify-between flex-wrap gap-4 mb-2">
            <div>
                <div class="flex items-center gap-2 text-[11px] tracking-widest uppercase text-slate-500 mb-2">
                    <span class="h-1.5 w-1.5 rounded-full bg-green-500 shadow-[0_0_8px_theme(colors.green.500)]"></span>
                    Account &amp; monitoring
                </div>

                <h1 class="text-2xl font-semibold tracking-tight text-slate-900">
                    Settings
                </h1>

                <p class="text-sm text-slate-500 mt-1">
                    Manage your profile, alert channels, and sensor thresholds.
                </p>
            </div>

            <div class="flex items-center gap-2 px-3.5 py-2 rounded-full bg-white border border-slate-200 text-xs text-slate-500 shadow-sm">
                <span class="h-1.5 w-1.5 rounded-full bg-blue-500 animate-pulse"></span>
                Live sync connected
            </div>
        </div>



        <!-- Content -->
        <div class="flex flex-col gap-6 min-w-0">

            <!-- Profile -->
            <!-- Profile -->
            <section id="profile"
                     class="scroll-mt-6 bg-white border border-slate-200 rounded-2xl p-7 shadow-sm w-full">

                <div class="flex items-center gap-3.5 mb-6">

                    <div class="w-9 h-9 rounded-[11px] bg-gradient-to-br from-[#4f7cff] to-[#8b5cf6]
                                flex items-center justify-center shadow-[0_4px_18px_-4px_rgba(79,124,255,0.35)] shrink-0">

                        <svg class="w-4.5 h-4.5 text-white"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="white"
                             stroke-width="1.8">

                            <circle cx="12" cy="8" r="3.5"/>
                            <path d="M5 20c1.5-4 4.5-6 7-6s5.5 2 7 6"/>

                        </svg>

                    </div>

                    <div>
                        <h2 class="text-base font-semibold text-slate-900">
                            Profile
                        </h2>

                        <p class="text-[13px] text-slate-500 mt-0.5">
                            This is how you appear across ShipTrack.
                        </p>
                    </div>

                </div>

                <div class="flex items-center gap-4 mb-6 w-full">

                    <div>





                        <p class="text-xs text-slate-400 mt-0.5">
                            JPG or PNG, max 2MB
                        </p>

                        <span class="inline-flex items-center gap-1.5 mt-2 px-2.5 py-1 rounded-full
                                     bg-blue-50 border border-blue-200 text-blue-600 text-xs font-medium">

                            <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                            {{ auth()->user()->role }}

                        </span>

                    </div>

                </div>

                <div class="grid grid-cols-1 sm:grid-cols-1 gap-4.5">

                    <div>
                <form id="updateProfile" class="space-y-6 w-full">

    <!-- Profile Photo -->
    <div class="flex items-center gap-5 rounded-2xl border border-slate-200 bg-slate-50/70 p-5">

        <!-- Preview -->
        <div class="relative shrink-0">
            <img
                id="profileImagePreview"
                src="{{ auth()->user()->image
                    ? asset('storage/' . auth()->user()->image)
                    : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=e2e8f0&color=475569' }}"
                alt="Profile photo"
                class="h-20 w-20 rounded-2xl object-cover ring-4 ring-white shadow-sm"
            >
        </div>

        <!-- Upload -->
        <div class="flex-1">
            <p class="text-sm font-semibold text-slate-800">
                Profile photo
            </p>

            <p class="mt-1 text-xs text-slate-400">
                Upload a clear photo of yourself.
            </p>

            <label
                for="profileImage"
                class="mt-3 inline-flex items-center gap-2 rounded-lg
                       border border-slate-200 bg-white px-3.5 py-2
                       text-xs font-semibold text-slate-700
                       shadow-sm cursor-pointer
                       transition hover:border-blue-300 hover:bg-blue-50
                       hover:text-blue-600"
            >
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M16 8l-4-4m0 0L8 8m4-4v12"
                    />
                </svg>

                Choose photo
            </label>

            <input
                type="file"
                id="profileImage"
                name="image"
                accept="image/*"
                class="hidden"
            >

            <p class="mt-2 text-[11px] text-slate-400">
                JPG or PNG · Maximum 2MB
            </p>
        </div>
    </div>


    <!-- Personal Information -->
    <div>
        <div class="mb-4">
            <h3 class="text-sm font-semibold text-slate-900">
                Personal information
            </h3>

            <p class="mt-1 text-xs text-slate-400">
                Update your name and email address.
            </p>
        </div>

        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

            <!-- Name -->
            <div>
                <label
                    for="userName"
                    class="mb-1.5 block text-xs font-semibold text-slate-600"
                >
                    Full name
                </label>

                <input
                    type="text"
                    id="userName"
                    value="{{ auth()->user()->name }}"
                    class="w-full rounded-xl border border-slate-200
                           bg-white px-3.5 py-2.5 text-sm text-slate-900
                           shadow-sm outline-none
                           transition
                           placeholder:text-slate-400
                           focus:border-blue-500
                           focus:ring-4 focus:ring-blue-500/10"
                >

                <span
                    id="nameError"
                    class="mt-1.5 block text-xs text-red-500"
                ></span>
            </div>


            <!-- Email -->
            <div>
                <label
                    for="userEmail"
                    class="mb-1.5 block text-xs font-semibold text-slate-600"
                >
                    Email address
                </label>

                <input
                    type="email"
                    id="userEmail"
                    value="{{ auth()->user()->email }}"
                    class="w-full rounded-xl border border-slate-200
                           bg-white px-3.5 py-2.5 text-sm text-slate-900
                           shadow-sm outline-none
                           transition
                           placeholder:text-slate-400
                           focus:border-blue-500
                           focus:ring-4 focus:ring-blue-500/10"
                >

                <span
                    id="emailError"
                    class="mt-1.5 block text-xs text-red-500"
                ></span>
            </div>

        </div>
    </div>


    <!-- Actions -->
    <div class="flex items-center justify-end gap-3 border-t border-slate-200 pt-5">

        <button
            type="button"
            class="rounded-xl border border-slate-200 bg-white
                   px-4 py-2.5 text-sm font-medium text-slate-600
                   shadow-sm transition
                   hover:bg-slate-50 hover:text-slate-900"
        >
            Cancel
        </button>

        <button
            type="submit"
            class="rounded-xl bg-blue-600 px-5 py-2.5
                   text-sm font-semibold text-white
                   shadow-sm shadow-blue-600/20
                   transition
                   hover:bg-blue-700
                   hover:-translate-y-0.5
                   active:translate-y-0"
        >
            Save changes
        </button>

    </div>

</form>
                    </div>
                

            </section>


            <!-- Notifications -->
            <section id="notifications"
                     class="scroll-mt-6 bg-white border border-slate-200 rounded-2xl p-7 shadow-sm">

                <div class="flex items-center gap-3.5 mb-6">

                    <div class="w-9 h-9 rounded-[11px] bg-gradient-to-br from-[#4f7cff] to-[#8b5cf6]
                                flex items-center justify-center shadow-[0_4px_18px_-4px_rgba(79,124,255,0.35)] shrink-0">

                        <svg class="w-4.5 h-4.5"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="white"
                             stroke-width="1.8">

                            <path d="M6 8a6 6 0 1 1 12 0c0 5 2 6 2 6H4s2-1 2-6Z"/>
                            <path d="M9.5 20a2.5 2.5 0 0 0 5 0"/>

                        </svg>

                    </div>

                    <div>

                        <h2 class="text-base font-semibold text-slate-900">
                            Notifications
                        </h2>

                        <p class="text-[13px] text-slate-500 mt-0.5">
                            Choose how you're alerted when a shipment needs attention.
                        </p>

                    </div>

                </div>


                <div class="divide-y divide-slate-200">

                    <!-- Temperature -->
                    <div class="flex items-center justify-between gap-4 py-4 first:pt-0">

                        <div class="flex items-center gap-3">

                            <div class="w-8.5 h-8.5 rounded-[9px] bg-slate-50 border border-slate-200
                                        flex items-center justify-center shrink-0">

                                <svg class="w-4 h-4 text-slate-500"
                                     viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="1.8">

                                    <path d="M10 3h4v10.5a4 4 0 1 1-4 0V3Z"/>

                                </svg>

                            </div>

                            <div>

                                <div class="text-sm font-medium text-slate-900">
                                    Temperature / humidity breach
                                </div>

                                <div class="text-xs text-slate-400 mt-0.5">
                                    Reading falls outside the safe range
                                </div>

                            </div>

                        </div>

                        <div class="flex bg-slate-50 border border-slate-200 rounded-lg p-0.5 gap-0.5">

                            <button class="px-2.5 py-1.5 rounded-md text-xs font-medium text-white
                                           bg-gradient-to-br from-[#4f7cff] to-[#8b5cf6]">
                                Email
                            </button>

                            <button class="px-2.5 py-1.5 rounded-md text-xs font-medium text-slate-400">
                                SMS
                            </button>

                            <button class="px-2.5 py-1.5 rounded-md text-xs font-medium text-slate-400">
                                Push
                            </button>

                        </div>

                    </div>


                    <!-- Tilt -->
                    <div class="flex items-center justify-between gap-4 py-4">

                        <div class="flex items-center gap-3">

                            <div class="w-8.5 h-8.5 rounded-[9px] bg-slate-50 border border-slate-200
                                        flex items-center justify-center shrink-0">

                                <svg class="w-4 h-4 text-slate-500"
                                     viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="1.8">

                                    <path d="M12 3l7 14H5l7-14Z"/>

                                </svg>

                            </div>

                            <div>

                                <div class="text-sm font-medium text-slate-900">
                                    Tilt or shock detected
                                </div>

                                <div class="text-xs text-slate-400 mt-0.5">
                                    Package orientation or impact event
                                </div>

                            </div>

                        </div>

                        <div class="flex bg-slate-50 border border-slate-200 rounded-lg p-0.5 gap-0.5">

                            <button class="px-2.5 py-1.5 rounded-md text-xs font-medium text-white
                                           bg-gradient-to-br from-[#4f7cff] to-[#8b5cf6]">
                                Email
                            </button>

                            <button class="px-2.5 py-1.5 rounded-md text-xs font-medium text-white
                                           bg-gradient-to-br from-[#4f7cff] to-[#8b5cf6]">
                                SMS
                            </button>

                            <button class="px-2.5 py-1.5 rounded-md text-xs font-medium text-slate-400">
                                Push
                            </button>

                        </div>

                    </div>


                    <!-- Delivered -->
                    <div class="flex items-center justify-between gap-4 py-4">

                        <div class="flex items-center gap-3">

                            <div class="w-8.5 h-8.5 rounded-[9px] bg-slate-50 border border-slate-200
                                        flex items-center justify-center shrink-0">

                                <svg class="w-4 h-4 text-slate-500"
                                     viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="1.8">

                                    <path d="M3 12h4l2-7 4 14 2-7h6"/>

                                </svg>

                            </div>

                            <div>

                                <div class="text-sm font-medium text-slate-900">
                                    Delivered or delayed
                                </div>

                                <div class="text-xs text-slate-400 mt-0.5">
                                    Status change on a tracked shipment
                                </div>

                            </div>

                        </div>

                        <div class="flex bg-slate-50 border border-slate-200 rounded-lg p-0.5 gap-0.5">

                            <button class="px-2.5 py-1.5 rounded-md text-xs font-medium text-white
                                           bg-gradient-to-br from-[#4f7cff] to-[#8b5cf6]">
                                Email
                            </button>

                            <button class="px-2.5 py-1.5 rounded-md text-xs font-medium text-slate-400">
                                SMS
                            </button>

                            <button class="px-2.5 py-1.5 rounded-md text-xs font-medium text-white
                                           bg-gradient-to-br from-[#4f7cff] to-[#8b5cf6]">
                                Push
                            </button>

                        </div>

                    </div>


                    <!-- Approval -->
                    <div class="flex items-center justify-between gap-4 py-4 last:pb-0">

                        <div class="flex items-center gap-3">

                            <div class="w-8.5 h-8.5 rounded-[9px] bg-slate-50 border border-slate-200
                                        flex items-center justify-center shrink-0">

                                <svg class="w-4 h-4 text-slate-500"
                                     viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="1.8">

                                    <path d="M9 12l2 2 4-4"/>
                                    <circle cx="12" cy="12" r="9"/>

                                </svg>

                            </div>

                            <div>

                                <div class="text-sm font-medium text-slate-900">
                                    Pending approval
                                </div>

                                <div class="text-xs text-slate-400 mt-0.5">
                                    A new shipment request is awaiting review
                                </div>

                            </div>

                        </div>

                        <div class="flex bg-slate-50 border border-slate-200 rounded-lg p-0.5 gap-0.5">

                            <button class="px-2.5 py-1.5 rounded-md text-xs font-medium text-white
                                           bg-gradient-to-br from-[#4f7cff] to-[#8b5cf6]">
                                Email
                            </button>

                            <button class="px-2.5 py-1.5 rounded-md text-xs font-medium text-slate-400">
                                SMS
                            </button>

                            <button class="px-2.5 py-1.5 rounded-md text-xs font-medium text-slate-400">
                                Push
                            </button>

                        </div>

                    </div>

                </div>


                <div class="flex justify-end gap-2.5 mt-6 pt-5 border-t border-slate-200">

                    <button class="px-4.5 py-2.5 rounded-lg text-sm font-medium text-slate-500
                                   border cursor-pointer border-slate-200 hover:bg-slate-50 hover:text-slate-900 transition">
                        Cancel
                    </button>

                    <button class="px-4.5 py-2.5 rounded-lg text-sm font-medium text-white
                                   bg-blue-600 cursor-pointer hover:bg-blue-700
                                   shadow-[0_4px_16px_-4px_rgba(79,124,255,0.4)]
                                   hover:-translate-y-0.5 transition">
                        Save preferences
                    </button>

                </div>

            </section>


            <!-- Alert thresholds -->
            <section id="thresholds"
                     class="scroll-mt-6 bg-white border border-slate-200 rounded-2xl p-7 shadow-sm">

                <div class="flex items-center gap-3.5 mb-6">

                    <div class="w-9 h-9 rounded-[11px] bg-gradient-to-br from-[#4f7cff] to-[#8b5cf6]
                                flex items-center justify-center shadow-[0_4px_18px_-4px_rgba(79,124,255,0.35)] shrink-0">

                        <svg class="w-4.5 h-4.5"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="white"
                             stroke-width="1.8">

                            <path d="M4 12h16M4 6h10M4 18h7"/>

                        </svg>

                    </div>

                    <div>

                        <h2 class="text-base font-semibold text-slate-900">
                            Alert thresholds
                        </h2>

                        <p class="text-[13px] text-slate-500 mt-0.5">
                            A shipment triggers an alert when a reading leaves the green band.
                        </p>

                    </div>

                </div>


                <!-- Temperature -->
                <div class="mb-7">

                    <div class="flex items-baseline justify-between mb-3">

                        <span class="flex items-center gap-2 text-[13.5px] font-medium text-slate-700">

                            <svg class="w-[15px] h-[15px] text-slate-400"
                                 viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="1.8">

                                <path d="M10 3h4v10.5a4 4 0 1 1-4 0V3Z"/>

                            </svg>

                            Temperature

                        </span>

                        <span class="text-[13px] text-slate-500">
                            <span class="text-slate-900 font-medium">2°C</span>
                            –
                            <span class="text-slate-900 font-medium">8°C</span>
                            · safe range
                        </span>

                    </div>

                    <div class="relative h-2 rounded-full bg-slate-100 border border-slate-200">

                        <div class="absolute -top-px -bottom-px rounded-full bg-green-500/30 border border-green-500/40"
                             style="left:28%; right:52%;">
                        </div>

                        <div class="absolute top-1/2 w-4 h-4 rounded-full bg-white border-[3px] border-green-500
                                    -translate-x-1/2 -translate-y-1/2 shadow"
                             style="left:28%;">
                        </div>

                        <div class="absolute top-1/2 w-4 h-4 rounded-full bg-white border-[3px] border-green-500
                                    -translate-x-1/2 -translate-y-1/2 shadow"
                             style="left:48%;">
                        </div>

                    </div>

                    <div class="flex justify-between mt-2 text-[11px] text-slate-400">
                        <span>−10°C</span>
                        <span>0°C</span>
                        <span>10°C</span>
                        <span>20°C</span>
                        <span>30°C</span>
                    </div>

                </div>


                <!-- Humidity -->
                <div class="mb-7">

                    <div class="flex items-baseline justify-between mb-3">

                        <span class="flex items-center gap-2 text-[13.5px] font-medium text-slate-700">

                            <svg class="w-[15px] h-[15px] text-slate-400"
                                 viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="1.8">

                                <circle cx="12" cy="12" r="8"/>
                                <path d="M12 8v4l3 2"/>

                            </svg>

                            Humidity

                        </span>

                        <span class="text-[13px] text-slate-500">
                            <span class="text-slate-900 font-medium">30%</span>
                            –
                            <span class="text-slate-900 font-medium">60%</span>
                            · safe range
                        </span>

                    </div>

                    <div class="relative h-2 rounded-full bg-slate-100 border border-slate-200">

                        <div class="absolute -top-px -bottom-px rounded-full bg-green-500/30 border border-green-500/40"
                             style="left:30%; right:40%;">
                        </div>

                        <div class="absolute top-1/2 w-4 h-4 rounded-full bg-white border-[3px] border-green-500
                                    -translate-x-1/2 -translate-y-1/2 shadow"
                             style="left:30%;">
                        </div>

                        <div class="absolute top-1/2 w-4 h-4 rounded-full bg-white border-[3px] border-green-500
                                    -translate-x-1/2 -translate-y-1/2 shadow"
                             style="left:60%;">
                        </div>

                    </div>

                    <div class="flex justify-between mt-2 text-[11px] text-slate-400">
                        <span>0%</span>
                        <span>25%</span>
                        <span>50%</span>
                        <span>75%</span>
                        <span>100%</span>
                    </div>

                </div>


                <!-- Tilt -->
                <div>

                    <div class="flex items-baseline justify-between mb-3">

                        <span class="flex items-center gap-2 text-[13.5px] font-medium text-slate-700">

                            <svg class="w-[15px] h-[15px] text-slate-400"
                                 viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="1.8">

                                <path d="M12 3l7 14H5l7-14Z"/>

                            </svg>

                            Max tilt angle

                        </span>

                        <span class="text-[13px] text-slate-500">
                            up to <span class="text-slate-900 font-medium">30°</span>
                        </span>

                    </div>

                    <div class="relative h-2 rounded-full bg-slate-100 border border-slate-200">

                        <div class="absolute -top-px -bottom-px rounded-full bg-green-500/30 border border-green-500/40"
                             style="left:0%; right:70%;">
                        </div>

                        <div class="absolute top-1/2 w-4 h-4 rounded-full bg-white border-[3px] border-green-500
                                    -translate-x-1/2 -translate-y-1/2 shadow"
                             style="left:30%;">
                        </div>

                    </div>

                    <div class="flex justify-between mt-2 text-[11px] text-slate-400">
                        <span>0°</span>
                        <span>25°</span>
                        <span>50°</span>
                        <span>75°</span>
                        <span>100°</span>
                    </div>

                </div>


                <div class="flex justify-end gap-2.5 mt-6 pt-5 border-t border-slate-200">

                    <button class="px-4.5 py-2.5 rounded-lg text-sm font-medium text-slate-500
                                   border cursor-pointer border-slate-200 hover:bg-slate-50 hover:text-slate-900 transition">
                        Reset to defaults
                    </button>

                    <button class="px-4.5 py-2.5 rounded-lg text-sm font-medium text-white
                                  bg-blue-600 cursor-pointer hover:bg-blue-700
                                   shadow-[0_4px_16px_-4px_rgba(79,124,255,0.4)]
                                   hover:-translate-y-0.5 transition">
                        Save thresholds
                    </button>

                </div>

            </section>


            <!-- Security -->
            <section id="security"
                     class="scroll-mt-6 bg-white border border-slate-200 rounded-2xl p-7 shadow-sm">

                <div class="flex items-center gap-3.5 mb-6">

                    <div class="w-9 h-9 rounded-[11px] bg-gradient-to-br from-[#4f7cff] to-[#8b5cf6]
                                flex items-center justify-center shadow-[0_4px_18px_-4px_rgba(79,124,255,0.35)] shrink-0">

                        <svg class="w-4.5 h-4.5"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="white"
                             stroke-width="1.8">

                            <path d="M12 3l7 3v6c0 4.5-3 7.5-7 9-4-1.5-7-4.5-7-9V6l7-3Z"/>

                        </svg>

                    </div>

                    <div>

                        <h2 class="text-base font-semibold text-slate-900">
                            Security
                        </h2>

                        <p class="text-[13px] text-slate-500 mt-0.5">
                            Update your password to keep your account secure.
                        </p>

                    </div>

                </div>


                <div class="flex items-start gap-2.5 px-3.5 py-3 rounded-lg
                            bg-amber-50 border border-amber-200
                            text-[12.5px] text-amber-700 mb-5">

                    <svg class="w-[15px] h-[15px] mt-0.5 shrink-0"
                         viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="1.8">

                        <path d="M12 9v4M12 17h.01"/>
                        <circle cx="12" cy="12" r="9"/>

                    </svg>

                    Your password was last changed 94 days ago.

                </div>


                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4.5 max-w-2xl">

                    <div class="sm:col-span-2">

                        <label class="block text-xs font-medium text-slate-500 mb-1.5">
                            Current password
                        </label>

                        <input type="password"
                               placeholder="••••••••"
                               class="w-full bg-slate-50 border border-slate-200 text-slate-900 rounded-lg
                                      px-3 py-2.5 text-sm focus:outline-none focus:border-blue-500
                                      focus:ring-2 focus:ring-blue-500/20 transition">

                    </div>

                    <div>

                        <label class="block text-xs font-medium text-slate-500 mb-1.5">
                            New password
                        </label>

                        <input type="password"
                               placeholder="••••••••"
                               class="w-full bg-slate-50 border border-slate-200 text-slate-900 rounded-lg
                                      px-3 py-2.5 text-sm focus:outline-none focus:border-blue-500
                                      focus:ring-2 focus:ring-blue-500/20 transition">

                    </div>

                    <div>

                        <label class="block text-xs font-medium text-slate-500 mb-1.5">
                            Confirm new password
                        </label>

                        <input type="password"
                               placeholder="••••••••"
                               class="w-full bg-slate-50 border border-slate-200 text-slate-900 rounded-lg
                                      px-3 py-2.5 text-sm focus:outline-none focus:border-blue-500
                                      focus:ring-2 focus:ring-blue-500/20 transition">

                    </div>

                </div>


                <div class="flex justify-end gap-2.5 mt-6 pt-5 border-t border-slate-200">

                    <button class="px-4.5 py-2.5 rounded-lg text-sm font-medium text-slate-500
                                   border cursor-pointer border-slate-200 hover:bg-slate-50 hover:text-slate-900 transition">
                        Cancel
                    </button>

                    <button class="px-4.5 py-2.5 rounded-lg text-sm font-medium text-white
                                   bg-blue-600 cursor-pointer hover:bg-blue-700
                                   shadow-[0_4px_16px_-4px_rgba(79,124,255,0.4)]
                                   hover:-translate-y-0.5 transition">
                        Update password
                    </button>

                </div>

            </section>

        </div>
    </div>

<div id="profileMessage" class="bg-green-500 text-sm fixed bottom-0 right-0 text-white p-4 rounded-lg m-4 hidden">
</div>

</x-layout>
