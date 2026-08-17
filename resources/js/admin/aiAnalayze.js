import axios from "axios";

const analyzeBtn = document.querySelectorAll(".analyze-btn");

analyzeBtn.forEach(button => {
    button.addEventListener("click", async () => {

        const shipmentId = button.dataset.id;
                // Show loading card
        showAnalysisLoading();

        // Start fake progress
        const progressInterval = startFakeProgress();

        analysisModal(button);
        console.log("Shipment ID:", shipmentId);

        



        try {
            const response = await axios.get(
                `/admin/ai-assistant/${shipmentId}/analyze`
            );

            clearInterval(progressInterval);

            const progressBar =
                document.getElementById("analysisProgressBar");

            const progressText =
                document.getElementById("analysisProgressText");

            const status =
                document.getElementById("analysisStatus");

            // Finish progress
            progressBar.style.width = "100%";
            progressText.textContent = "100%";
            status.textContent = "Analysis complete.";

            const shipment = response.data.shipment;
            const readings = shipment.sensor_readings;
            const latestReading = readings[readings.length - 1];
            const ai = response.data.ai_response;

            displayRisk(ai.shipment_risk);
            displaySummary(ai.summary);
            displayReadings(latestReading)
            displayRange(shipment)
            displayLocation(shipment);
            displayIssues(ai.critical);
            displayWarning(ai.warnings);
            displayRecommendations(ai.recommendations);
            
            setTimeout(() => {

                hideAnalysisLoading();

                const analysisModal =
                    document.getElementById("analysisModal");

                analysisModal.classList.remove("hidden");
                analysisModal.classList.add("flex");

            }, 500);

        } catch (error) {

            clearInterval(progressInterval);

            hideAnalysisLoading();

            console.error("Analysis error:", error);
        }
    });
});


function analysisModal()
{
    const analysisModal = document.getElementById("analysisModal");
    if(! analysisModal) return;

        analysisModal.classList.remove("hidden");
        analysisModal.classList.add("flex");
    
    const closeBtn = document.getElementById("closeAnalysis");
    const closeAnalysisBottom = document.getElementById("closeAnalysisBottom");

    const buttons = [
        closeBtn,
        closeAnalysisBottom
    ]

    buttons.forEach(btn => {

    btn.addEventListener('click' , ()=>{

        analysisModal.classList.add("hidden");

    });       
    });


}

function displaySummary(summary)
{
 const container = document.getElementById("summary");

 if(! container) return;

 container.textContent = summary; 
}

function displayReadings(reading)
{
    const temp = document.getElementById("temp");
    const humidity = document.getElementById("humidity");
    if(temp)
    {
        temp.textContent = reading.temperature
    }

    if(humidity)
    {
        humidity.textContent = reading.humidity
    }
}

function displayRange(shipment)
{
    const tempRange = document.getElementById("tempRange");
    const humidityRange = document.getElementById("humidityRange");
    const modalTracking = document.getElementById("modalTracking");

    if(modalTracking)
    {
        modalTracking.textContent = shipment.tracking_number;
    }

    if(tempRange)
    {
        tempRange.textContent = `Allowed: ${shipment.temperature_limits.min}°C – ${shipment.temperature_limits.max}°C`;
    }

    if(humidityRange)
    {
        humidityRange.textContent = `Allowed: ${shipment.humidity_limits.min}% – ${shipment.humidity_limits.max}%`;
    }
}

function displayLocation(shipment)
{
    const gpsReadings = document.getElementById("gpsReadings");

    if(gpsReadings)
    {
        gpsReadings.textContent = shipment.gps_readings.latitude, shipment.gps_readings.longitude;
    }
}
function displayIssues(issues)
{
    const container = document.getElementById("issuesContainer");
    const issuesCount = document.getElementById("issuesCount");

    if (!container) return;

    container.innerHTML = "";

    if (issuesCount) {
        issuesCount.textContent = issues.length;
    }

    issues.forEach(issue => {
        container.innerHTML += `
            <div class="rounded-lg border border-red-200 bg-red-50 p-3">

                <p class="text-xs font-semibold text-red-800">
                    ${issue.severity}
                </p>

                <p class="mt-1 text-[10px] leading-4 text-red-700">
                    ${issue.issue}
                </p>

            </div>
        `;
    });
}   

