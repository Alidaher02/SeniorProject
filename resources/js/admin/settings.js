import axios from "axios";

const form = document.getElementById("updateProfile");

if(form)
{
form.addEventListener("submit" , async (event) => {
event.preventDefault();

    const name = document.getElementById("userName").value.trim();
    const email = document.getElementById("userEmail").value.trim();
    const image = document.getElementById("profileImage").files[0];

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


    if(!valid) return;

    const formData = new FormData();
        formData.append("name", name);
        formData.append("email", email);
        if(image)
        {
            formData.append("image" , image);
            
        }
        formData.append("_method", "PATCH");
          console.log([...formData.entries()]);
        try
    {
    
    let response = await axios.post('/profile' , formData);

    displayMessage(document.getElementById("profileMessage") , response.data.message);

    if (image) {
    const preview = document.getElementById("profileImagePreview");

    preview.src = URL.createObjectURL(image);
}


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