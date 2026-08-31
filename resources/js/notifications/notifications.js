import axios from "axios";

async function showNotifications() {
    
    let response = await axios.get('/notifications');
   const notifications = response.data.notifications;
   const count = response.data.count;
    console.log(notifications);
    
    displayNotifications(notifications)

    document.getElementById("unreadNotificationsCount").textContent = count;

}

showNotifications();

function displayNotifications(notifications)
{
    const container = document.getElementById("unreadnotificationsContainer");

    if (!container) return;

    container.innerHTML = "";

    notifications.forEach(notification => {

        container.innerHTML += `
            <div
                type="button"
                onclick="readNotification('${notification.id}')"
                class="flex w-full cursor-pointer gap-2.5 px-3 py-2.5 text-left transition hover:bg-gray-50"
            >

                ${getNotificationIcon(notification.data.type)}

                <div class="min-w-0 flex-1">

                    <div class="flex items-center justify-between gap-2">

                        <p class="truncate text-[11px] font-semibold text-gray-800">
                            ${notification.data.title}
                        </p>

                        <p class="shrink-0 text-[9px] text-gray-400">
                            ${timeAgo(notification.created_at)}
                        </p>

                    </div>

                    <p class="mt-0.5 text-[10px] leading-4 text-gray-500">
                        ${notification.data.message}
                    </p>

                    <p class="mt-1 text-[10px] font-semibold text-gray-600">
                        Value: ${notification.data.value}
                    </p>

                </div>

            </div>
        `;
    });
}
    window.readNotification = async  function(notificationId){

        let response = await axios.patch(`/notifications/${notificationId}/read`);

        showNotifications();
        
        }




function timeAgo(dateString) {
    const date = new Date(dateString);
    const now = new Date();

    const seconds = Math.floor((now - date) / 1000);

    if (seconds < 60) {
        return `${seconds}s ago`;
    }

    const minutes = Math.floor(seconds / 60);

    if (minutes < 60) {
        return `${minutes}m ago`;
    }

    const hours = Math.floor(minutes / 60);

    if (hours < 24) {
        return `${hours}h ago`;
    }

    const days = Math.floor(hours / 24);

    if (days < 30) {
        return `${days}d ago`;
    }

    const months = Math.floor(days / 30);

    if (months < 12) {
        return `${months}mo ago`;
    }

    const years = Math.floor(months / 12);

    return `${years}y ago`;
}

function getNotificationIcon(type) {

    const icons = {

        temperature: `
            <div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-red-50 text-red-500">
                <svg xmlns="http://www.w3.org/2000/svg"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke-width="1.8"
                     stroke="currentColor"
                     class="h-3.5 w-3.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 3v11m-3.5.5a3.5 3.5 0 1 0 7 0c0-1.4-.8-2.6-2-3.2V6a1.5 1.5 0 0 0-3 0v5.3c-1.2.6-2 1.8-2 3.2Z"/>
                </svg>
            </div>
        `,

        low_temperature: `
            <div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-blue-50 text-blue-500">
                <svg xmlns="http://www.w3.org/2000/svg"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke-width="1.8"
                     stroke="currentColor"
                     class="h-3.5 w-3.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 3v18M8 6l4 3 4-3M8 18l4-3 4 3M5 12h14"/>
                </svg>
            </div>
        `,

        humidity: `
            <div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-indigo-50 text-indigo-500">
                <svg xmlns="http://www.w3.org/2000/svg"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke-width="1.8"
                     stroke="currentColor"
                     class="h-3.5 w-3.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 3.5S6 10.2 6 14a6 6 0 0 0 12 0c0-3.8-6-10.5-6-10.5Z"/>
                </svg>
            </div>
        `,

        low_humidity: `
            <div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-cyan-50 text-cyan-500">
                <svg xmlns="http://www.w3.org/2000/svg"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke-width="1.8"
                     stroke="currentColor"
                     class="h-3.5 w-3.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 4S7 10 7 14a5 5 0 0 0 10 0c0-4-5-10-5-10Z"/>
                </svg>
            </div>
        `,

        tilt: `
            <div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-orange-50 text-orange-500">
                <svg xmlns="http://www.w3.org/2000/svg"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke-width="1.8"
                     stroke="currentColor"
                     class="h-3.5 w-3.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9v4m0 4h.01M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0Z"/>
                </svg>
            </div>
        `,

        light: `
            <div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-yellow-50 text-yellow-500">
                <svg xmlns="http://www.w3.org/2000/svg"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke-width="1.8"
                     stroke="currentColor"
                     class="h-3.5 w-3.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 3v1m6.36 1.64-.71.71M21 12h-1m-1.64 6.36-.71-.71M12 20v1m-6.36-2.64.71-.71M3 12h1m1.64-6.36.71.71"/>
                    <circle cx="12" cy="12" r="3"/>
                </svg>
            </div>
        `
    };

    return icons[type] ?? `
        <div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-gray-50 text-gray-500">
            <svg xmlns="http://www.w3.org/2000/svg"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke-width="1.8"
                 stroke="currentColor"
                 class="h-3.5 w-3.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15 17h5l-1.5-2V9a6.5 6.5 0 0 0-13 0v6L4 17h5m2 3h2"/>
            </svg>
        </div>
    `;
}