function displayWarning(warnings) {
    const container = document.getElementById("warningContainer");

    if (!container) return;

    container.innerHTML = "";

    warnings.forEach(warning => {
        container.innerHTML += `
            <div class="rounded-lg border border-orange-200 bg-orange-50 p-3">
                <p class="text-xs font-semibold text-orange-800">
                    ${warning.severity}
                </p>

                <p class="mt-1 text-[10px] text-orange-700">
                    ${warning.issue}
                </p>
            </div>
        `;
    });
}

function displayRecommendations(recommendations) {
    const container = document.getElementById("recommendationsContainer");

    if (!container) return;

    container.innerHTML = "";

    recommendations.forEach(recommendation => {
        container.innerHTML += `
            <div class="rounded-md bg-blue-50 px-3 py-2.5">
                <p class="text-[11px] text-blue-800">
                    ${recommendation.text}
                </p>
            </div>
        `;
    });
}

function displayRisk(risk)
{
    const riskPercent = document.getElementById("riskPercent");
    const riskLevel = document.getElementById("riskLevel");
    const riskCircle = document.getElementById("riskCircle");

    console.log("RISK:", risk);

    if (!risk) return;

    const percentage = Number(risk.risk_percentage);
    const level = risk.risk_level;

    if (riskPercent) {
        riskPercent.textContent = `${percentage}%`;
    }

    if (riskLevel) {
        riskLevel.textContent = level;
    }

    if (riskCircle) {
        const circumference = 251;
        const offset = circumference - (percentage / 100) * circumference;

        riskCircle.style.strokeDashoffset = offset;

        if (level === "low") {
            riskCircle.style.stroke = "#22c55e";
            riskPercent.className = "text-lg font-bold text-green-700";
            riskLevel.className = "text-xs font-semibold uppercase text-green-700";
        }

        else if (level === "medium") {
            riskCircle.style.stroke = "#eab308";
            riskPercent.className = "text-lg font-bold text-yellow-700";
            riskLevel.className = "text-xs font-semibold uppercase text-yellow-700";
        }

        else if (level === "high") {
            riskCircle.style.stroke = "#f97316";
            riskPercent.className = "text-lg font-bold text-orange-700";
            riskLevel.className = "text-xs font-semibold uppercase text-orange-700";
        }

        else if (level === "critical") {
            riskCircle.style.stroke = "#ef4444";
            riskPercent.className = "text-lg font-bold text-red-700";
            riskLevel.className = "text-xs font-semibold uppercase text-red-700";
        }
    }
}

function showAnalysisLoading()
{
    const loading = document.getElementById("analysisLoading");
    const progressBar = document.getElementById("analysisProgressBar");
    const progressText = document.getElementById("analysisProgressText");
    const status = document.getElementById("analysisStatus");

    loading.classList.remove("hidden");
    loading.classList.add("flex");

    progressBar.style.width = "0%";
    progressText.textContent = "0%";
    status.textContent = "Collecting shipment data...";
}

function hideAnalysisLoading()
{
    const loading = document.getElementById("analysisLoading");

    loading.classList.add("hidden");
    loading.classList.remove("flex");
}

function startFakeProgress()
{
    const progressBar = document.getElementById("analysisProgressBar");
    const progressText = document.getElementById("analysisProgressText");
    const status = document.getElementById("analysisStatus");

    let progress = 0;

    const interval = setInterval(() => {

        if (progress >= 95) {
            clearInterval(interval);
            return;
        }

        progress += Math.floor(Math.random() * 5) + 1;

        if (progress > 95) {
            progress = 95;
        }

        progressBar.style.width = `${progress}%`;
        progressText.textContent = `${progress}%`;

        if (progress < 30) {
            status.textContent = "Collecting shipment data...";
        } 
        else if (progress < 60) {
            status.textContent = "Analyzing sensor readings...";
        } 
        else if (progress < 80) {
            status.textContent = "Checking alerts and violations...";
        } 
        else {
            status.textContent = "Generating AI risk assessment...";
        }

    }, 300);

    return interval;
}