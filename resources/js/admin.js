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
                <tr class="transition hover:bg-red-50/50">

                    <td class="px-5 py-4">
                        <p class="text-sm font-semibold text-gray-800">
                            ${alert.message}
                        </p>

                        <p class="text-xs text-gray-400">
                            ${alert.type}
                        </p>
                    </td>


                    <td class="px-5 py-4 text-sm font-medium text-red-600">
                        ${alert.shipment['tracking-number']}
                    </td>


                    <td class="px-5 py-4 text-sm text-gray-600">
                        ${alert.shipment.sensor_readings?.at(-1)?.temperature ?? 'N/A'} °C
                    </td>


                    <td class="px-5 py-4">

                        <span class="rounded-lg px-3 py-1 text-xs font-semibold bg-red-100 text-red-600">
                            ${alert.severity}
                        </span>

                    </td>


                    <td class="px-5 py-4 text-xs text-gray-600">
                       ${alert.created_at}
                    </td>


                    <td class="px-5 py-4">
                        <button class="rounded-lg border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-600 hover:bg-red-100">
                            View
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