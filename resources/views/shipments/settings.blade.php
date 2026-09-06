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

        </form>
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

            <button
                id="deleteImage"
                type="button"
                title="Remove profile photo"
                class="absolute -right-2 -top-2 flex h-7 w-7 items-center justify-center rounded-full bg-white text-red-500 shadow-md ring-1 ring-red-100 transition hover:bg-red-50 hover:text-red-600 cursor-pointer"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="currentColor"
                    class="h-4 w-4"
                >
                    <path d="M9 3h6l1 2h4v2H4V5h4l1-2Zm-3 6h12l-1 11H7L6 9Zm3 2v7h2v-7H9Zm4 0v7h2v-7h-2Z"/>
                </svg>
            </button>
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
                   hover:-translate-y-0.5 cursor-pointer
                   active:translate-y-0"
        >
            Save changes
        </button>

    </div>

</form>
                    </div>
                

            </section>
        </div>
    </div>

<div id="profileMessage" class="bg-green-500 text-sm fixed bottom-0 right-0 text-white p-4 rounded-lg m-4 hidden">
</div>

</x-layout>
