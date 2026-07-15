<x-admin-layout>    


<div class="min-h-screen p-6">

    <div class="mx-auto max-w-6xl overflow-hidden rounded-2xl border border-blue-100 bg-white shadow-sm mt-5">


        <!-- Header -->
        <div class="flex items-center justify-between border-b border-blue-100 bg-blue-50 px-5 py-4">

            <div>
                <h1 class="text-lg font-bold text-gray-800">
                    Drivers
                </h1>

                <p class="text-xs text-gray-400">
                    Manage your registered Drivers
                </p>
            </div>


            <button id="addDriver" class="cursor-pointer rounded-lg bg-blue-600 px-4 py-2 text-xs font-semibold text-white hover:bg-blue-700">
                + Add Driver
            </button>

        </div>



        <!-- Table -->
        <div class="p-5">

            <div class="overflow-hidden rounded-xl border border-blue-100">

                <table class="w-full text-left">


                    <thead class="bg-blue-50">

                        <tr>

                            <th class="px-5 py-3 text-xs font-semibold text-blue-600">
                                Driver
                            </th>


                            <th class="px-5 py-3 text-xs font-semibold text-blue-600">
                                Email
                            </th>


                            <th class="px-5 py-3 text-xs font-semibold text-blue-600">
                                Shipments
                            </th>


                            <th class="px-5 py-3 text-xs font-semibold text-blue-600">
                                Status
                            </th>


                            <th class="px-5 py-3 text-xs font-semibold text-blue-600">
                                Action
                            </th>


                        </tr>

                    </thead>




                    <tbody class="divide-y divide-blue-50">

                       @forelse ($drivers as $driver)

<tr class="transition hover:bg-blue-50/50">


    <td class="px-5 py-4">

        <div>

            <p class="text-sm font-semibold text-gray-800">
                {{ $driver->name }}
            </p>

            <p class="text-xs text-gray-400">
                driver
            </p>

        </div>

    </td>




    <td class="px-5 py-4 text-sm text-gray-600">
        {{ $driver->email }}
    </td>





    <td class="px-5 py-4">

        <span class="rounded-lg bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-600">
           {{ $driver->assigned_shipments_count }}
        </span>

    </td>

    <td class="px-5 py-4">

        <span class="rounded-lg bg-green-50 px-3 py-1 text-xs font-semibold text-green-600">
            Active
        </span>

    </td>




    <td class="px-5 py-4">


        <form action="/admin/drivers/{{ $driver->id }}" method="POST">
        @csrf
        @method('DELETE')
        <button class="rounded-lg cursor-pointer border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-600 hover:bg-blue-100">
            Delete
        </button>
        </form>

        

    </td>

@empty

<tr>
    <td colspan="5" class="px-5 py-6 text-center text-sm text-gray-400">
        No Drivers found
    </td>
</tr>

@endforelse

                    </tbody>


                </table>

            </div>

        </div>


    </div>

</div>

{{-- add driver card --}}
<div class="hidden" id="driverCard"> 
  <div
    
    class="fixed  inset-0 z-50 flex items-center justify-center bg-black/50 p-4"
>

    <div 
        class="w-full max-w-xl rounded-3xl bg-white shadow-2xl overflow-hidden">

        <!-- Header -->
        <div class="flex items-center justify-between bg-blue-600 px-6 py-5">
            <div class="flex items-center gap-3">

                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-white/20">
                    🚚
                </div>

                <div>
                    <h2 class="text-xl font-bold text-white">
                        Add Driver
                    </h2>

                    <p class="text-sm text-blue-100">
                        Create a new driver account.
                    </p>
                </div>

            </div>

        </div>

        <!-- Body -->
        <form action="/admin/drivers" method="POST" class="space-y-5 p-6">

            @csrf

            <!-- Name -->
            <div>
                <label class="mb-2 block text-sm font-semibold text-gray-700">
                    Driver Name
                </label>

                <input
                    type="text"
                    name="name"
                    placeholder="Enter driver's name"
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                <x-forms.error name="name"/>
            </div>

            <!-- Email -->
            <div>
                <label class="mb-2 block text-sm font-semibold text-gray-700">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    placeholder="driver@email.com"
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                <x-forms.error name="email"/>
            </div>

            <!-- Password -->
            <div>
                <label class="mb-2 block text-sm font-semibold text-gray-700">
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    placeholder="••••••••"
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                <x-forms.error name="password"/>
            </div>

            <!-- Buttons -->
            <div class="flex justify-end gap-3 pt-4">

                <button
                    type="button"
                   id="cancelBnt"
                    class="rounded-xl cursor-pointer border border-gray-300 px-5 py-2.5 font-medium text-gray-700 hover:bg-gray-100">

                    Cancel

                </button>

                <button
                    type="submit"
                    class="rounded-xl cursor-pointer bg-blue-600 px-6 py-2.5 font-semibold text-white transition hover:bg-blue-700">

                    + Add Driver

                </button>

            </div>

        </form>

    </div>

</div>  
</div>


</x-admin-layout>
