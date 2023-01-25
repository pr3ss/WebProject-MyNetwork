let temp_foto_profilo;
function cambia_foto_profilo() {
    const input = document.createElement('input');
    input.type = 'file';

    input.onchange = e => {
        temp_foto_profilo = e.target.files[0];
        document.getElementById("foto_profilo").src = URL.createObjectURL(new Blob([temp_foto_profilo]));
    }

    input.click();
}

function salva_info() {
    const new_info = {};

    new_info["username"] = document.getElementById("my_username").value ? document.getElementById("my_username").value : null;
    new_info["email"] = document.getElementById("email").value ? document.getElementById("email").value : null ;
    new_info["descrizione"] = document.getElementById("descrizione").value ? document.getElementById("descrizione").value : null;
    let psw = document.querySelector("#password").value;
    
    const p = document.createElement('p')
    p.style.textAlign = "center";
    p.setAttribute("id", "set_error");
    const p_error = document.getElementById('set_error');
    if(p_error){
        main.removeChild(p_error);
    }

    if (psw && !checkPasswordSecurity(psw)) {
        p.style.color = "red";
        p.innerHTML = "La password deve avere almeno 8 caratteri, una maiuscola e un numero. Almeno un Carattere speciale (@$!%*#?&)";
        main.prepend(p);
    } else {
        if (psw) {
            new_info["password"] = hex_sha512(psw);
        }

        const formData = new FormData();
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
    const check_regex = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;
    return check_regex.test(password)
}

function viewPassword(){
    const input_psw = document.getElementById("password");
    if(input_psw.type == "password"){
        input_psw.type = "text";
        document.getElementById("btnViewPass").innerHTML = "<i class='fa-solid fa-eye-slash'></i>";
    }else{
        input_psw.type = "password";
        document.getElementById("btnViewPass").innerHTML = "<i class='fa-solid fa-eye'></i>";
    }
}