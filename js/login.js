const main = document.getElementById("main");

document.querySelector("#main form").addEventListener("submit", function (event) {
    event.preventDefault();
    const email = document.querySelector("#email").value;
    const password = document.querySelector("#password").value;
    document.querySelector("#password").value = "";
    login(email, password);
});

function login(email, password){
    document.querySelector("input[type='submit']").style["filter"]="blur(3px)";
    document.querySelector("#divLogin").innerHTML += "<div class='spinner-border' role='status'> <span class='sr-only'>Loading...</span> </div>";

    const formData = new FormData();
    formData.append('email', email);
    formData.append('password', hex_sha512(password)); //invio cryptato della password 
    
    axios.post('api-login.php', formData).then(response => {
        document.querySelector("input[type='submit']").style["filter"]="";
        document.querySelector("#divLogin").innerHTML = "<input type='submit' value='Login'></input>";  
              
        if (response.data["logineseguito"]) {
            window.location.assign("home.php");
        } else {
            document.querySelector("form > p").innerText = response.data["errorelogin"];
        }
    });
}





