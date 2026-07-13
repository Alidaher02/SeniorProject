<x-admin-layout>

<div class="min-h-screen p-6">

    <div class="mx-auto max-w-6xl overflow-hidden rounded-2xl border border-blue-100 bg-white shadow-sm mt-5">


        <!-- Header -->
        <div class="flex items-center justify-between border-b border-blue-100 bg-blue-50 px-5 py-4">

            <div>
                <h1 class="text-lg font-bold text-gray-800">
                    Customers
                </h1>

                <p class="text-xs text-gray-400">
                    Manage your registered customers
                </p>
            </div>


            <button class="rounded-lg bg-blue-600 px-4 py-2 text-xs font-semibold text-white hover:bg-blue-700">
                + Add Customer
            </button>

        </div>



        <!-- Table -->
        <div class="p-5">

            <div class="overflow-hidden rounded-xl border border-blue-100">

                <table class="w-full text-left">


                    <thead class="bg-blue-50">

                        <tr>

                            <th class="px-5 py-3 text-xs font-semibold text-blue-600">
                                Customer
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

                       @forelse ($customers as $customer)

<tr class="transition hover:bg-blue-50/50">


    <td class="px-5 py-4">

        <div>

            <p class="text-sm font-semibold text-gray-800">
                {{ $customer->name }}
            </p>

            <p class="text-xs text-gray-400">
                Customer
            </p>

        </div>

    </td>




    <td class="px-5 py-4 text-sm text-gray-600">
        {{ $customer->email }}
    </td>




    <td class="px-5 py-4">

        <span class="rounded-lg bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-600">
            {{ $customer->shipments->count() }}
        </span>

    </td>




    <td class="px-5 py-4">

        <span class="rounded-lg bg-green-50 px-3 py-1 text-xs font-semibold text-green-600">
            Active
        </span>

    </td>




    <td class="px-5 py-4">

        <button class="rounded-lg border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-600 hover:bg-blue-100">
            Delete
        </button>

    </td>


</tr>


@empty

<tr>
    <td colspan="5" class="px-5 py-6 text-center text-sm text-gray-400">
        No customers found
    </td>
</tr>

@endforelse

                    </tbody>


                </table>

            </div>

        </div>


    </div>

</div>

</x-admin-layout>
