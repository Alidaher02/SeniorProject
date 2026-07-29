window.addEventListener("load", () => {

    const loader = document.getElementById("pageLoader");
    const content = document.getElementById("pageContent");


    setTimeout(() => {

        loader.classList.add("opacity-0");

        content.classList.remove("opacity-0");
        content.classList.add("opacity-100");


        setTimeout(() => {
            loader.remove();
        }, 1000);

    }, 1000);

});

    




    const addDriver = document.getElementById("addDriver");
    const driverCard = document.getElementById("driverCard");
    const cancelBnt = document.getElementById("cancelBnt");
    const addCustomer = document.getElementById("addCustomer");
    const customerCard = document.getElementById("customerCard");
    const customerCancelBtn = document.getElementById("customerCancelBtn");
    const editBtn = document.querySelectorAll(".editBtn");
    const editModel = document.getElementById("editModel");
    const editClose = document.getElementById("editClose");
    const chatBtn = document.querySelectorAll(".chatBtn");
    const chatModel = document.getElementById("chatModel");
    const chatClose = document.getElementById("chatClose");
    


showModel(addDriver , cancelBnt , driverCard);
showModel(addCustomer , customerCancelBtn , customerCard);
showModel(editBtn , editClose , editModel);


   
function showModel(btn, cancel, card) {

    if (!btn || !cancel || !card) return;


    // Handle multiple buttons (NodeList or Array)
    if (btn.length) {

        btn.forEach(button => {
            button.addEventListener("click", () => {
                card.classList.remove("hidden");
            });
        });

    } else {

        btn.addEventListener("click", () => {
            card.classList.remove("hidden");
        });

    }


    cancel.addEventListener("click", () => {
        card.classList.add("hidden");
    });

}

 function loadStats() {
        fetch('/stats')
            .then(response => response.json())
            .then(data => {
                const stats = [
    'totalCustomers',
    'total',
    'in_transit',
    'pending',
    'approved',
    'delivered',
    'rejected'
];

stats.forEach(id => {
    if(document.getElementById(id)){
        document.getElementById(id).innerText = data[id];
    }
});
            });

}

loadStats();
setInterval(loadStats, 5000);


function loadAlerts() {

    fetch('/alerts')
        .then(response => response.json())
        .then(alerts => {

            let rows = '';

            alerts.forEach(alert => {

                rows += `
  <tr class="group border-b border-gray-100 bg-white transition-all hover:bg-slate-50">

    <!-- Alert Info -->
    <td class="px-6 py-6">

        <div class="flex items-center gap-4">

            <!-- Icon -->
            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-red-50 text-red-600 ring-1 ring-red-100">
                <i class="fa-solid fa-triangle-exclamation text-lg"></i>
            </div>


            <div class="max-w-xs">

                <h3 class="text-sm font-semibold text-slate-800">
                    ${alert.message}
                </h3>

                <div class="mt-1 flex items-center gap-2">

                    <span class="text-xs text-slate-400">
                        ${alert.type}
                    </span>

                    <span class="h-1 w-1 rounded-full bg-slate-300"></span>

                    <span class="text-xs text-slate-400">
                        Automatic Detection
                    </span>

                </div>

            </div>

        </div>

    </td>



    <!-- Shipment -->
    <td class="px-6 py-6">

        <div class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-slate-50 px-3 py-2">

            <i class="fa-solid fa-truck-fast text-slate-400"></i>

            <span class="text-xs font-semibold text-slate-700">
                ${alert.shipment['tracking-number']}
            </span>

        </div>

    </td>



    <!-- Temperature -->
    <td class="px-6 py-6">

        <div class="flex items-center gap-3">

            <div class="relative flex h-12 w-12 items-center justify-center rounded-2xl bg-red-50">

                <i class="fa-solid fa-temperature-high text-red-500"></i>

            </div>


            <div>

                <p class="text-lg font-bold text-red-600">
                    ${alert.shipment.sensor_readings?.at(-1)?.temperature ?? 'N/A'}°
                </p>

                <p class="text-xs text-slate-400">
                    Current temperature
                </p>

            </div>

        </div>

    </td>



    <!-- Severity -->
    <td class="px-6 py-6">

        <div class="inline-flex items-center gap-2 rounded-full border border-red-200 bg-red-50 px-4 py-2">

            <span class="relative flex h-2.5 w-2.5">

                <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-red-400 opacity-75"></span>

                <span class="relative inline-flex h-2.5 w-2.5 rounded-full bg-red-500"></span>

            </span>


            <span class="text-xs font-bold uppercase tracking-wide text-red-600">
                ${alert.severity}
            </span>

        </div>

    </td>



    <!-- Time -->
    <td class="px-6 py-6">

        <div>

            <p class="text-sm font-medium text-slate-700">
                ${alert.created_at}
            </p>

            <p class="mt-1 text-xs text-slate-400">
                Alert generated
            </p>

        </div>

    </td>



    <!-- Action -->
    <td class="px-6 py-6">

        <button
            class="
            inline-flex items-center gap-2
            rounded-xl
            bg-slate-900
            px-4 py-2.5
            text-xs font-semibold
            text-white
            shadow-sm
            transition-all
            hover:bg-slate-800
            hover:shadow-md
            ">

            <i class="fa-solid fa-arrow-right"></i>

            Details

        </button>

    </td>

</tr>
                `;
            });

            document.getElementById('alertsContainer').innerHTML = rows;

        });
}


loadAlerts();

setInterval(() => {
    loadAlerts();
}, 5000);