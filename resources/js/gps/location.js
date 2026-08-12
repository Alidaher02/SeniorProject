    // // Istanbul coordinates
    // const latitude = 33.8938;
    // const longitude = 35.5018;

    // Create map
    // const map = L.map('map').setView(
    //     [latitude, longitude],
    //     12
    // );

    // // OpenStreetMap tiles
    // L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {

    //     attribution: '&copy; OpenStreetMap contributors'

    // }).addTo(map);


    // // Current location marker
    // const marker = L.marker([
    //     latitude,
    //     longitude
    // ]).addTo(map);


    // marker.bindPopup(`
    //     <strong>Current Location</strong><br>
    //     Istanbul, Turkey
    // `);

    import axios from "axios";
    
let map;
let marker;

async function latest() {

    const mapContainer = document.getElementById("map");
    if (!mapContainer) {
        return;
    }

    const shipmentId = mapContainer.dataset.shipmentId;


    const response = await axios.get(`/gps/readings/${shipmentId}`);
  

    const reading = response.data.reading;

    const latitude = parseFloat(reading.latitude);
    const longitude = parseFloat(reading.longitude);
    address(shipmentId);

    if (!map) {

        map = L.map('map').setView(
            [latitude, longitude],
            14
        );

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        marker = L.marker([
            latitude,
            longitude
        ]).addTo(map);
        
    } else {

        map.setView([
            latitude,
            longitude
        ], 14);

        marker.setLatLng([
            latitude,
            longitude
        ]);
        
    }

    
}

async function address(shipmentId)
{
    try {

        const response = await axios.get(
            `/gps/address/${shipmentId}`
        );

        document.getElementById('location').textContent =
            response.data.location;

    } catch (error) {

        console.error('Unable to get address:', error);

    }
}
        latest(); 
        setInterval(() => {
            latest()
        }, 10000);
    

    