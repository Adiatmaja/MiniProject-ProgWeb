var inpUsername = document.getElementById("username");
var inpPassword = document.getElementById("password");

function validationLogin(){
    if(inpUsername === "" || inpPassword === ""){
        document.getElementsByClassName("alert").innerHTML = "Username atau Password tidak boleh kosong";
        event.preventDefault();
    }
}