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


    const addDriver = document.getElementById("addDriver");
    const driverCard = document.getElementById("driverCard");
    const cancelBnt = document.getElementById("cancelBnt");
    const addCustomer = document.getElementById("addCustomer");
    const customerCard = document.getElementById("customerCard");
    const customerCancelBtn = document.getElementById("customerCancelBtn");

    showModel(addDriver , cancelBnt , driverCard);
    showModel(addCustomer , customerCancelBtn , customerCard);

   

 function showModel(btn, cancel , card){

    if (!btn || !cancel || !card) return;
    
    btn.addEventListener("click" , () => {
    card.classList.remove("hidden");
    });


    cancel.addEventListener("click", () => {
    card.classList.add("hidden");
    });

    }

    

