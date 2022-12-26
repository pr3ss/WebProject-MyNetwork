function generaLoginForm(loginerror = null) {
    let form = `
    <div >
        <h1>Social-Network</h1>
        <h5>login</h5>
        <form method="post">
            <p class="text-danger" ></p>
            <div class="txt_field">
                <input type="text" id="email" required>
                <span></span>
                <label>Email</label>
            </div>
            <div class="txt_field">
                <input type="password" id="password" required>
                <span></span>
                <label>Password</label>
            </div>
            <div class="pass">Forgot Password?</div>
            <div id="divLogin">
                <input type="submit" value="Login">
            </div>
            <div class="signup_link">
                Not a member? <a href="signin.php">Signup</a>
            </div>
        </form>
    </div>`;
    return form;
}


//password di test 6ZaxN2Vzm9NUJT2y

const main = document.getElementById("main");

function showLoginForm() {
    let form = generaLoginForm();
    main.innerHTML = form;

    document.querySelector("#main form").addEventListener("submit", function (event) {
        event.preventDefault();
        const username = document.querySelector("#email").value;
        const password = document.querySelector("#password").value;
        document.querySelector("#password").value = "";
        login(username, password);
    });
}

function login(username, password){
    document.querySelector("input[type='submit']").style["filter"]="blur(3px)";
    document.querySelector("#divLogin").innerHTML += "<div class='spinner-border' role='status'> <span class='sr-only'>Loading...</span> </div>";

    const formData = new FormData();
    formData.append('email', username);
    formData.append('password', hex_sha512(password)); //invio cryptato della password 
    
    axios.post('api-login.php', formData).then(response => {
        console.log(response);
        document.querySelector("input[type='submit']").style["filter"]="";
        document.querySelector("#divLogin").innerHTML = "<input type='submit' value='Login'></input>";  
              
        if (response.data["logineseguito"]) {
            window.location.assign("home.php");
        } else {
            document.querySelector("form > p").innerText = response.data["errorelogin"];
        }
    });

}




showLoginForm();

