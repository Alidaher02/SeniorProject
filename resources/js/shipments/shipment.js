import axios from "axios";

const container = document.getElementById("shipmentSContainer");

function getStatusClass(status) {

    return {
        approved: "bg-blue-100 text-blue-600",
        pending: "bg-yellow-100 text-yellow-600",
        in_transit: "bg-green-100 text-green-600",
        delivered: "bg-green-100 text-green-500",
        rejected: "bg-red-100 text-red-600"
    }[status] ?? "bg-gray-100 text-gray-600";

}
async function loadShipments() {
    try {
        const response = await axios.get('/shipments/load');
       const shipments = response.data.shipments;

        renderShipments(shipments);


    } catch (error) {
        console.error(error);
    }
}
if(container)
{
   loadShipments(); 
}


window.filterStatus = async function(status) {
    
    try {
        
        const response = await axios.get('/shipments/status' , {
            params: {
                status: status
            }
        });
        const shipments = response.data;
        container.innerHTML = "";

        renderShipments(shipments);

    } catch (error) {

        console.error(error);
    }
}


function renderShipments(shipments)
{
    container.innerHTML = "";

    if (!shipments || shipments.length === 0)
    {
        container.innerHTML = "No Shipments Availabe";
        return;
    }


    shipments.forEach(shipment => {

        const createdDate = new Date(shipment.created_at).toLocaleDateString("en-US", {
            month: "short",
            day: "numeric"
        });

        const updatedDate = new Date(shipment.updated_at).toLocaleTimeString("en-US", {
            hour: "2-digit",
            minute: "2-digit"
        });


        container.innerHTML += `

        <div class="w-full max-w-xs rounded-xl border border-gray-200 bg-white p-3.5 shadow-md">

            <div class="flex items-start justify-between">

                <span class="rounded-md px-2 py-0.5 text-[11px] font-semibold ${getStatusClass(shipment.status)}">
                    ${shipment.status}
                </span>

                <button class="text-gray-500 hover:text-gray-700">
                    ⋮
                </button>

            </div>


            <div class="mt-3 flex gap-3">

                <div class="flex h-14 w-14 items-center justify-center rounded-full bg-blue-100">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke-width="1.5"
                         stroke="currentColor"
                         class="h-7 w-7 text-blue-600">

                        <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M21 8.25 12 3 3 8.25m18 0V15.75L12 21m9-12.75L12 13.5M3 8.25V15.75L12 21m-9-12.75L12 13.5m0 7.5V13.5" />

                    </svg>

                </div>


                <div>

                    <h2 class="text-xl font-bold">
                        ${shipment['tracking-number']}
                    </h2>

                    <p class="text-xs text-gray-500">
                        ${shipment.product_name}
                    </p>

                </div>

            </div>


            <div class="mt-3 text-sm font-medium text-gray-700">
                ${shipment.origin}

                <span class="mx-2">
                    →
                </span>

                ${shipment.destination}
            </div>


            <hr class="my-3">


            <div class="grid grid-cols-3 gap-2">

                <div>
                    <p class="text-[11px] text-gray-500">
                        Temperature
                    </p>

                    <p class="mt-1 text-base font-bold text-blue-600">
                        ${shipment.min_temperature ?? '--'}°C
                    </p>
                </div>


                <div>
                    <p class="text-[11px] text-gray-500">
                        Humidity
                    </p>

                    <p class="mt-1 text-base font-bold">
                        ${shipment.min_humidity ?? '--'}%
                    </p>
                </div>


                <div>
                    <p class="text-[11px] text-gray-500">
                        Last Updated
                    </p>

                    <p class="mt-1 text-xs font-semibold">
                        ${updatedDate}
                    </p>
                </div>

            </div>


            <hr class="my-3">


            <div class="flex items-center justify-between">

                <span class="text-xs text-gray-500">
                    📅 ${createdDate}
                </span>


                <a href="/shipments/${shipment.id}"
                   class="rounded-lg border-2 border-blue-500 px-3 py-1 text-xs font-semibold text-blue-600 transition hover:bg-blue-600 hover:text-white">

                    View Details

                </a>

            </div>

        </div>

        `;

    });

}
