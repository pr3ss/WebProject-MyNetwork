

const main = document.getElementById("main");



document.querySelector("#main form").addEventListener("submit", function (event) {
    event.preventDefault();
    const email = document.querySelector("#email").value;
    const password = document.querySelector("#password").value;
    const username = document.querySelector("#username").value;
    const nome = document.querySelector("#nome").value;
    const cognome = document.querySelector("#cognome").value;
    const data_nascita = document.querySelector("#data_nascita").value;

    document.querySelector("#password").value = "";
    if(checkPasswordSecurity(password)){
        signin(email, password, username, nome, cognome, data_nascita);
    }else{
        document.querySelector("form > p").innerText = "La password deve avere min 8 caratteri."
    }
});



function signin(email, password, username, nome, cognome, data_nascita){
    document.querySelector("input[type='submit']").style["filter"]="blur(3px)";
    document.querySelector("#divSignin").innerHTML += "<div class='spinner-border' role='status'> <span class='sr-only'>Loading...</span> </div>";

    const formData = new FormData();
    formData.append('email', email);
    formData.append('password', hex_sha512(password)); //invio cryptato della password 
    formData.append('username', username);
    formData.append('nome', nome);
    formData.append('cognome', cognome);
    formData.append('data_nascita', data_nascita);
    
    axios.post('api-signin.php', formData).then(response => {
        console.log(response);
        document.querySelector("input[type='submit']").style["filter"]="";
        document.querySelector("#divSignin").innerHTML = "<input type='submit' value='Sign Up'></input>";  
              
        if (response.data["signineseguito"]) {
            window.location.assign("index.php?signin=1"); //verificare se mettere un testo in login con registrazine avveenuta con successo oppure metterlo nella pagina di signin e mettere un delay o un tasto per il login
        } else {
            document.querySelector("form > p").innerText = response.data["erroresignin"];
        }
    });



}

/* TODO aggiungere ricerca maiuscola e carattere speciale oltre che alla lunghezza */
function checkPasswordSecurity(password){
    return password.length>=8 ;
}






