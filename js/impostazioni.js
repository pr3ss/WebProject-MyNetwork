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
    new_info["username"] = document.getElementById("my_username").value;
    new_info["email"] = document.getElementById("email").value;
    let psw = document.querySelector("#password").value;
    console.log(psw);

    if (psw && !checkPasswordSecurity(psw)) {
        alert("password non valida");

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
            console.log(response.data);
            alert(response.data);

        });

    }
    temp_foto_profilo = null;
}

//Ridondante da signin.js
/* TODO aggiungere ricerca maiuscola e carattere speciale oltre che alla lunghezza */
function checkPasswordSecurity(password) {
    return password.length >= 8;
}