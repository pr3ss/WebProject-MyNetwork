//Commento
function addComment(postId) {
    let text = document.getElementById("textComment").value;
    console.log(postId);
    if (text && postId) {
        var formData = new FormData();
        formData.append("testo", text);
        formData.append("postId", postId);
        axios.post("./api-add_comment.php", formData
        ).then(response => {
            console.log(response.data);
            //alert(response.data);
            if (response.data) {
                openPost(postId);
            }
        });
    } else {
        console.log("Inserire testo");
        alert("Inserire testo");
    }
}