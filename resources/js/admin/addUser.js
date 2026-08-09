    const addDriver = document.getElementById("addDriver");
    const driverCard = document.getElementById("driverCard");
    const cancelBnt = document.getElementById("cancelBnt");
    const addCustomer = document.getElementById("addCustomer");
    const customerCard = document.getElementById("customerCard");
    const customerCancelBtn = document.getElementById("customerCancelBtn");




showModel(addDriver , cancelBnt , driverCard);
showModel(addCustomer , customerCancelBtn , customerCard);


   
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

window.openDeleteModal = function()
{
    document.getElementById("deleteModal").classList.remove("hidden");
}

window.closeDeleteModal = function()
{
    document.getElementById("deleteModal").classList.add("hidden");

}