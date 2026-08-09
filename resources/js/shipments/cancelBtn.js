window.showCancelModal = function() {
    document.getElementById('cancelModal').classList.remove('hidden');
}

window.closeCancelModal =   function() {
    document.getElementById('cancelModal').classList.add('hidden');
}

window.addEventListener('click', (event) => {
    const modal = document.getElementById('cancelModal');
    
    // Check if the user clicked directly on the modal backdrop background
    if (event.target === modal) {
        modal.classList.add('hidden');
    }
});
    const editBtn = document.querySelectorAll(".editBtn");
    const editModel = document.getElementById("editModel");
    const editClose = document.getElementById("editClose");
    if(editBtn && editModel && editClose)
    {
        showModel(editBtn.length > 0  , editClose , editModel);
    }


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
