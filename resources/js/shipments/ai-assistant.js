import axios from "axios";

if(! document.getElementById("chatMessages"))
{
    console.log();
}
else
{
async function history() {
    let response = await axios.get('/chat/history');
    let chats = response.data.chat;

    chats.forEach(chat => {
        displayMessage(chat.message , chat.created_at);
        displayAiMessage(chat.ai_response, chat.created_at);
    });
    
}

history();

window.chat = async function() {

    let input = document.getElementById('messageInput');
    let message = input.value;

    if (message.trim() === "") {
        return;
    }

    input.value = "";

    let messageTime = new Date();

    displayMessage(message, messageTime);
    showTyping();

    try {

        let response = await axios.post('/ai/chat', {
            message: message
        });

        hideTyping();

        displayAiMessage(
            response.data.aiResponse,
            messageTime
        );

    } catch (error) {

        hideTyping();

        console.error("AI Chat Error:", error);

        console.error("Status:", error.response?.status);

        console.error("Server Response:", error.response?.data);

        displayAiMessage(
            "Sorry, something went wrong. Please try again.",
            new Date()
        );
    }
}

function displayAiMessage(aiResponse, createdAt = null)
{
    aiResponse = aiResponse.replace(
        /(https?:\/\/[^\s]+)/g,
        `<a href="$1" target="_blank" class="text-blue-600 underline font-semibold">
            📄 Download PDF
        </a>`
    );

    let time = formatMessageTime(createdAt);

    document.getElementById("chatMessages").innerHTML +=
    `
    <div class="flex justify-start">
        <div>

        <div class="chat-bubble whitespace-pre-line bg-slate-100/80 border border-slate-200/60 text-slate-800 text-sm p-3.5 rounded-2xl rounded-tl-none leading-relaxed shadow-xs">${aiResponse}</div>
  

            
            <div class="text-[11px] text-slate-400 mt-1 ml-2">
                ${time}
            </div>

        </div>
    </div>
    `;

    scrollChat();
}

function displayMessage(message , createdAt = null)
{
        let time = formatMessageTime(createdAt);

    document.getElementById("chatMessages").innerHTML +=
    `
        <div class="flex justify-end mb-3">
            <div class="max-w-[70%]">

                <div class="bg-blue-500 text-white rounded-2xl rounded-br-none px-4 py-3 shadow-sm">
                    ${message}
                </div>

                <div class="text-[11px] text-slate-400 mt-1 text-right pr-2">
                    ${time}
                </div>

            </div>
        </div>
    `;

    scrollChat();
}

function scrollChat()
{
    const chat = document.getElementById("chatMessages");

    chat.scrollTop = chat.scrollHeight;
}

function showTyping()
{
    document.getElementById("chatMessages").innerHTML += `
    <div id="typingIndicator" class="flex justify-start mb-3">
        <div class="bg-gray-100 rounded-2xl px-4 py-3 flex items-center gap-1">
            
            <span class="w-2 h-2 bg-gray-500 rounded-full animate-bounce"></span>
            <span class="w-2 h-2 bg-gray-500 rounded-full animate-bounce [animation-delay:0.2s]"></span>
            <span class="w-2 h-2 bg-gray-500 rounded-full animate-bounce [animation-delay:0.4s]"></span>

        </div>
    </div>
    `;
    scrollChat();
}


function hideTyping()
{
    const typing = document.getElementById("typingIndicator");

    if(typing)
    {
        typing.remove();
    }
}

function formatMessageTime(createdAt)
{
    if (!createdAt) {
        return "just now";
    }

    const date = new Date(createdAt);
    const now = new Date();

    const seconds = Math.floor((now - date) / 1000);

    if (seconds < 60) {
        return "just now";
    }

    const minutes = Math.floor(seconds / 60);

    if (minutes < 60) {
        return `${minutes}m`;
    }

    const hours = Math.floor(minutes / 60);

    if (hours < 24) {
        return `${hours}h`;
    }

    const days = Math.floor(hours / 24);

    return `${days}d`;
}

document.getElementById("messageInput").addEventListener("keydown", function(event) {

    if(event.key === "Enter") {
        event.preventDefault(); // stops new line

        window.chat();
    }

});
}

