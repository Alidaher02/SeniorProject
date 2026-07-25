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


            <button id="addCustomer" class="cursor-pointer rounded-lg bg-blue-600 px-4 py-2 text-xs font-semibold text-white hover:bg-blue-700">
                + Add Customer
            </button>

        </div>



        <!-- Table -->
        <div class="p-5">

            <!-- Desktop -->
            <div class="hidden overflow-hidden rounded-xl border border-blue-100 md:block">

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

                            <form action="/admin/customers/{{ $customer->id }}" method="POST">

                                @csrf
                                @method('DELETE')

                                <button class="rounded-lg cursor-pointer border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-600 hover:bg-red-100">
                                    Delete
                                </button>

                            </form>

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



            <!-- Mobile Cards -->
            <div class="space-y-3 md:hidden">

                @forelse ($customers as $customer)

                <div class="rounded-xl border border-blue-100 bg-white p-4 shadow-sm">

                    <div class="flex items-start justify-between">

                        <div>

                            <h3 class="text-sm font-bold text-gray-800">
                                {{ $customer->name }}
                            </h3>

                            <p class="text-xs text-gray-400">
                                Customer
                            </p>

                        </div>


                        <span class="rounded-lg bg-green-50 px-3 py-1 text-xs font-semibold text-green-600">
                            Active
                        </span>

                    </div>


                    <div class="mt-4 space-y-3 text-sm">


                        <div>

                            <p class="text-xs text-gray-400">
                                Email
                            </p>

                            <p class="font-medium text-gray-700 break-all">
                                {{ $customer->email }}
                            </p>

                        </div>



                        <div>

                            <p class="text-xs text-gray-400">
                                Shipments
                            </p>

                            <span class="inline-block rounded-lg bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-600">
                                {{ $customer->shipments->count() }}
                            </span>

                        </div>



                        <form action="/admin/customers/{{ $customer->id }}" method="POST">

                            @csrf
                            @method('DELETE')

                            <button class="w-full rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-xs font-semibold text-red-600 hover:bg-red-100">
                                Delete
                            </button>

                        </form>


                    </div>


                </div>


                @empty

                <div class="rounded-xl border border-blue-100 p-5 text-center text-sm text-gray-400">
                    No customers found
                </div>

                @endforelse


            </div>

        </div>


    </div>

</div>


<div class="hidden" id="customerCard"> 
  <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4">

    <div class="w-full max-w-xl rounded-3xl bg-white shadow-2xl overflow-hidden">

        <div class="flex items-center justify-between bg-blue-600 px-6 py-5">

            <div class="flex items-center gap-3">

                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-white/20">
                    🚚
                </div>

                <div>
                    <h2 class="text-xl font-bold text-white">
                        Add Customer
                    </h2>

                    <p class="text-sm text-blue-100">
                        Create a new Customer account.
                    </p>
                </div>

            </div>

        </div>


        <form action="/admin/customers" method="POST" class="space-y-5 p-6">

            @csrf

            <div>
                <label class="mb-2 block text-sm font-semibold text-gray-700">
                    Customer Name
                </label>

                <input
                    type="text"
                    name="name"
                    placeholder="Enter Customer's name"
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                <x-forms.error name="name"/>
            </div>


            <div>
                <label class="mb-2 block text-sm font-semibold text-gray-700">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    placeholder="customer@email.com"
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                <x-forms.error name="email"/>
            </div>


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


            <div class="flex justify-end gap-3 pt-4">

                <button
                    type="button"
                    id="customerCancelBtn"
                    class="rounded-xl cursor-pointer border border-gray-300 px-5 py-2.5 font-medium text-gray-700 hover:bg-gray-100">

                    Cancel

                </button>


                <button
                    type="submit"
                    class="rounded-xl cursor-pointer bg-blue-600 px-6 py-2.5 font-semibold text-white transition hover:bg-blue-700">

                    Add Customer

                </button>

            </div>

        </form>

    </div>

</div>
</div>

</x-admin-layout>