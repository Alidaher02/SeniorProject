import axios from "axios";

const form = document.getElementById("updateProfile");

if(form)
{
form.addEventListener("submit" , async (event) => {
event.preventDefault();

    const name = document.getElementById("userName").value;
    const email = document.getElementById("userEmail").value;
    try
    {
    let response = await axios.patch('/profile' , {
        name: name,
        email: email
    });

    console.log(response.data.message);

    } catch (error){
        console.error(error);
    }


});

}
