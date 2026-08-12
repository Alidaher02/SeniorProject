import './shipments/shipment';
import './shipments/cancelBtn'
import './admin/addUser'
import './admin/stats';
import './admin/alerts';
import './admin/settings';
import './admin/aiAnalayze';
import './shipments/ai-assistant';
import './gps/location';

window.addEventListener("load", () => {

    const loader = document.getElementById("pageLoader");
    const content = document.getElementById("pageContent");


    setTimeout(() => {

        loader.classList.add("opacity-0");

        content.classList.remove("opacity-0");
        content.classList.add("opacity-100");


        setTimeout(() => {
            loader.remove();
        }, 1000);

    }, 1000);

});
