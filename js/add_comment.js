//Commento
function addComment(postId) {
    const text = document.getElementById("textComment").value;
    if (text && postId) {
        const formData = new FormData();
        formData.append("testo", text);
        formData.append("postId", postId);
        axios.post("./api-add_comment.php", formData
        ).then(response => {
            if (response.data) {
                openPost(postId);
            }
        });
    }
}