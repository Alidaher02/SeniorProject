import axios from "axios";

const form = document.getElementById("updateProfile");

if(form)
{
form.addEventListener("submit" , async (event) => {
event.preventDefault();

    const name = document.getElementById("userName").value.trim();
    const email = document.getElementById("userEmail").value.trim();

    const originalName = userName.value.trim();
    const originalEmail = userEmail.value.trim();

    const nameError = document.getElementById("nameError");
    const emailError = document.getElementById("emailError");   

    nameError.textContent = "";
    emailError.textContent = "";


    let valid = true;

    if(name.length  < 5)
    {
        nameError.textContent = "Name must be at least 5 characters!";
        valid = false;
    }

    if (email.length === 0) {
        emailError.textContent = "Email is required!";
        valid = false;
    } 

    if(name === originalName && email === originalEmail)
    {

      nameError.textContent =   "No changes were made.";
      
        valid = false;       
    }

    if(!valid) return;

        try
    {
    let response = await axios.patch('/profile' , {
        name: name,
        email: email,
    });

    displayMessage(document.getElementById("profileMessage") , response.data.message);


    } catch (error){
        console.error(error);
    }


});

}

function displayMessage(message , body)
{
    message.classList.remove("hidden");
    message.textContent = body;

    setTimeout(() => {
    message.classList.add("hidden");        
    }, 3000);
    
}