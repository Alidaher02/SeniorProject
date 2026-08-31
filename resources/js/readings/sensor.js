import axios from "axios";

async function loadReadings() {
    const elements = document.querySelectorAll('[data-shipment-id]');

    for (const element of elements) {
        const shipmentId = element.dataset.shipmentId;

        const response = await axios.get(`/shipments/${shipmentId}/sensor-reading`);

        const shipment = response.data.shipment;
        const reading = response.data;

        displayReading(reading, shipment);
    }
}   

loadReadings();
setInterval(() => {
    loadReadings()
}, 5000);

function displayReading(reading, shipment)
{

    const temperature = document.getElementById("temperature");
    const tempMessage = document.getElementById("tempMessage");
    const humidityMessage = document.getElementById("humidityMessage");
    const humidity = document.getElementById("humidity");
    const light = document.getElementById("light");
    const lightMessage = document.getElementById("lightMessage"); 
    const tilt = document.getElementById("tilt");
    const tiltMessage = document.getElementById("tiltMessage");   
    const humidityBar = document.getElementById("humidityBar");

    if(temperature)
    {
        temperature.textContent = reading.temperature ?? "--";

        if (reading.temperature > shipment.max_temperature + 10) {

            temperature.style.setProperty("color", "#dc2626", "important");

            tempMessage.innerHTML = `
                <span class="rounded-lg bg-red-100 px-2 py-1 text-[11px] font-semibold text-red-600">
                    Warning: High Temperature
                </span>
            `;

        } else if (reading.temperature > shipment.max_temperature) {

            temperature.style.setProperty("color", "#f97316", "important");

            tempMessage.innerHTML = `
                <span class="rounded-lg bg-orange-100 px-2 py-1 text-[11px] font-semibold text-orange-600">
                    High Temperature
                </span>
            `;

        } else if (reading.temperature < shipment.min_temperature) {

            temperature.style.setProperty("color", "#0891b2", "important");

            tempMessage.innerHTML = `
                <span class="rounded-lg bg-cyan-100 px-2 py-1 text-[11px] font-semibold text-cyan-600">
                    Low Temperature
                </span>
            `;

        } else {

            temperature.style.setProperty("color", "#16a34a", "important");

            tempMessage.innerHTML = `
                <span class="rounded-lg bg-green-100 px-2 py-1 text-[11px] font-semibold text-green-600">
                    Normal
                </span>
            `;
        }
    }

    if(humidity)
    {
        humidity.textContent = reading.humidity ?? "--";
    if (reading.humidity >  shipment.max_humidity  + 10) {

        humidity.style.setProperty("color", "#dc2626", "important"); // red-600

        humidityMessage.innerHTML = `
            <span class="rounded-lg bg-red-100 px-2 py-1 text-[11px] font-semibold text-red-600">
                Warning: High humidity
            </span>
        `;

        humidityBar.style.width = `${reading.humidity}%`;
        humidityBar.classList.add("bg-red-600");

    } else if (reading.humidity > shipment.max_humidity ) {

        humidity.style.setProperty("color", "#dc2626", "important"); // red-600

        humidityMessage.innerHTML = `
            <span class="rounded-lg bg-red-100 px-2 py-1 text-[11px] font-semibold text-red-600">
                High humidity
            </span>
        `;

        humidityBar.style.width = `${reading.humidity}%`;
        humidityBar.classList.remove(
            "bg-red-600",
            "bg-cyan-600",
            "bg-green-600"
        );        
        humidityBar.classList.add("bg-red-600");

    } else if (reading.humidity < shipment.min_humidity) {

        humidity.style.setProperty("color", "#0891b2", "important"); // cyan-600

        humidityMessage.innerHTML = `
            <span class="rounded-lg bg-cyan-100 px-2 py-1 text-[11px] font-semibold text-cyan-600">
                Low humidity
            </span>
        `;
        humidityBar.style.width = `${reading.humidity}%`;
        humidityBar.classList.remove(
            "bg-red-600",
            "bg-cyan-600",
            "bg-green-600"
        );
        humidityBar.classList.add("bg-cyan-600");
    } else {

        humidity.style.setProperty("color", "#16a34a", "important"); // green-600

        humidityMessage.innerHTML = `
            <span class="rounded-lg bg-green-100 px-2 py-1 text-[11px] font-semibold text-green-600">
                Normal
            </span>
        `;

        humidityBar.style.width = `${reading.humidity}%`;
        humidityBar.classList.remove(
            "bg-red-600",
            "bg-cyan-600",
            "bg-green-600"
        );
        humidityBar.classList.add("bg-green-600");
    }        
    }

    if(light)
    {
        light.textContent = reading.light ?? "--";

        if(reading.light < 500)
        {
            light.textContent = "Light Detected";
            light.style.setProperty("color", "#dc2626", "important");

            lightMessage.innerHTML = `
                <span class="rounded-lg bg-red-100 px-2 py-1 text-[11px] font-semibold text-red-600">
                    Light Detected
                </span>
            `;
        }
        else
        {
        light.textContent = "Normal";
        light.style.setProperty("color", "#16a34a", "important");

        lightMessage.innerHTML = `
            <span class="rounded-lg bg-green-100 px-2 py-1 text-[11px] font-semibold text-green-600">
                Normal Level
            </span>
        `;            
        }
    }

    if(tilt)
    {

        if(reading.tilt)
        {
            tilt.textContent = "Tilt Detected";
            tilt.style.setProperty("color", "#dc2626", "important");

            tiltMessage.innerHTML = `
                <span class="rounded-lg bg-red-100 px-2 py-1 text-[11px] font-semibold text-red-600">
                    Tilt Detected
                </span>
            `;
            
        }
        else
        {
            tilt.textContent = "Stable";
            tilt.style.setProperty("color", "#16a34a", "important");

            tiltMessage.innerHTML = `
                <span class="rounded-lg bg-green-100 px-2 py-1 text-[11px] font-semibold text-green-600">
                    Stable
                </span>
            `;
        }

    }

    const sensor = document.getElementById("sensor");

    if (sensor) {

        if (reading && reading.created_at) {

            sensor.innerHTML = `
                <span class="relative flex h-2 w-2">
                    <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-green-400 opacity-60"></span>
                    <span class="relative inline-flex h-2 w-2 rounded-full bg-green-500"></span>
                </span>

                <span class="text-xs font-semibold text-green-700">
                    Sensors Connected
                </span>
            `;

        }
    }


}
