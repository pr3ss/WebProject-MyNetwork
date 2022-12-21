function generaLoginForm(loginerror = null) {
    let form = `
    <form action="#" method="POST">
        <h2 class="h3 mb-3 fw-normal">Please sign in</h2>
        <p></p>
        <div class="form-floating">
            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
            <label for="floatingInput">Email address</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
            <label for="floatingPassword">Password</label>
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
        const username = document.querySelector("#username").value;
        const password = document.querySelector("#password").value;
        login(username, password);
    });
}

//window.location.assign("signin.php");


showLoginForm();

