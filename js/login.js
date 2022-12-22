function generaLoginForm(loginerror = null) {
    let form = `
    <div class="center">
        <h1>Social-Network</h1>
        <h5>login</h5>
        <form method="post">
            <div class="txt_field">
                <input type="text" required>
                <span></span>
                <label>Email</label>
            </div>
            <div class="txt_field">
                <input type="password" required>
                <span></span>
                <label>Password</label>
            </div>
            <div class="pass">Forgot Password?</div>
            <input type="submit" value="Login">
            <div class="signup_link">
                Not a member? <a href="signin.php">Signup</a>
            </div>
        </form>
    </div>`;
    return form;
}




const main = document.querySelector("main");

function showLoginForm() {
    let form = generaLoginForm();
    main.innerHTML = form;

    document.querySelector("main form").addEventListener("submit", function (event) {
        event.preventDefault();
        const username = document.querySelector("#email").value;
        const password = document.querySelector("#password").value;
        document.querySelector("#password").value = "";
        login(username, password);
    });
}

function login(username, password){
    const formData = new FormData();
    formData.append('email', username);
    formData.append('password', hex_sha512(password)); //invio cryptato della password 
    
    axios.post('api-login.php', formData).then(response => {
        console.log(response);
        if (response.data["logineseguito"]) {
            window.location.assign("home.php");
        } else {
            document.querySelector("form > p").innerText = response.data["errorelogin"];
        }
    });

}




showLoginForm();

