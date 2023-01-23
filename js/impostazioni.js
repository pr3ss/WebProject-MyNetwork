var temp_foto_profilo;
function cambia_foto_profilo() {
    var input = document.createElement('input');
    input.type = 'file';

    input.onchange = e => {
        temp_foto_profilo = e.target.files[0];
        document.getElementById("foto_profilo").src = URL.createObjectURL(new Blob([temp_foto_profilo]));
    }

    input.click();
}

function salva_info() {
    let new_info = {};

    temp_foto_profilo; // se non é stata cambiata prende nul;
    new_info["username"] = document.getElementById("my_username").value ? document.getElementById("my_username").value : null;
    new_info["email"] = document.getElementById("email").value ? document.getElementById("email").value : null ;
    new_info["descrizione"] = document.getElementById("descrizione").value ? document.getElementById("descrizione").value : null;
    let psw = document.querySelector("#password").value;
    
    var p = document.createElement('p')
    p.style.textAlign = "center";
    p.setAttribute("id", "set_error");
    var p_error = document.getElementById('set_error');
    if(p_error){
        main.removeChild(p_error);
    }

    

    if (psw && !checkPasswordSecurity(psw)) {
        p.style.color = "red";
        p.innerHTML = "La password deve avere almeno 8 caratteri, una maiuscola e un numero.";
        main.prepend(p);
    } else {
        if (psw) {
            new_info["password"] = hex_sha512(psw);
        }

        console.log(JSON.stringify(new_info));
        var formData = new FormData();
        formData.append("new_info", JSON.stringify(new_info));
        formData.append("foto_profilo", temp_foto_profilo);
        axios.post("./api-impostazioni.php", formData
        ).then(response => {
            if(response.data.info || response.data.foto){
                p.style.color = "green";
                p.innerHTML = "Impostazioni cambiate.";
                main.prepend(p);
            }else{
                p.style.color = "red";
                p.innerHTML = "Username o email gia presenti.";
                main.prepend(p);
            }
            

        });

    }
    temp_foto_profilo = null;
}

function checkPasswordSecurity(password){
    let check_regex = /^(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/ ;
    return check_regex.test(password)
}

function viewPassword(){
    var input_psw = document.getElementById("password");
    if(input_psw.type == "password"){
        input_psw.type = "text";
        document.getElementById("btnViewPass").innerHTML = "<i class='fa-solid fa-eye-slash'></i>";
    }else{
        input_psw.type = "password";
        document.getElementById("btnViewPass").innerHTML = "<i class='fa-solid fa-eye'></i>";
    }
}