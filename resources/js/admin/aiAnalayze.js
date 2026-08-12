import axios from "axios";

window.analayze = async function()
{
    
    showLoading();

    try{
    const response = await axios.get('/admin/ai-assistant/insights');

    const ai = response.data.ai_response;

    displaySummary(ai.summary);

    displayCounts(ai);

    displayCritical(ai.critical);  

    displayRecommendations(ai.recommendations);

    displayRisk(ai.shipment_risks);

    displayWarnings(ai.warnings);

    const analyzedAt = new Date(response.data.analyzed_at);
    document.getElementById("lastAnalyzed").textContent =
    analyzedAt.toLocaleTimeString([], {
        hour: "2-digit",
        minute: "2-digit",
        second: "2-digit"
    });

    }catch(error)
    {
        console.error('AI Analysis failed:', error);
        
    }

    

}

analayze();


function displaySummary(summary)
{
    const container = document.getElementById("summaryContainer");
    if(!container) return;
    container.textContent = summary ;

}
function showLoading() {

    const skeleton = 
    `
        <div class="animate-pulse space-y-2 p-5">
            <div class="h-3 bg-slate-200 rounded w-full"></div>
            <div class="h-3 bg-slate-200 rounded w-5/6"></div>
            <div class="h-3 bg-slate-200 rounded w-3/4"></div>
        </div>    
    `;
    const containers = [
        "summaryContainer",
        "criticalContainer",
        "warningsContainer",
        "recommendationsContainer",
        "riskCotnainer"
    ];

    containers.forEach(id => {

        const element = document.getElementById(id);

        if(element)
        {
            element.innerHTML = skeleton;
        }

    });

    const countSkeleton =
    `
        <div class="relative h-8 w-14 overflow-hidden rounded-lg bg-slate-200">
            <div class="absolute inset-0 -translate-x-full animate-[shimmer_1.5s_infinite] bg-gradient-to-r from-transparent via-white/70 to-transparent"></div>
        </div>    
    `;

    const countConainers = [
        "activeShipments",
        "warningsCount",
        "criticalAlerts",
        "activeAlerts",
        "lastAnalyzed"

    ];

    countConainers.forEach(id => {

        const element = document.getElementById(id);

        if(id)
        {
            element.innerHTML = countSkeleton;
        }
    });



}




function displayCritical(criticalShipments)
{
    const container = document.getElementById("criticalContainer");
        if(!container) return;

    container.innerHTML = "";

        if (criticalShipments.length === 0) {
            container.innerHTML = `
                <p class="text-sm text-slate-500">
                    No Critical available.
                </p>
            `;
            return;
        }    
    criticalShipments.forEach(shipment => {   
    container.innerHTML +=`
                    <div class="border border-red-100 rounded-xl p-3 bg-red-50/40">

                        <div class="flex items-start justify-between gap-2">

                            <div>
                                <p class="text-sm font-semibold text-slate-900">
                                    ${shipment.tracking_number}
                                </p>


                            </div>

                            <span class="text-[10px] font-semibold uppercase text-red-600 bg-red-100 px-2 py-1 rounded-full">
                                Critical
                            </span>

                        </div>

                        <p class="text-sm text-slate-600 mt-2">
                            ${shipment.issue}
                        </p>

                        <button
                            type="button"
                            class="text-xs font-medium text-red-600 hover:text-red-700 mt-3">
                            View shipment →
                        </button>

                    </div>    
    `; 
    });

}

function displayWarnings(warnings)
{
    const container = document.getElementById("warningsContainer");
        if(!container) return;

container.innerHTML = "";
        if (warnings.length === 0) {
            container.innerHTML = `
                <p class="text-sm text-slate-500">
                    No warnings available.
                </p>
            `;
            return;
        }
    warnings.forEach(shipment => {   
    container.innerHTML +=`
                    <div class="flex items-start gap-3">

                        <div class="h-7 w-7 rounded-lg bg-blue-50 flex items-center justify-center shrink-0">
                            <span class="text-xs font-bold text-blue-600">
                                ${shipment.shipment_id}
                            </span>
                        </div>

                        <div>
                            <p class="text-sm font-medium text-slate-900">
                             ${shipment.tracking_number}
                            </p>

                            <p class="text-sm text-slate-500 mt-0.5">
                               ${shipment.issue}
                            </p>
                        </div>

                    </div>
    `; 
    });

}

