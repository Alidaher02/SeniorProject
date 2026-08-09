```blade
<x-admin-layout>

    {{-- Page Header --}}
    <div class="mb-8">
        <h1 class="text-2xl font-bold tracking-tight text-gray-900">
            Settings
        </h1>

        <p class="mt-1 text-sm text-gray-500">
            Manage your account settings and preferences.
        </p>
    </div>


    <div>
            <div class="w-full flex gap-5 rounded-xl border border-gray-200 bg-white p-2 shadow-sm">

            {{-- Account --}}
            <button
                type="button"
                class="flex w-full items-center gap-3 rounded-lg bg-blue-50 px-4 py-3 text-left text-sm font-semibold text-blue-600 transition"
            >
                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-100">
                    <i class="fa-solid fa-user text-xs"></i>
                </span>

                <span>Account</span>
            </button>


            {{-- Security --}}
            <button
                type="button"
                class="mt-1 flex w-full items-center gap-3 rounded-lg px-4 py-3 text-left text-sm font-medium text-gray-600 transition hover:bg-gray-50 hover:text-gray-900"
            >
                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-gray-50">
                    <i class="fa-solid fa-lock text-xs"></i>
                </span>

                <span>Security</span>
            </button>


            {{-- Notifications --}}
            <button
                type="button"
                class="mt-1 flex w-full items-center gap-3 rounded-lg px-4 py-3 text-left text-sm font-medium text-gray-600 transition hover:bg-gray-50 hover:text-gray-900"
            >
                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-gray-50">
                    <i class="fa-solid fa-bell text-xs"></i>
                </span>

                <span>Notifications</span>
            </button>


            {{-- Preferences --}}
            <button
                type="button"
                class="mt-1 flex w-full items-center gap-3 rounded-lg px-4 py-3 text-left text-sm font-medium text-gray-600 transition hover:bg-gray-50 hover:text-gray-900"
            >
                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-gray-50">
                    <i class="fa-solid fa-sliders text-xs"></i>
                </span>

                <span>Preferences</span>
            </button>

        </div>   
    </div>


    <div class="flex flex-col gap-6 lg:grid-cols-3 w-full mt-5  ">

        {{-- Settings Navigation --}}



        {{-- Settings Content --}}
        <div class="min-w-0 space-y-6 lg:col-span-2">


            {{-- Account Information --}}
            <div class="overflow-hidden rounded-xl w-full border border-gray-200 bg-white shadow-sm">

                {{-- Header --}}
                <div class="border-b border-gray-100 px-6 py-5">

                    <h2 class="text-lg font-semibold text-gray-900">
                        Account Information
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Update your personal account information.
                    </p>

                </div>


                {{-- Body --}}
                <div class="space-y-5 p-6">

                    {{-- Name --}}
                    <div>

                        <label
                            for="name"
                            class="mb-2 block text-sm font-medium text-gray-700"
                        >
                            Full Name
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ auth()->user()->name }}"
                            class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 hover:border-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                        >

                    </div>


                    {{-- Email --}}
                    <div>

                        <label
                            for="email"
                            class="mb-2 block text-sm font-medium text-gray-700"
                        >
                            Email Address
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ auth()->user()->email }}"
                            class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 hover:border-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                        >

                    </div>


                    {{-- Role --}}
                    <div>

                        <label class="mb-2 block text-sm font-medium text-gray-700">
                            Role
                        </label>

                        <span class="inline-flex items-center rounded-full bg-blue-50 px-3 py-1.5 text-xs font-semibold text-blue-600">
                            {{ auth()->user()->role }}
                        </span>

                    </div>

                </div>


                {{-- Footer --}}
                <div class="flex items-center justify-end border-t border-gray-100 px-6 py-4">

                    <button
                        type="button"
                        class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 hover:shadow"
                    >
                        Save Changes
                    </button>

                </div>

            </div>


            {{-- Change Password --}}
            <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">

                {{-- Header --}}
                <div class="border-b border-gray-100 px-6 py-5">

                    <h2 class="text-lg font-semibold text-gray-900">
                        Change Password
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Keep your account secure by using a strong password.
                    </p>

                </div>


                {{-- Body --}}
                <div class="space-y-5 p-6">

                    {{-- Current Password --}}
                    <div>

                        <label
                            for="current_password"
                            class="mb-2 block text-sm font-medium text-gray-700"
                        >
                            Current Password
                        </label>

                        <input
                            type="password"
                            id="current_password"
                            placeholder="Enter current password"
                            class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 hover:border-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                        >

                    </div>


                    {{-- New Password --}}
                    <div>

                        <label
                            for="password"
                            class="mb-2 block text-sm font-medium text-gray-700"
                        >
                            New Password
                        </label>

                        <input
                            type="password"
                            id="password"
                            placeholder="Enter new password"
                            class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 hover:border-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                        >

                    </div>


                    {{-- Confirm Password --}}
                    <div>

                        <label
                            for="password_confirmation"
                            class="mb-2 block text-sm font-medium text-gray-700"
                        >
                            Confirm New Password
                        </label>

                        <input
                            type="password"
                            id="password_confirmation"
                            placeholder="Confirm new password"
                            class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 hover:border-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                        >

                    </div>

                </div>


                {{-- Footer --}}
                <div class="flex items-center justify-end border-t border-gray-100 px-6 py-4">

                    <button
                        type="button"
                        class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 hover:shadow"
                    >
                        Update Password
                    </button>

                </div>

            </div>


            {{-- Danger Zone --}}
            <div class="overflow-hidden rounded-xl border border-red-200 bg-white shadow-sm">

                {{-- Header --}}
                <div class="border-b border-red-100 bg-red-50/30 px-6 py-5">

                    <h2 class="text-lg font-semibold text-red-600">
                        Danger Zone
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        These actions can permanently affect your account.
                    </p>

                </div>


                {{-- Body --}}
                <div class="flex flex-col gap-5 p-6 sm:flex-row sm:items-center sm:justify-between">

                    <div class="min-w-0">

                        <h3 class="text-sm font-semibold text-gray-800">
                            Delete Account
                        </h3>

                        <p class="mt-1 max-w-xl text-sm leading-5 text-gray-500">
                            Permanently delete your account and all associated data.
                        </p>

                    </div>


                    <button
                        type="button"
                        class="shrink-0 rounded-lg border border-red-200 px-4 py-2.5 text-sm font-semibold text-red-600 transition hover:border-red-300 hover:bg-red-50"
                    >
                        Delete Account
                    </button>

                </div>

            </div>

        </div>

    </div>

</x-admin-layout>
```
