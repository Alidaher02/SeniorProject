const stats = [
    'totalCustomers',
    'total',
    'in_transit',
    'pending',
    'approved',
    'delivered',
    'rejected',
    'alerts'

];

function loadStats() {
    fetch('/stats')
        .then(response => response.json())
        .then(data => {

            stats.forEach(id => {
                const element = document.getElementById(id);

                if(element){
                    element.innerText = data[id] ?? 0;
                }
            });

        })
        .catch(error => {
            console.error('Stats error:', error);
        });
}


// Only run if dashboard stats exist
if(document.getElementById('totalCustomers') || 
   document.getElementById('total'))
{
    loadStats();
    setInterval(loadStats, 5000);
}

