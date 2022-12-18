function generaSigninForm(loginerror = null) {
    let form = `
    <form action="#" method="POST">
        <h2>Signin</h2>
        <p></p>
        <ul>
            <li>
                <label for="username">Username:</label><input type="text" id="username" name="username" />
            </li>
            <li>
                <label for="password">Password:</label><input type="password" id="password" name="password" />
            </li>
            <li>
                <input type="submit" name="submit" value="Invia" />
                <a href="login.php">Login</a>
            </li>
        </ul>
    </form>`;
    return form;
}

const main = document.querySelector("main");


function showSigninForm(){
    let form = generaSigninForm();
    main.innerHTML = form;
}

showSigninForm();



