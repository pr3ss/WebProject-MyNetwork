//Salvataggio post
var file;
function add_image() {
    var input = document.createElement('input');
    input.type = 'file';

    input.onchange = e => {
        file = e.target.files[0];
        document.getElementById("tmp_img").innerHTML = "<div class='container-fluid'><img class='card-img-top p-2' id='myImg' src='" + URL.createObjectURL(new Blob([file])) + "'></div>";
    }

    input.click();
}

function upload_post() {
    let testo = document.getElementById("tmp_post_text").value;
    document.getElementById("tmp_post_text").value = "";
    let luogo = document.getElementById("tmp_post_luogo").value;
    document.getElementById("tmp_post_luogo").value = "";
    let cat = document.getElementById("tmp_post_cat").value;
    if (file || testo) {
        var formData = new FormData();
        formData.append("file", file);
        formData.append("testo", testo);
        formData.append("luogo", luogo);
        formData.append("categoria", cat);
        axios.post("./api-add_post.php", formData
        ).then(response => {
            console.log(response.data);
            alert(response.data);
            //TODO gestire errori estensione dimensione .....
        });
    } else {
        console.log("Inserire testo e/o immagine");
        alert("Inserire testo e/o immagine");
    }

    file = null;
    document.getElementById("tmp_img").innerHTML = "<button class='btn' style='font-size: 300%;' onclick='add_image()'><i class='fa-solid fa-circle-plus'></i></button>";
}