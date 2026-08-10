import axios from "axios";
document.addEventListener("DOMContentLoaded", function () {

const container = document.getElementById("AlertsContainer");

if (!container) {
        return;
}
window.alerts = async function() {
    try {
    const response = await axios.get('/alerts?status=active');
    const alerts = response.data.alerts;
    renderAlerts(alerts); 
    countAlerts();      
    } catch (error) {
    console.error(error);
    }

}

function renderAlerts(alerts)
{

container.innerHTML = "";

if(! alerts || alerts.length == 0)
{
        container.innerHTML = `
            <div class="rounded-xl border border-slate-200 bg-white p-6 text-center text-slate-400">
                No alerts at the moment
            </div>
        `;
        return;
}

container.innerHTML = "";

    alerts.forEach(alert => { 

        const shipment = alert.shipment;

        const readings = shipment.sensor_readings ?? [];

        const reading = readings.length > 0 
            ? readings[readings.length - 1]
            : null;

        if(alert.type == "temperature_high") 
        {
            HighTempAlerts(alert , shipment, reading);
        }
        if(alert.type == "temperature_low")
        {
            LowTempAlerts(alert , shipment , reading);
        }
        if(alert.type == "tilt")
        {
            tiltAlert(alert , shipment , reading);
        }
        if(alert.type == "light")
        {
            lightAlert(alert , shipment , reading);
        }
        if(alert.type == "humidity_high")
        {
            highHumidity(alert, shipment , reading);
        }
        if(alert.type == "humidity_low")
        {
            LowHumidity(alert, shipment , reading);
        }

    });

}
function timeAgo(date)
{
    const seconds = Math.floor(
        (new Date() - new Date(date)) / 1000
    );


    if(seconds < 60)
    {
        return seconds + "s";
    }


    if(seconds < 3600)
    {
        return Math.floor(seconds / 60) + "m";
    }


    if(seconds < 86400)
    {
        return Math.floor(seconds / 3600) + "h";
    }


    return Math.floor(seconds / 86400) + "d";
}
function HighTempAlerts(alert , shipment ,reading)
{
    
    



    container.innerHTML += `

<div class="flex flex-col overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm md:flex-row">

    <!-- severity spine -->
    <div class="flex shrink-0 items-center justify-center gap-2 bg-red-50 px-3 py-2 md:w-11 md:flex-col md:py-4">

        <i class="fa-solid fa-temperature-high text-red-500"></i>

        <span class="font-mono text-[10px] font-bold uppercase tracking-widest text-red-500 md:[writing-mode:vertical-rl] md:rotate-180">
            ${alert.severity}
        </span>

    </div>


    <!-- body -->
    <div class="flex-1 p-5">

        <div class="flex flex-wrap items-start justify-between gap-3">

            <div>

                <div class="flex items-center gap-2">

                    <h3 class="text-sm font-bold text-slate-900">
                        ${alert.message}
                    </h3>

                    <span class="rounded bg-slate-100 px-1.5 py-0.5 font-mono text-[10px] text-slate-500">
                        #${alert.id}
                    </span>

                </div>


                <p class="mt-1 font-mono text-[11px] text-slate-400">
                    ${shipment.product_name}
                    · ${shipment.origin}
                    &rarr;
                    ${shipment.destination}
                </p>


            </div>


            <div class="h-6 w-16 opacity-40"
            style="background-image: repeating-linear-gradient(90deg, currentColor 0 1px, transparent 1px 2px, currentColor 3px 5px, transparent 5px 7px, currentColor 7px 8px, transparent 8px 10px); color: #94a3b8;">
            </div>


        </div>



        <div class="mt-4 grid gap-3 md:grid-cols-[1fr_1fr_1.2fr]">


            <div>

                <p class="font-mono text-[10px] uppercase tracking-wider text-slate-400">
                    Reading
                </p>


                <p class="mt-1 font-mono text-2xl font-bold text-red-500">

                    ${reading?.temperature ?? "--"}

                    <span class="text-sm text-red-500/50">
                        °C
                    </span>

                </p>


                <p class="font-mono text-[11px] text-slate-400">

                    Range 
                    ${shipment.min_temperature}
                    -
                    ${shipment.max_temperature}°C

                </p>


            </div>




            <div>

                <p class="font-mono text-[10px] uppercase tracking-wider text-slate-400">
                    Duration
                </p>


                <p class="mt-1 font-mono text-lg font-bold text-slate-900">

                    ${timeAgo(alert.created_at)}

                </p>


                <p class="font-mono text-[11px] text-slate-400">

                    Since ${new Date(alert.created_at).toLocaleTimeString()}

                </p>


            </div>




            <div>

                <p class="font-mono text-[10px] uppercase tracking-wider text-slate-400">
                    Excursion level
                </p>


                <div class="mt-2 flex gap-1">

                    ${Array(6).fill(`
                        <div class="h-4 flex-1 rounded-sm bg-red-500"></div>
                    `).join("")}

                </div>


                <p class="mt-1 font-mono text-[11px] text-red-500">
                    6 / 6 · escalate now
                </p>


            </div>


        </div>




        <div class="mt-4 flex flex-wrap items-center justify-between gap-3 border-t border-dashed border-slate-200 pt-3">


            <p class="font-mono text-[11px] text-slate-400">

                ${timeAgo(alert.created_at)}

            </p>



            <div class="flex gap-2">


                <a href="/shipments/${shipment.id}"
                class="rounded border border-slate-200 px-3 py-1.5 font-mono text-[11px] uppercase tracking-wide text-slate-500 transition hover:border-slate-300 hover:text-slate-800">

                    View

                </a>



                <button
                class="rounded bg-emerald-500 px-3 py-1.5 font-mono text-[11px] font-bold uppercase tracking-wide text-white transition hover:bg-emerald-600">

                    Resolve

                </button>


            </div>


        </div>



    </div>

</div>

        `; 



}
function LowTempAlerts(alert, shipment, reading)
{

container.innerHTML += `

<div class="flex flex-col overflow-hidden rounded-lg border border-cyan-200 bg-white shadow-sm md:flex-row">


    <!-- severity spine -->
    <div class="flex shrink-0 items-center justify-center gap-2 bg-cyan-50 px-3 py-2 md:w-11 md:flex-col md:py-4">


        <i class="fa-solid fa-snowflake text-cyan-500"></i>


        <span class="font-mono text-[10px] font-bold uppercase tracking-widest text-cyan-500 md:[writing-mode:vertical-rl] md:rotate-180">

            ${alert.severity}

        </span>


    </div>





    <!-- body -->
    <div class="flex-1 p-5">



        <div class="flex flex-wrap items-start justify-between gap-3">


            <div>


                <div class="flex items-center gap-2">


                    <h3 class="text-sm font-bold text-slate-900">

                        ${alert.message}

                    </h3>



                    <span class="rounded bg-cyan-50 px-1.5 py-0.5 font-mono text-[10px] text-cyan-600">

                        #${alert.id}

                    </span>


                </div>





                <p class="mt-1 font-mono text-[11px] text-slate-400">

                    ${shipment.product_name}
                    · ${shipment.origin}
                    &rarr;
                    ${shipment.destination}

                </p>


            </div>





            <!-- barcode -->
            <div class="h-6 w-16 opacity-40"
            style="background-image: repeating-linear-gradient(90deg, currentColor 0 1px, transparent 1px 2px, currentColor 3px 5px, transparent 5px 7px, currentColor 7px 8px, transparent 8px 10px); color:#94a3b8;">
            </div>



        </div>








        <div class="mt-4 grid gap-3 md:grid-cols-[1fr_1fr_1.2fr]">





            <!-- Temperature -->
            <div>


                <p class="font-mono text-[10px] uppercase tracking-wider text-slate-400">

                    Temperature

                </p>




                <p class="mt-1 font-mono text-2xl font-bold text-cyan-500">

                    ${reading?.temperature ?? "--"}

                    <span class="text-sm text-cyan-500/50">

                        °C

                    </span>

                </p>





                <p class="font-mono text-[11px] text-slate-400">

                    Safe range 
                    ${shipment.min_temperature}
                    -
                    ${shipment.max_temperature}°C

                </p>


            </div>







            <!-- Duration -->
            <div>


                <p class="font-mono text-[10px] uppercase tracking-wider text-slate-400">

                    Duration

                </p>




                <p class="mt-1 font-mono text-lg font-bold text-slate-900">

                    ${timeAgo(alert.created_at)}

                </p>




                <p class="font-mono text-[11px] text-slate-400">

                    Since ${new Date(alert.created_at).toLocaleTimeString()}

                </p>


            </div>








            <!-- Cold Risk -->
            <div>


                <p class="font-mono text-[10px] uppercase tracking-wider text-slate-400">

                    Freezing Risk

                </p>





                <div class="mt-2 flex gap-1">


                    ${Array(6).fill(`

                        <div class="h-4 flex-1 rounded-sm bg-cyan-500"></div>

                    `).join("")}


                </div>





                <p class="mt-1 font-mono text-[11px] text-cyan-500">

                    6 / 6 · freezing danger

                </p>


            </div>



        </div>









        <div class="mt-4 flex flex-wrap items-center justify-between gap-3 border-t border-dashed border-slate-200 pt-3">



            <p class="font-mono text-[11px] text-slate-400">

                ${timeAgo(alert.created_at)}

            </p>





            <div class="flex gap-2">



                <a href="/shipments/${shipment.id}"

                class="rounded border border-slate-200 px-3 py-1.5 font-mono text-[11px] uppercase tracking-wide text-slate-500 transition hover:border-slate-300 hover:text-slate-800">

                    View

                </a>





                <button

                class="rounded bg-emerald-500 px-3 py-1.5 font-mono text-[11px] font-bold uppercase tracking-wide text-white transition hover:bg-emerald-600">

                    Resolve

                </button>



            </div>


        </div>




    </div>


</div>


`;

}
function tiltAlert(alert, shipment, reading)
{

container.innerHTML += `

<div class="flex flex-col overflow-hidden rounded-lg border border-orange-200 bg-white shadow-sm md:flex-row">

    <!-- severity spine -->
    <div class="flex shrink-0 items-center justify-center gap-2 bg-orange-50 px-3 py-2 md:w-11 md:flex-col md:py-4">

        <i class="fa-solid fa-box-open text-orange-500"></i>

        <span class="font-mono text-[10px] font-bold uppercase tracking-widest text-orange-500 md:[writing-mode:vertical-rl] md:rotate-180">
            ${alert.severity}
        </span>

    </div>



    <!-- body -->
    <div class="flex-1 p-5">


        <div class="flex flex-wrap items-start justify-between gap-3">


            <div>


                <div class="flex items-center gap-2">


                    <h3 class="text-sm font-bold text-slate-900">
                        ${alert.message}
                    </h3>


                    <span class="rounded bg-slate-100 px-1.5 py-0.5 font-mono text-[10px] text-slate-500">
                        #${alert.id}
                    </span>


                </div>



                <p class="mt-1 font-mono text-[11px] text-slate-400">

                    ${shipment.product_name}
                    · ${shipment.origin}
                    &rarr;
                    ${shipment.destination}

                </p>


            </div>




            <!-- barcode -->
            <div class="h-6 w-16 opacity-40"
            style="background-image: repeating-linear-gradient(90deg, currentColor 0 1px, transparent 1px 2px, currentColor 3px 5px, transparent 5px 7px, currentColor 7px 8px, transparent 8px 10px); color: #94a3b8;">
            </div>


        </div>





        <div class="mt-4 grid gap-3 md:grid-cols-[1fr_1fr_1.2fr]">



            <!-- Tilt Reading -->
            <div>


                <p class="font-mono text-[10px] uppercase tracking-wider text-slate-400">
                    Sensor Status
                </p>



                <p class="mt-1 font-mono text-2xl font-bold text-orange-500">

                    ${reading?.tilt == 1 ? "Detected" : "Normal"}

                </p>



                <p class="font-mono text-[11px] text-slate-400">

                    Physical movement detected

                </p>


            </div>





            <!-- Duration -->
            <div>


                <p class="font-mono text-[10px] uppercase tracking-wider text-slate-400">
                    Duration
                </p>



                <p class="mt-1 font-mono text-lg font-bold text-slate-900">

                    ${timeAgo(alert.created_at)}

                </p>



                <p class="font-mono text-[11px] text-slate-400">

                    Since ${new Date(alert.created_at).toLocaleTimeString()}

                </p>


            </div>







            <!-- Risk Level -->
            <div>


                <p class="font-mono text-[10px] uppercase tracking-wider text-slate-400">
                    Movement Risk
                </p>



                <div class="mt-2 flex gap-1">


                    ${Array(6).fill(`
                        <div class="h-4 flex-1 rounded-sm bg-orange-500"></div>
                    `).join("")}


                </div>




                <p class="mt-1 font-mono text-[11px] text-orange-500">

                    6 / 6 · inspect shipment

                </p>


            </div>



        </div>







        <div class="mt-4 flex flex-wrap items-center justify-between gap-3 border-t border-dashed border-slate-200 pt-3">



            <p class="font-mono text-[11px] text-slate-400">

                ${timeAgo(alert.created_at)}

            </p>





            <div class="flex gap-2">



                <a href="/shipments/${shipment.id}"

                class="rounded border border-slate-200 px-3 py-1.5 font-mono text-[11px] uppercase tracking-wide text-slate-500 transition hover:border-slate-300 hover:text-slate-800">

                    View

                </a>




                <button

                class="rounded bg-emerald-500 px-3 py-1.5 font-mono text-[11px] font-bold uppercase tracking-wide text-white transition hover:bg-emerald-600">

                    Resolve

                </button>




            </div>


        </div>



    </div>


</div>


`;

}
function lightAlert(alert, shipment, reading)
{

container.innerHTML += `

<div class="flex flex-col overflow-hidden rounded-lg border border-yellow-200 bg-white shadow-sm md:flex-row">


    <!-- severity spine -->
    <div class="flex shrink-0 items-center justify-center gap-2 bg-yellow-50 px-3 py-2 md:w-11 md:flex-col md:py-4">


        <i class="fa-solid fa-sun text-yellow-500"></i>


        <span class="font-mono text-[10px] font-bold uppercase tracking-widest text-yellow-500 md:[writing-mode:vertical-rl] md:rotate-180">

            ${alert.severity}

        </span>


    </div>





    <!-- body -->
    <div class="flex-1 p-5">


        <div class="flex flex-wrap items-start justify-between gap-3">


            <div>


                <div class="flex items-center gap-2">


                    <h3 class="text-sm font-bold text-slate-900">

                        ${alert.message}

                    </h3>



                    <span class="rounded bg-slate-100 px-1.5 py-0.5 font-mono text-[10px] text-slate-500">

                        #${alert.id}

                    </span>


                </div>





                <p class="mt-1 font-mono text-[11px] text-slate-400">

                    ${shipment.product_name}
                    · ${shipment.origin}
                    &rarr;
                    ${shipment.destination}

                </p>


            </div>





            <!-- barcode -->
            <div class="h-6 w-16 opacity-40"
            style="background-image: repeating-linear-gradient(90deg, currentColor 0 1px, transparent 1px 2px, currentColor 3px 5px, transparent 5px 7px, currentColor 7px 8px, transparent 8px 10px); color: #94a3b8;">
            </div>


        </div>








        <div class="mt-4 grid gap-3 md:grid-cols-[1fr_1fr_1.2fr]">



            <!-- Light Reading -->
            <div>


                <p class="font-mono text-[10px] uppercase tracking-wider text-slate-400">

                    Light Level

                </p>




                <p class="mt-1 font-mono text-2xl font-bold text-yellow-500">

                    ${reading?.light ?? "--"}

                    <span class="text-sm text-yellow-500/50">

                        lux

                    </span>


                </p>




                <p class="font-mono text-[11px] text-slate-400">

                    Possible shipment exposure

                </p>


            </div>







            <!-- Duration -->
            <div>


                <p class="font-mono text-[10px] uppercase tracking-wider text-slate-400">

                    Duration

                </p>




                <p class="mt-1 font-mono text-lg font-bold text-slate-900">

                    ${timeAgo(alert.created_at)}

                </p>





                <p class="font-mono text-[11px] text-slate-400">

                    Since ${new Date(alert.created_at).toLocaleTimeString()}

                </p>


            </div>








            <!-- Exposure Risk -->
            <div>


                <p class="font-mono text-[10px] uppercase tracking-wider text-slate-400">

                    Exposure Level

                </p>




                <div class="mt-2 flex gap-1">


                    ${Array(6).fill(`

                        <div class="h-4 flex-1 rounded-sm bg-yellow-500"></div>

                    `).join("")}


                </div>





                <p class="mt-1 font-mono text-[11px] text-yellow-500">

                    6 / 6 · inspect shipment

                </p>


            </div>




        </div>









        <div class="mt-4 flex flex-wrap items-center justify-between gap-3 border-t border-dashed border-slate-200 pt-3">



            <p class="font-mono text-[11px] text-slate-400">

                ${timeAgo(alert.created_at)}

            </p>






            <div class="flex gap-2">





                <a href="/shipments/${shipment.id}"

                class="rounded border border-slate-200 px-3 py-1.5 font-mono text-[11px] uppercase tracking-wide text-slate-500 transition hover:border-slate-300 hover:text-slate-800">

                    View

                </a>






                <button

                class="rounded bg-emerald-500 px-3 py-1.5 font-mono text-[11px] font-bold uppercase tracking-wide text-white transition hover:bg-emerald-600">


                    Resolve


                </button>





            </div>



        </div>




    </div>


</div>


`;

}
function highHumidity(alert , shipment, reading)
{
    container.innerHTML += `

<div class="flex flex-col overflow-hidden rounded-lg border border-blue-200 bg-white shadow-sm md:flex-row">

    <!-- severity spine -->
    <div class="flex shrink-0 items-center justify-center gap-2 bg-blue-50 px-3 py-2 md:w-11 md:flex-col md:py-4">

        <i class="fa-solid fa-droplet text-blue-500"></i>

        <span class="font-mono text-[10px] font-bold uppercase tracking-widest text-blue-500 md:[writing-mode:vertical-rl] md:rotate-180">
            ${alert.severity}
        </span>

    </div>



    <!-- body -->
    <div class="flex-1 p-5">


        <div class="flex flex-wrap items-start justify-between gap-3">


            <div>


                <div class="flex items-center gap-2">


                    <h3 class="text-sm font-bold text-slate-900">
                        ${alert.message}
                    </h3>


                    <span class="rounded bg-blue-50 px-1.5 py-0.5 font-mono text-[10px] text-blue-600">
                        #${alert.id}
                    </span>


                </div>



                <p class="mt-1 font-mono text-[11px] text-slate-400">

                    ${shipment.product_name}
                    · ${shipment.origin}
                    &rarr;
                    ${shipment.destination}

                </p>


            </div>




            <!-- barcode -->
            <div class="h-6 w-16 opacity-40"
            style="background-image: repeating-linear-gradient(90deg, currentColor 0 1px, transparent 1px 2px, currentColor 3px 5px, transparent 5px 7px, currentColor 7px 8px, transparent 8px 10px); color: #94a3b8;">
            </div>


        </div>





        <div class="mt-4 grid gap-3 md:grid-cols-[1fr_1fr_1.2fr]">



            <!-- Humidity Reading -->
            <div>


                <p class="font-mono text-[10px] uppercase tracking-wider text-slate-400">
                    Humidity Level
                </p>



                <p class="mt-1 font-mono text-2xl font-bold text-blue-500">

                    ${reading?.humidity ?? "--"}

                    <span class="text-sm text-blue-500/50">
                        %
                    </span>

                </p>



                <p class="font-mono text-[11px] text-slate-400">

                    Maximum allowed humidity
                    ${shipment.max_humidity ?? "--"}%

                </p>


            </div>







            <!-- Duration -->
            <div>


                <p class="font-mono text-[10px] uppercase tracking-wider text-slate-400">
                    Duration
                </p>



                <p class="mt-1 font-mono text-lg font-bold text-slate-900">

                    ${timeAgo(alert.created_at)}

                </p>



                <p class="font-mono text-[11px] text-slate-400">

                    Since ${new Date(alert.created_at).toLocaleTimeString()}

                </p>


            </div>









            <!-- Moisture Risk -->
            <div>


                <p class="font-mono text-[10px] uppercase tracking-wider text-slate-400">
                    Moisture Risk
                </p>



                <div class="mt-2 flex gap-1">


                    ${Array(6).fill(`

                        <div class="h-4 flex-1 rounded-sm bg-blue-500"></div>

                    `).join("")}


                </div>




                <p class="mt-1 font-mono text-[11px] text-blue-500">

                    6 / 6 · humidity danger

                </p>


            </div>



        </div>









        <div class="mt-4 flex flex-wrap items-center justify-between gap-3 border-t border-dashed border-slate-200 pt-3">



            <p class="font-mono text-[11px] text-slate-400">

                ${timeAgo(alert.created_at)}

            </p>





            <div class="flex gap-2">



                <a href="/shipments/${shipment.id}"

                class="rounded border border-slate-200 px-3 py-1.5 font-mono text-[11px] uppercase tracking-wide text-slate-500 transition hover:border-slate-300 hover:text-slate-800">

                    View

                </a>





                <button

                class="rounded bg-emerald-500 px-3 py-1.5 font-mono text-[11px] font-bold uppercase tracking-wide text-white transition hover:bg-emerald-600">

                    Resolve

                </button>




            </div>


        </div>



    </div>


</div>


`;
}
function LowHumidity(alert, shipment, reading)
{
    container.innerHTML += `

<div class="flex flex-col overflow-hidden rounded-lg border border-purple-200 bg-white shadow-sm md:flex-row">


    <!-- severity spine -->
    <div class="flex shrink-0 items-center justify-center gap-2 bg-purple-50 px-3 py-2 md:w-11 md:flex-col md:py-4">

        <i class="fa-solid fa-droplet-slash text-purple-500"></i>

        <span class="font-mono text-[10px] font-bold uppercase tracking-widest text-purple-500 md:[writing-mode:vertical-rl] md:rotate-180">
            ${alert.severity}
        </span>

    </div>



    <!-- body -->
    <div class="flex-1 p-5">


        <div class="flex flex-wrap items-start justify-between gap-3">


            <div>


                <div class="flex items-center gap-2">


                    <h3 class="text-sm font-bold text-slate-900">
                        ${alert.message}
                    </h3>


                    <span class="rounded bg-purple-50 px-1.5 py-0.5 font-mono text-[10px] text-purple-600">
                        #${alert.id}
                    </span>


                </div>



                <p class="mt-1 font-mono text-[11px] text-slate-400">

                    ${shipment.product_name}
                    · ${shipment.origin}
                    &rarr;
                    ${shipment.destination}

                </p>


            </div>




            <!-- barcode -->
            <div class="h-6 w-16 opacity-40"
            style="background-image: repeating-linear-gradient(90deg, currentColor 0 1px, transparent 1px 2px, currentColor 3px 5px, transparent 5px 7px, currentColor 7px 8px, transparent 8px 10px); color: #94a3b8;">
            </div>


        </div>





        <div class="mt-4 grid gap-3 md:grid-cols-[1fr_1fr_1.2fr]">



            <!-- Humidity Reading -->
            <div>


                <p class="font-mono text-[10px] uppercase tracking-wider text-slate-400">
                    Humidity Level
                </p>



                <p class="mt-1 font-mono text-2xl font-bold text-purple-500">

                    ${reading?.humidity ?? "--"}

                    <span class="text-sm text-purple-500/50">
                        %
                    </span>

                </p>



                <p class="font-mono text-[11px] text-slate-400">

                    Minimum required humidity
                    ${shipment.min_humidity ?? "--"}%

                </p>


            </div>







            <!-- Duration -->
            <div>


                <p class="font-mono text-[10px] uppercase tracking-wider text-slate-400">
                    Duration
                </p>



                <p class="mt-1 font-mono text-lg font-bold text-slate-900">

                    ${timeAgo(alert.created_at)}

                </p>



                <p class="font-mono text-[11px] text-slate-400">

                    Since ${new Date(alert.created_at).toLocaleTimeString()}

                </p>


            </div>









            <!-- Dry Risk -->
            <div>


                <p class="font-mono text-[10px] uppercase tracking-wider text-slate-400">
                    Dryness Risk
                </p>



                <div class="mt-2 flex gap-1">


                    ${Array(6).fill(`

                        <div class="h-4 flex-1 rounded-sm bg-purple-500"></div>

                    `).join("")}


                </div>




                <p class="mt-1 font-mono text-[11px] text-purple-500">

                    6 / 6 · low humidity danger

                </p>


            </div>



        </div>









        <div class="mt-4 flex flex-wrap items-center justify-between gap-3 border-t border-dashed border-slate-200 pt-3">



            <p class="font-mono text-[11px] text-slate-400">

                ${timeAgo(alert.created_at)}

            </p>





            <div class="flex gap-2">



                <a href="/shipments/${shipment.id}"

                class="rounded border border-slate-200 px-3 py-1.5 font-mono text-[11px] uppercase tracking-wide text-slate-500 transition hover:border-slate-300 hover:text-slate-800">

                    View

                </a>





                <button

                class="rounded bg-emerald-500 px-3 py-1.5 font-mono text-[11px] font-bold uppercase tracking-wide text-white transition hover:bg-emerald-600">

                    Resolve

                </button>




            </div>


        </div>



    </div>


</div>


`;
}

function ResolvedAlertCard(alert, shipment)
{
    container.innerHTML += `

<div class="flex flex-col overflow-hidden rounded-xl border border-emerald-200 bg-white shadow-sm transition hover:shadow-md md:flex-row">

    <!-- icon -->
    <div class="flex shrink-0 items-center justify-center bg-emerald-50 px-4 py-3 md:w-16">
        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-emerald-100">
            <svg class="h-6 w-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M5 13l4 4L19 7"/>
            </svg>
        </div>
    </div>


    <!-- content -->
    <div class="flex flex-1 flex-col gap-3 p-5">

        <div class="flex items-center justify-between">

            <div>
                <h3 class="font-semibold text-slate-800">
                    Alert Resolved
                </h3>

                <p class="text-sm text-slate-500">
                    #${shipment['tracking-number']}
                </p>
            </div>


            <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">
                Resolved
            </span>

        </div>


        <p class="text-sm text-slate-600">
            ${alert.message}
        </p>


        <div class="flex items-center justify-between border-t border-slate-100 pt-3 text-xs text-slate-400">

            <span>
                Resolved at:
                ${new Date(alert.updated_at).toLocaleString()}
            </span>


            <svg class="h-5 w-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 12l2 2 4-4"/>
            </svg>

        </div>

    </div>

</div>

`;
}

window.loadResolved = async function() {
    try {
 const response = await axios.get('/alerts?status=resolved');
    const alerts = response.data.alerts;
    container.innerHTML  = "";

    alerts.forEach(alert => {
        console.log(alert);
        const shipment = alert.shipment;

        const readings = shipment.sensor_readings ?? [];

        const reading = readings.length > 0 
            ? readings[readings.length - 1]
            : null;

    ResolvedAlertCard(alert , shipment , reading);
    countAlerts();     
    });;
            
    } catch (error) {
        console.error(error);
    }

}

alerts();





    const countActive = document.getElementById("activeAlerts");
    const countResolved = document.getElementById("resolvedAlerts");
    const totalCount = document.getElementById("totalCount");
async function countAlerts() {

    const response = await axios.get('/alerts/count');

    countActive.textContent =  response.data.countActive;
    countResolved.textContent = response.data.countResolved;
    totalCount.textContent = response.data.totalCount;

    
}
if(countActive && countResolved && totalCount)
{
countAlerts();
}

});