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
<tr class="border-b border-slate-100 hover:bg-slate-50 transition-colors">

    <!-- Alert -->
    <td class="px-4 py-3">
        <div class="flex items-center gap-3">

        <div class="flex h-9 w-9 items-center justify-center rounded-full bg-red-100">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-4 w-4 text-red-600"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2">

                <circle cx="12" cy="12" r="9"></circle>
                <path d="M12 7v6"></path>
                <circle cx="12" cy="17" r="1"></circle>

            </svg>
        </div>

            <div>
                <p class="text-sm font-semibold text-slate-800">
                    ${alert.message}
                </p>

                <div class="mt-0.5 flex items-center gap-2">

                    <span class="rounded-full bg-red-50 px-2 py-0.5 text-[10px] font-medium uppercase text-red-600">
                        ${alert.type}
                    </span>

                    <span class="text-[11px] text-slate-400">
                        Auto
                    </span>

                </div>
            </div>

        </div>
    </td>

    <!-- Shipment -->
    <td class="px-4 py-3">

        <div class="inline-flex items-center gap-2 rounded-lg bg-slate-100 px-3 py-1.5">

            <i class="fa-solid fa-truck-fast text-xs text-slate-500"></i>

            <span class="text-xs font-semibold text-slate-700">
                ${alert.shipment['tracking-number']}
            </span>

        </div>

    </td>

    <!-- Temperature -->
    <td class="px-4 py-3">

        <div class="flex items-center gap-2">

            <i class="fa-solid fa-temperature-high text-red-500"></i>

            <span class="text-lg font-bold text-red-600">
                ${alert.shipment.sensor_readings?.at(-1)?.temperature ?? 'N/A'}°
            </span>

        </div>

    </td>

    <!-- Severity -->
    <td class="px-4 py-3">

        <span class="inline-flex items-center gap-2 rounded-full bg-red-50 px-3 py-1">

            <span class="h-2 w-2 rounded-full bg-red-500 animate-pulse"></span>

            <span class="text-[11px] font-semibold uppercase text-red-600">
                ${alert.severity}
            </span>

        </span>

    </td>

    <!-- Time -->
    <td class="px-4 py-3">

        <span class="text-xs text-slate-500">
            ${alert.created_at}
        </span>

    </td>

</tr>
                `;
            });

            document.getElementById('alertsContainer').innerHTML = rows;

        });

    
}


loadAlerts();

setInterval(loadAlerts, 1000);

async function alertsCount() {
    
    let response = await fetch('/alerts/count');
    let data = await response.json();

    document.getElementById("alertsCount").textContent = data.count;
}

alertsCount();  
setInterval(alertsCount, 1000);