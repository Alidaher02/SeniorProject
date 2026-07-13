document.addEventListener("DOMContentLoaded", function () {

    
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

});