function displayRecommendations(recommendations)
{
    const container = document.getElementById("recommendationsContainer");
        if(!container) return;

        container.innerHTML = "";
        if (recommendations.length === 0) {
            container.innerHTML = `
                <p class="text-sm text-slate-500">
                    No recommendations available.
                </p>
            `;
            return;
        }
    recommendations.forEach(shipment => {   
    container.innerHTML +=`
                    <div class="flex items-start gap-3">

                        <div class="h-7 w-7 rounded-lg bg-blue-50 flex items-center justify-center shrink-0">
                            <span class="text-xs font-bold text-blue-600">
                                ${shipment.shipment_id}
                            </span>
                        </div>

                        <div>
                            <p class="text-sm font-medium text-slate-900">
                             ${shipment.tracking_number}
                            </p>

                            <p class="text-sm text-slate-500 mt-0.5">
                               ${shipment.text}
                            </p>
                        </div>

                    </div>
    `; 
    });

}
function displayRisk(shipments)
{
    const container = document.getElementById("riskCotnainer");
        if(!container) return;


    container.innerHTML = "";
    shipments.forEach(shipment =>{

    container.innerHTML += 
    `
 <div class="px-5 py-4 flex flex-col md:flex-row md:items-center gap-4">

                    <div class="flex-1">

                        <div class="flex items-center gap-2">

                            <span class="text-sm font-semibold text-slate-900">
                                ${shipment.tracking_number}
                            </span>

                            <span class="text-[10px] font-semibold uppercase
                             ${
                                shipment.risk_level === 'low'
                                    ? 'text-green-600 bg-green-50 border border-green-100 '
                                    : shipment.risk_level === 'medium'
                                    ? 'text-yellow-600 bg-yellow-50 border border-yellow-100'
                                    : shipment.risk_level === 'high'
                                    ? 'text-red-600 bg-red-50 border border-red-100'
                                    : 'text-red-600 bg-red-50 border border-red-100'
                                }
                             
                             px-2 py-0.5 rounded-full"
                             
                             >
                                ${shipment.risk_level}
                            </span>

                        </div>
                    </div>

                    <div class="w-full md:w-48">

                        <div class="flex justify-between text-xs mb-1">

                            <span class="text-slate-500">
                                Risk score
                            </span>

                            <span class="font-semibold
                             ${
                                shipment.risk_level === 'low'
                                    ? 'text-green-500'
                                    : shipment.risk_level === 'medium'
                                    ? 'text-yellow-600'
                                    : shipment.risk_level === 'high'
                                    ? 'text-red-600'
                                    : 'text-red-600'
                                }                                
                            ">
                                ${shipment.risk_percentage}
                            </span>

                        </div>

                        <div class="h-2 bg-slate-100 rounded-full overflow-hidden">

                            <div class="h-full rounded-full
                             ${
                                shipment.risk_level === 'low'
                                    ? 'bg-green-500'
                                    : shipment.risk_level === 'medium'
                                    ? 'bg-yellow-600'
                                    : shipment.risk_level === 'high'
                                    ? 'bg-red-600'
                                    : 'bg-red-600'
                                }                           
                            "
                                style="width: ${shipment.risk_percentage}%">
                            </div>

                        </div>

                    </div>

                </div>      
    `;
    });

}

function displayCounts(ai) {
    const activeShipments = document.getElementById("activeShipments");
    const activeAlerts = document.getElementById("activeAlerts");
    const criticalAlerts = document.getElementById("criticalAlerts");
    const warningsCount = document.getElementById("warningsCount");

    if (activeShipments) {
        activeShipments.textContent = ai.active_shipments ?? 0;
    }

    if (activeAlerts) {
        activeAlerts.textContent = ai.active_alerts ?? 0;
    }

    if (criticalAlerts) {
        criticalAlerts.textContent = ai.critical_count ?? 0;
    }

    if (warningsCount) {
        warningsCount.textContent = ai.warning_count ?? 0;
    }
}