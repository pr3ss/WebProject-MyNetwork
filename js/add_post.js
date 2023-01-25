//Salvataggio post
let file;
function add_image() {
    const input = document.createElement('input');
    input.type = 'file';

    input.onchange = e => {
        file = e.target.files[0];
        document.getElementById("tmp_img").innerHTML = "<div class='container-fluid'><img class='card-img-top p-2' id='myImg' src='" + URL.createObjectURL(new Blob([file])) + "'></div>";
    }

    input.click();
}


function upload_post() {
    const testo = document.getElementById("tmp_post_text").value;
    document.getElementById("tmp_post_text").value = "";
    const luogo = document.getElementById("tmp_post_luogo").value;
    document.getElementById("tmp_post_luogo").value = "";
    const cat = document.getElementById("tmp_post_cat").value;
    
    const p = document.createElement('p')
    p.style.textAlign = "center";
    p.setAttribute("id", "add_post_error");

    const p_error = document.getElementById('add_post_error');
    if(p_error){
        main.removeChild(p_error);
    }

    if (file || testo) {
        const formData = new FormData();
        formData.append("file", file);
        formData.append("testo", testo);
        formData.append("luogo", luogo);
        formData.append("categoria", cat);
        axios.post("./api-add_post.php", formData
        ).then(response => {
            if(response.data){
                p.innerHTML = "Post caricato";
                p.style.color = "green";
                main.prepend(p);
            } else{
                p.style.color = "red";
                p.innerHTML = "Errore nel caricamento. Controllare estensione o dimensione immagine.";
                main.prepend(p);
            }
        });
    } else {
        p.style.color = "red";
        p.innerHTML = "Inserire testo e/o immagine.";
        main.prepend(p);
        

    }

    file = null;
    document.getElementById("tmp_img").innerHTML = "<button class='btn' style='font-size: 300%;' onclick='add_image()'><i class='fa-solid fa-circle-plus'></i></button>";
}