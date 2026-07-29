import './bootstrap';
import './admin';
import './sensorReadings';



const sendM = document.getElementById("sendM");

 function sendMessage() {

    let input = document.getElementById("message");
    let message = input.value;

    if (!message.trim()) return;

    // Show user message
    document.getElementById("messages").innerHTML += `
        <div class="flex justify-end mb-2">
            <div class="bg-blue-600 text-white px-4 py-2 rounded-xl max-w-xs">
                ${message}
            </div>
        </div>
    `;

    fetch('/chat', {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            message: message
        })
    })
    .then(res => res.json())
    .then(data => {

        // Show bot message
        document.getElementById("messages").innerHTML += `
            <div class="flex justify-start mb-2">
                <div class="bg-blue-50 text-gray-700 px-4 py-2 rounded-xl max-w-xs">
                    ${data.reply}
                </div>
            </div>
        `;

    });

    // Clear input after sending
    input.value = "";

}


const messageInput = document.getElementById("message");


sendM.addEventListener("click", () => {
    sendMessage();
});


messageInput.addEventListener("keydown", (e) => {

    if (e.key === "Enter") {
        sendMessage();
    }

});


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


showModel(chatBtn , chatClose , chatModel);






