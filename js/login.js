function generaLoginForm(loginerror = null) {
    let form = `
    <form action="#" method="POST">
        <h2 class="h3 mb-3 fw-normal">Please sign in</h2>
        <p></p>
        <div class="form-floating">
            <input type="email" class="form-control" id="email" placeholder="name@example.com" name="email">
            <label for="email">Email address</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="password" placeholder="Password" name="password">
            <label for="password">Password</label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit" name="submit" value="Invia">log-in</button>
        <a href="signin.php">Signin</a>         
    </form>`;
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

